<?php

namespace App\Http\Controllers;

use App\Models\DeliveryAssignment;
use App\Models\DeliveryAssignmentLocation;
use App\Models\DeliveryBoy;
use Illuminate\Http\Request;

class DeliveryBoyController extends Controller
{
    public function dashboard()
    {
        $deliveryBoy = auth()->user()->deliveryBoy;

        if (!$deliveryBoy) {
            abort(403, 'Delivery boy profile not found.');
        }

        $assignments = DeliveryAssignment::where(
            'delivery_boy_id',
            $deliveryBoy->id
        )
            ->with([
                'order.user',
                'order.address',
                'order.items.product',
            ])
            ->latest()
            ->get();

        return view(
            'delivery-boy.dashboard',
            compact('assignments')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Delivery Boy GPS Location
    |--------------------------------------------------------------------------
    */

    public function updateLocation(
        Request $request,
        DeliveryAssignment $assignment
    ) {
        $deliveryBoy = auth()->user()->deliveryBoy;

        if (!$deliveryBoy) {
            abort(403, 'Delivery boy profile not found.');
        }


        /*
        |--------------------------------------------------------------------------
        | Verify Assignment Belongs To Logged-in Delivery Boy
        |--------------------------------------------------------------------------
        */

        $assignment = DeliveryAssignment::where(
            'id',
            $assignment->id
        )
            ->where(
                'delivery_boy_id',
                $deliveryBoy->id
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Validate GPS Data
        |--------------------------------------------------------------------------
        */

        $data = $request->validate([
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

            'accuracy' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'speed' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'heading' => [
                'nullable',
                'numeric',
                'between:0,360',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Allow Tracking Only After Pickup
        |--------------------------------------------------------------------------
        */

        if (!in_array(
            $assignment->status,
            [
                'picked_up',
                'out_for_delivery',
            ],
            true
        )) {
            return response()->json([
                'success' => false,
                'message' => 'Location tracking is available after pickup.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Save Latest Location
        |--------------------------------------------------------------------------
        */

        $location = DeliveryAssignmentLocation::updateOrCreate(
            [
                'delivery_assignment_id' => $assignment->id,
            ],
            [
                'delivery_boy_id' => $deliveryBoy->id,

                'latitude' => $data['latitude'],

                'longitude' => $data['longitude'],

                'accuracy' => $data['accuracy'] ?? null,

                'speed' => $data['speed'] ?? null,

                'heading' => $data['heading'] ?? null,

                'recorded_at' => now(),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Return Location Response
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'message' => 'Location updated.',

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


    public function updateStatus(
        Request $request,
        DeliveryAssignment $assignment
    ) {
        $deliveryBoy = auth()->user()->deliveryBoy;

        if (!$deliveryBoy) {
            abort(403, 'Delivery boy profile not found.');
        }


        /*
        |--------------------------------------------------------------------------
        | Verify Assignment Belongs To Logged-in Delivery Boy
        |--------------------------------------------------------------------------
        */

        $assignment = DeliveryAssignment::where(
            'id',
            $assignment->id
        )
            ->where(
                'delivery_boy_id',
                $deliveryBoy->id
            )
            ->with('order')
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Validate Status
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'status' => [
                'required',
                'in:assigned,picked_up,out_for_delivery,delivered',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Delivery Assignment
        |--------------------------------------------------------------------------
        */

        $assignment->update([
            'status' => $request->status,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Order Status
        |--------------------------------------------------------------------------
        */

        $orderStatus = match ($request->status) {

            'assigned' => 'confirmed',

            'picked_up' => 'preparing',

            'out_for_delivery' => 'out_for_delivery',

            'delivered' => 'delivered',

        };


        /*
        |--------------------------------------------------------------------------
        | Update Order + COD Payment
        |--------------------------------------------------------------------------
        */

        if ($request->status === 'delivered') {

            $assignment->order->update([
                'status' => 'delivered',

                // COD payment received after delivery
                'payment_status' => 'paid',
            ]);

        } else {

            $assignment->order->update([
                'status' => $orderStatus,
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

        $message = match ($request->status) {

            'assigned' =>
                'Order marked as assigned successfully.',

            'picked_up' =>
                'Order marked as picked up successfully.',

            'out_for_delivery' =>
                'Order marked as out for delivery.',

            'delivered' =>
                'Order delivered successfully. COD payment marked as paid.',

        };


        return redirect()
            ->route('delivery-boy.dashboard')
            ->with(
                'success',
                $message
            );
    }
}