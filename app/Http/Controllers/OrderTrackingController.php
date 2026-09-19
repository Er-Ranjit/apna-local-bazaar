<?php

namespace App\Http\Controllers;

use App\Models\DeliveryAssignmentLocation;
use App\Models\Order;

class OrderTrackingController extends Controller
{
    /**
     * Return the latest delivery-boy location for customer's order.
     */
    public function location(Order $order)
    {
        // Make sure the logged-in customer owns this order.
        if ((int) $order->user_id !== (int) auth()->id()) {
            abort(403);
        }

        // Find the delivery assignment for this order.
        $assignment = $order->deliveryAssignment;

        if (!$assignment) {
            return response()->json([
                'success' => false,
                'message' => 'No delivery assignment found for this order.',
            ], 404);
        }

        // Get the latest saved location.
        $location = DeliveryAssignmentLocation::where(
            'delivery_assignment_id',
            $assignment->id
        )
            ->latest('recorded_at')
            ->first();

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Delivery location is not available yet.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'location' => [
                'latitude' => (float) $location->latitude,
                'longitude' => (float) $location->longitude,
                'accuracy' => $location->accuracy !== null
                    ? (float) $location->accuracy
                    : null,
                'speed' => $location->speed !== null
                    ? (float) $location->speed
                    : null,
                'heading' => $location->heading !== null
                    ? (float) $location->heading
                    : null,
                'recorded_at' => optional(
                    $location->recorded_at
                )->toISOString(),
            ],
        ]);
    }
}