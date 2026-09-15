<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
    public function index()
    {
        $vendor = auth()->user()->vendor;

        if (!$vendor) {
            abort(403, 'Vendor profile not found.');
        }

        $vendorId = $vendor->id;

        $orders = Order::with([
            'user',
            'address',
            'items.product',
            'deliveryAssignment.deliveryBoy.user',
        ])
            ->whereHas('items.product', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->latest()
            ->get();

        return view('vendor.orders.index', compact('orders', 'vendorId'));
    }


    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,confirmed,preparing'],
        ]);

        $user = auth()->user();

        $vendor = $user->vendor;

        if (!$vendor) {
            return redirect()
                ->route('vendor.orders.index')
                ->with('error', 'Vendor profile not found.');
        }

        $order->load('items.product');

        $belongsToVendor = false;

        foreach ($order->items as $item) {

            if (
                $item->product &&
                (int) $item->product->vendor_id === (int) $vendor->id
            ) {
                $belongsToVendor = true;
                break;
            }
        }

        if (!$belongsToVendor) {
            return redirect()
                ->route('vendor.orders.index')
                ->with('error', 'This order does not belong to your store.');
        }

        $order->status = $request->status;

        $order->save();

        return redirect()
            ->route('vendor.orders.index')
            ->with(
                'success',
                'Order #' .
                $order->order_number .
                ' updated to ' .
                ucfirst(str_replace('_', ' ', $order->status)) .
                '.'
            );
    }
}