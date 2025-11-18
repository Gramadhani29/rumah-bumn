<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class EksternalDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get user's orders
        $orders = Order::where('user_id', $user->id)
            ->with('items.product.umkm')
            ->latest()
            ->paginate(10);
        
        // Get order statistics
        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();
        $completedOrders = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
        $totalSpent = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->sum('total_amount');
        
        return view('eksternal.dashboard', compact(
            'user',
            'orders',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalSpent'
        ));
    }
    
    public function orders()
    {
        $user = auth()->user();
        
        $orders = Order::where('user_id', $user->id)
            ->with('items.product.umkm')
            ->latest()
            ->paginate(15);
        
        return view('eksternal.orders', compact('orders'));
    }
    
    public function orderDetail($id)
    {
        $user = auth()->user();
        
        $order = Order::where('user_id', $user->id)
            ->with('items.product.umkm')
            ->findOrFail($id);
        
        return view('eksternal.order-detail', compact('order'));
    }
}

