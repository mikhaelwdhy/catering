<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['user', 'package'])
            ->when($request->search, function ($query, $search) {
                $query->where('order_code', 'like', "%{$search}%")
                      ->orWhere('event_name', 'like', "%{$search}%")
                      ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%{$search}%"));
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'package.category']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Approved,Rejected,Completed'],
            'penalty_fee' => ['nullable', 'integer', 'min:0'],
            'admin_note' => ['nullable', 'string', 'max:500'],
        ]);

        try {
            DB::transaction(function () use ($order, $validated) {
                $package = Package::where('id', $order->package_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $oldStatus = $order->status;
                $newStatus = $validated['status'];

                if ($oldStatus === 'Pending' && $newStatus === 'Approved') {
                    if ($package->daily_quota < $order->portions) {
                        throw new \Exception("Kuota produksi harian paket tidak mencukupi (Sisa: {$package->daily_quota} porsi).");
                    }
                    $package->decrement('daily_quota', $order->portions);
                }

                if ($oldStatus === 'Approved' && $newStatus === 'Rejected') {
                    $package->increment('daily_quota', $order->portions);
                }

                if ($oldStatus === 'Approved' && $newStatus === 'Completed') {
                    $package->increment('daily_quota', $order->portions);
                }

                $order->update([
                    'status' => $newStatus,
                    'penalty_fee' => $validated['penalty_fee'] ?? $order->penalty_fee,
                    'admin_note' => $validated['admin_note'],
                ]);
            });

            return redirect()->route('admin.orders.show', $order)
                ->with('success', "Status pesanan berhasil diperbarui menjadi {$validated['status']}.");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}