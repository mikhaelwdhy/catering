<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('package')
            ->where('user_id', Auth::id())
            ->when($request->search, function ($query, $search) {
                $query->where('order_code', 'like', "%{$search}%")
                      ->orWhere('event_name', 'like', "%{$search}%");
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('user.orders.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $packages = Package::with('category')->where('daily_quota', '>', 0)->get();
        $selectedPackageId = $request->package_id;
        $minEventDate = Carbon::today()->addDays(2)->toDateString();

        return view('user.orders.create', compact('packages', 'selectedPackageId', 'minEventDate'));
    }

    public function store(Request $request)
    {
        $minEventDate = Carbon::today()->addDays(2)->toDateString();

        $validated = $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'event_name' => ['required', 'string', 'max:150'],
            'event_date' => ['required', 'date', 'after_or_equal:' . $minEventDate],
            'event_address' => ['required', 'string', 'max:500'],
            'portions' => ['required', 'integer', 'min:1'],
            'payment_proof' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'notes' => ['nullable', 'string', 'max:500'],
        ], [
            'event_date.after_or_equal' => 'Pemesanan wajib dilakukan minimal H-2 sebelum tanggal acara.',
        ]);

        $package = Package::findOrFail($validated['package_id']);

        if ($validated['portions'] < $package->min_order) {
            return back()->withInput()->withErrors([
                'portions' => "Jumlah porsi minimal untuk paket {$package->name} adalah {$package->min_order} porsi (MOQ)."
            ]);
        }

        if ($validated['portions'] > $package->daily_quota) {
            return back()->withInput()->withErrors([
                'portions' => "Jumlah porsi melebihi sisa kuota produksi harian ({$package->daily_quota} porsi)."
            ]);
        }

        $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        $pricePerPortion = $package->price;
        $totalPrice = $validated['portions'] * $pricePerPortion;

        Order::create([
            'order_code' => 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4)),
            'user_id' => Auth::id(),
            'package_id' => $package->id,
            'event_name' => $validated['event_name'],
            'event_date' => $validated['event_date'],
            'event_address' => $validated['event_address'],
            'portions' => $validated['portions'],
            'price_per_portion' => $pricePerPortion,
            'total_price' => $totalPrice,
            'payment_proof' => $proofPath,
            'status' => 'Pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('user.orders.index')
            ->with('success', 'Pesanan berhasil dibuat! Menunggu verifikasi pembayaran oleh Admin.');
    }

    public function show(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);

        $order->load('package.category');
        return view('user.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);

        if ($order->status !== 'Pending') {
            return redirect()->route('user.orders.show', $order)
                ->with('error', 'Pesanan yang sudah diproses tidak dapat diubah.');
        }

        $packages = Package::with('category')->get();
        $minEventDate = Carbon::today()->addDays(2)->toDateString();

        return view('user.orders.edit', compact('order', 'packages', 'minEventDate'));
    }

    public function update(Request $request, Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);

        if ($order->status !== 'Pending') {
            return redirect()->route('user.orders.show', $order)
                ->with('error', 'Pesanan yang sudah diproses tidak dapat diubah.');
        }

        $minEventDate = Carbon::today()->addDays(2)->toDateString();

        $validated = $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'event_name' => ['required', 'string', 'max:150'],
            'event_date' => ['required', 'date', 'after_or_equal:' . $minEventDate],
            'event_address' => ['required', 'string', 'max:500'],
            'portions' => ['required', 'integer', 'min:1'],
            'payment_proof' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'notes' => ['nullable', 'string', 'max:500'],
        ], [
            'event_date.after_or_equal' => 'Pemesanan wajib dilakukan minimal H-2 sebelum tanggal acara.',
        ]);

        $package = Package::findOrFail($validated['package_id']);

        if ($validated['portions'] < $package->min_order) {
            return back()->withInput()->withErrors([
                'portions' => "Jumlah porsi minimal untuk paket {$package->name} adalah {$package->min_order} porsi (MOQ)."
            ]);
        }

        if ($validated['portions'] > $package->daily_quota) {
            return back()->withInput()->withErrors([
                'portions' => "Jumlah porsi melebihi sisa kuota produksi harian ({$package->daily_quota} porsi)."
            ]);
        }

        $proofPath = $order->payment_proof;
        if ($request->hasFile('payment_proof')) {
            if ($order->payment_proof && Storage::disk('public')->exists($order->payment_proof)) {
                Storage::disk('public')->delete($order->payment_proof);
            }
            $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        $order->update([
            'package_id' => $package->id,
            'event_name' => $validated['event_name'],
            'event_date' => $validated['event_date'],
            'event_address' => $validated['event_address'],
            'portions' => $validated['portions'],
            'price_per_portion' => $package->price,
            'total_price' => $validated['portions'] * $package->price,
            'payment_proof' => $proofPath,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('user.orders.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);

        if ($order->status !== 'Pending') {
            return back()->with('error', 'Pesanan yang sudah diproses tidak dapat dibatalkan.');
        }

        if ($order->payment_proof && Storage::disk('public')->exists($order->payment_proof)) {
            Storage::disk('public')->delete($order->payment_proof);
        }

        $order->delete();

        return redirect()->route('user.orders.index')
            ->with('success', 'Pesanan berhasil dibatalkan dan dihapus.');
    }
}