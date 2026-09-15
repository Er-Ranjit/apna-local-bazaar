<?php

namespace App\Http\Controllers;

use App\Models\DeliveryAssignment;
use App\Models\DeliveryBoy;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliveryAssignmentController extends Controller
{
    /**
     * Show delivery-boy assignment page.
     */
    public function create(Order $order)
    {
        $vendor = auth()->user()->vendor;

        if (!$vendor) {
            abort(403, 'Vendor profile not found.');
        }

        // Check whether this order contains products belonging to this vendor.
        $belongsToVendor = $order->items()
            ->whereHas('product', function ($query) use ($vendor) {
                $query->where('vendor_id', $vendor->id);
            })
            ->exists();

        if (!$belongsToVendor) {
            return back()->with(
                'error',
                'Vendor ID mismatch. Logged vendor ID: ' . $vendor->id
            );
        }

        // Get delivery boys from delivery_boys table.
        $deliveryBoys = DeliveryBoy::with('user')
            ->latest()
            ->get();

        $order->load([
            'user',
            'address',
            'items.product',
            'deliveryAssignment.deliveryBoy.user',
        ]);

        return view(
            'vendor.orders.assign',
            compact('order', 'deliveryBoys')
        );
    }

    /**
     * Assign delivery boy to order.
     */
    public function store(Request $request, Order $order)
    {
        $request->validate([
            'delivery_boy_id' => [
                'required',
                'exists:delivery_boys,id',
            ],
        ]);

        $vendor = auth()->user()->vendor;

        if (!$vendor) {
            abort(403, 'Vendor profile not found.');
        }

        // Make sure the order belongs to this vendor.
        $belongsToVendor = $order->items()
            ->whereHas('product', function ($query) use ($vendor) {
                $query->where('vendor_id', $vendor->id);
            })
            ->exists();

        if (!$belongsToVendor) {
            return back()->with(
                'error',
                'Vendor ID mismatch. Logged vendor ID: ' . $vendor->id
            );
        }

        // Get actual delivery boy record.
        $deliveryBoy = DeliveryBoy::with('user')
            ->where('id', $request->delivery_boy_id)
            ->first();

        if (!$deliveryBoy) {
            return back()->with(
                'error',
                'Invalid delivery boy selected.'
            );
        }

        // Create or update delivery assignment.
        DeliveryAssignment::updateOrCreate(
            [
                'order_id' => $order->id,
            ],
            [
                'delivery_boy_id' => $deliveryBoy->id,
                'status' => 'assigned',
            ]
        );

        return redirect()
            ->route('vendor.orders.index')
            ->with(
                'success',
                'Delivery boy assigned successfully.'
            );
    }
}