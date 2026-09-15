<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        $vendor = $user->vendor;

        if (!$vendor) {
            abort(403, 'Vendor profile not found.');
        }

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */

        $products = Product::where('vendor_id', $vendor->id)
            ->with('category')
            ->latest()
            ->get();

        $productsCount = $products->count();

        $activeProducts = $products->where('is_active', true)
            ->where('is_available', true)
            ->count();

        $inactiveProducts = $productsCount - $activeProducts;

        $lowStockProducts = $products
            ->where('stock', '>', 0)
            ->where('stock', '<=', 5)
            ->sortBy('stock')
            ->values();

        $outOfStockProducts = $products
            ->where('stock', '<=', 0)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | ORDERS
        |--------------------------------------------------------------------------
        */

        $ordersQuery = Order::whereHas('items.product', function ($query) use ($vendor) {
            $query->where('vendor_id', $vendor->id);
        });

        $ordersCount = (clone $ordersQuery)->count();

        $pendingOrders = (clone $ordersQuery)
            ->where('status', 'pending')
            ->count();

        $confirmedOrders = (clone $ordersQuery)
            ->where('status', 'confirmed')
            ->count();

        $preparingOrders = (clone $ordersQuery)
            ->where('status', 'preparing')
            ->count();

        $outForDeliveryOrders = (clone $ordersQuery)
            ->where('status', 'out_for_delivery')
            ->count();

        $deliveredOrders = (clone $ordersQuery)
            ->where('status', 'delivered')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | REVENUE
        |--------------------------------------------------------------------------
        */

        $revenue = (clone $ordersQuery)
            ->where('status', 'delivered')
            ->sum('total_amount');

        /*
        |--------------------------------------------------------------------------
        | RECENT ORDERS
        |--------------------------------------------------------------------------
        */

        $recentOrders = (clone $ordersQuery)
            ->with([
                'user',
                'address',
                'items.product',
                'deliveryAssignment.deliveryBoy.user',
            ])
            ->latest()
            ->take(5)
            ->get();

        return view('vendor.dashboard', compact(
            'vendor',
            'products',
            'productsCount',
            'activeProducts',
            'inactiveProducts',
            'lowStockProducts',
            'outOfStockProducts',
            'ordersCount',
            'pendingOrders',
            'confirmedOrders',
            'preparingOrders',
            'outForDeliveryOrders',
            'deliveredOrders',
            'revenue',
            'recentOrders'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | SHOP LOCATION PAGE
    |--------------------------------------------------------------------------
    */

    public function location()
    {
        $vendor = auth()->user()->vendor;

        if (!$vendor) {
            abort(403, 'Vendor profile not found.');
        }

        return view('vendor.location', compact('vendor'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE SHOP LOCATION
    |--------------------------------------------------------------------------
    */

    public function updateLocation(Request $request)
    {
        $vendor = auth()->user()->vendor;

        if (!$vendor) {
            abort(403, 'Vendor profile not found.');
        }

        $validated = $request->validate([
            'latitude' => [
                'required',
                'numeric',
                'between:-90,90',
            ],
            'longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],
        ]);

        $vendor->update([
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
        ]);

        return redirect()
            ->route('vendor.location')
            ->with('success', 'Shop location saved successfully.');
    }
}