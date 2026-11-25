<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalOrders = Order::where('user_id', $userId)->count();
        $pendingOrders = Order::where('user_id', $userId)->where('status', 'Pending')->count();
        $approvedOrders = Order::where('user_id', $userId)->whereIn('status', ['Approved', 'Completed'])->count();
        $totalSpent = Order::where('user_id', $userId)
            ->whereIn('status', ['Approved', 'Completed'])
            ->sum('total_price');

        $recentOrders = Order::with('package')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'approvedOrders',
            'totalSpent',
            'recentOrders'
        ));
    }
}