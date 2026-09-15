<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Show all orders of logged-in user
     */
    public function index()
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }


    /**
     * Show single order / confirmation page
     */
    public function show(Order $order)
    {
        // Security: user can only see their own order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load([
            'items.product',
            'address',
        ]);

        return view('orders.show', compact('order'));
    }
}