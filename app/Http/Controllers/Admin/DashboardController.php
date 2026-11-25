<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $pendingOrders = Order::where('status', 'Pending')->count();
        $completedOrders = Order::where('status', 'Completed')->count();
        $totalRevenue = Order::whereIn('status', ['Approved', 'Completed'])
            ->sum(DB::raw('total_price + penalty_fee'));

        $lowQuotaPackages = Package::with('category')
            ->where('daily_quota', '<=', 50)
            ->orderBy('daily_quota', 'asc')
            ->get();

        $recentOrders = Order::with(['user', 'package'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'pendingOrders',
            'completedOrders',
            'totalRevenue',
            'lowQuotaPackages',
            'recentOrders'
        ));
    }
}