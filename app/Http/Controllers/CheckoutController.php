<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    private const DELIVERY_RADIUS_KM = 10;

    /**
     * Show checkout page
     */
    public function index()
    {
        $cart = Cart::with([
            'items.product.vendor',
        ])
            ->where('user_id', auth()->id())
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Cart Empty
        |--------------------------------------------------------------------------
        */

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Addresses
        |--------------------------------------------------------------------------
        */

        $addresses = $user
            ->addresses()
            ->latest()
            ->get();

        if ($addresses->isEmpty()) {
            return view(
                'checkout.index',
                compact('cart', 'addresses')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Find An Address With Location
        |--------------------------------------------------------------------------
        |
        | We use the first saved address with latitude/longitude
        | only for initial checkout preview.
        |
        */

        $selectedAddress = $addresses->first(function ($address) {
            return $address->latitude !== null &&
                   $address->longitude !== null;
        });

        /*
        |--------------------------------------------------------------------------
        | Default Values
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;
        $discount = 0;
        $maxDistanceKm = 0;
        $deliveryCharge = 0;
        $totalAmount = 0;

        /*
        |--------------------------------------------------------------------------
        | Calculate Subtotal
        |--------------------------------------------------------------------------
        */

        foreach ($cart->items as $item) {

            if (!$item->product) {
                return redirect()
                    ->route('cart.index')
                    ->with(
                        'error',
                        'One of the products in your cart no longer exists.'
                    );
            }

            $subtotal +=
                (float) $item->price *
                (int) $item->quantity;
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Initial Delivery Charge
        |--------------------------------------------------------------------------
        */

        if ($selectedAddress) {

            try {

                $maxDistanceKm = $this->calculateCartDistance(
                    $cart,
                    (float) $selectedAddress->latitude,
                    (float) $selectedAddress->longitude
                );

                $deliveryCharge =
                    $this->deliveryChargeForDistance(
                        $maxDistanceKm
                    );

            } catch (\Exception $e) {

                return redirect()
                    ->route('cart.index')
                    ->with(
                        'error',
                        $e->getMessage()
                    );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Total
        |--------------------------------------------------------------------------
        */

        $totalAmount =
            $subtotal +
            $deliveryCharge -
            $discount;

        return view(
            'checkout.index',
            compact(
                'cart',
                'addresses',
                'subtotal',
                'maxDistanceKm',
                'deliveryCharge',
                'discount',
                'totalAmount'
            )
        );
    }


    /**
     * Place Order
     */
    public function placeOrder(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Address
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'address_id' => [
                'required',
                'exists:addresses,id',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Verify Address Belongs To Logged-in User
        |--------------------------------------------------------------------------
        */

        $address = auth()->user()
            ->addresses()
            ->where('id', $request->address_id)
            ->first();

        if (!$address) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Address Location Required
        |--------------------------------------------------------------------------
        */

        if (
            $address->latitude === null ||
            $address->longitude === null
        ) {
            return redirect()
                ->route('checkout.index')
                ->with(
                    'error',
                    'Please set the location for the selected delivery address.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Get Cart
        |--------------------------------------------------------------------------
        */

        $cart = Cart::with([
            'items.product.vendor',
        ])
            ->where('user_id', auth()->id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Your cart is empty.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Subtotal
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;

        foreach ($cart->items as $item) {

            if (!$item->product) {
                return redirect()
                    ->route('cart.index')
                    ->with(
                        'error',
                        'One of the products in your cart no longer exists.'
                    );
            }

            $subtotal +=
                (float) $item->price *
                (int) $item->quantity;
        }

        /*
        |--------------------------------------------------------------------------
        | Discount
        |--------------------------------------------------------------------------
        */

        $discount = 0;

        /*
        |--------------------------------------------------------------------------
        | Calculate Delivery Distance From SELECTED ADDRESS
        |--------------------------------------------------------------------------
        */

        try {

            $maxDistanceKm = $this->calculateCartDistance(
                $cart,
                (float) $address->latitude,
                (float) $address->longitude
            );

            $deliveryCharge =
                $this->deliveryChargeForDistance(
                    $maxDistanceKm
                );

        } catch (\Exception $e) {

            return redirect()
                ->route('checkout.index')
                ->with(
                    'error',
                    $e->getMessage()
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Final Total
        |--------------------------------------------------------------------------
        */

        $totalAmount =
            $subtotal +
            $deliveryCharge -
            $discount;


        try {

            $order = DB::transaction(function () use (
                $cart,
                $address,
                $subtotal,
                $deliveryCharge,
                $discount,
                $totalAmount,
                $maxDistanceKm
            ) {

                /*
                |--------------------------------------------------------------------------
                | FINAL STOCK + LOCATION CHECK
                |--------------------------------------------------------------------------
                */

                foreach ($cart->items as $item) {

                    /*
                    |--------------------------------------------------------------------------
                    | Lock Product Row
                    |--------------------------------------------------------------------------
                    */

                    $product = \App\Models\Product::where(
                        'id',
                        $item->product_id
                    )
                        ->lockForUpdate()
                        ->first();

                    if (!$product) {
                        throw new \Exception(
                            'One of the products in your cart no longer exists.'
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Product Availability
                    |--------------------------------------------------------------------------
                    */

                    if (
                        !$product->is_active ||
                        !$product->is_available
                    ) {
                        throw new \Exception(
                            $product->name .
                            ' is currently unavailable.'
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Stock
                    |--------------------------------------------------------------------------
                    */

                    if (
                        (int) $product->stock <
                        (int) $item->quantity
                    ) {
                        throw new \Exception(
                            'Only ' .
                            $product->stock .
                            ' items of ' .
                            $product->name .
                            ' are available.'
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Vendor
                    |--------------------------------------------------------------------------
                    */

                    $product->load('vendor');

                    if (!$product->vendor) {
                        throw new \Exception(
                            'Vendor for ' .
                            $product->name .
                            ' was not found.'
                        );
                    }

                    $vendor = $product->vendor;

                    /*
                    |--------------------------------------------------------------------------
                    | Vendor Location
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $vendor->latitude === null ||
                        $vendor->longitude === null
                    ) {
                        throw new \Exception(
                            'Store location is not available for ' .
                            $product->name .
                            '.'
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | FINAL 10 KM CHECK USING SELECTED ADDRESS
                    |--------------------------------------------------------------------------
                    */

                    $distance = $this->distanceInKm(
                        (float) $address->latitude,
                        (float) $address->longitude,
                        (float) $vendor->latitude,
                        (float) $vendor->longitude
                    );

                    if (
                        $distance >
                        self::DELIVERY_RADIUS_KM
                    ) {
                        throw new \Exception(
                            $product->name .
                            ' is outside our 10 KM delivery area for the selected address.'
                        );
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | Recalculate Final Delivery Charge
                |--------------------------------------------------------------------------
                */

                $finalDistanceKm = $this->calculateCartDistance(
                    $cart,
                    (float) $address->latitude,
                    (float) $address->longitude
                );

                $finalDeliveryCharge =
                    $this->deliveryChargeForDistance(
                        $finalDistanceKm
                    );

                $finalTotalAmount =
                    $subtotal +
                    $finalDeliveryCharge -
                    $discount;

                /*
                |--------------------------------------------------------------------------
                | Create Order
                |--------------------------------------------------------------------------
                */

                $order = Order::create([

                    'user_id' => auth()->id(),

                    'address_id' => $address->id,

                    'order_number' =>
                        'ORD-' .
                        now()->format('YmdHis') .
                        '-' .
                        random_int(100, 999),

                    'subtotal' => $subtotal,

                    'delivery_charge' => $finalDeliveryCharge,

                    'discount' => $discount,

                    'total_amount' => $finalTotalAmount,

                    'payment_method' => 'cod',

                    'payment_status' => 'pending',

                    'status' => 'pending',
                ]);

                /*
                |--------------------------------------------------------------------------
                | Order Items + Stock Reduction
                |--------------------------------------------------------------------------
                */

                foreach ($cart->items as $item) {

                    $product = \App\Models\Product::where(
                        'id',
                        $item->product_id
                    )
                        ->lockForUpdate()
                        ->firstOrFail();

                    /*
                    |--------------------------------------------------------------------------
                    | Create Order Item
                    |--------------------------------------------------------------------------
                    */

                    OrderItem::create([

                        'order_id' => $order->id,

                        'product_id' => $product->id,

                        'quantity' => $item->quantity,

                        'price' => $item->price,
                    ]);

                    /*
                    |--------------------------------------------------------------------------
                    | Reduce Stock
                    |--------------------------------------------------------------------------
                    */

                    $product->decrement(
                        'stock',
                        $item->quantity
                    );

                    $product->refresh();

                    /*
                    |--------------------------------------------------------------------------
                    | Out Of Stock
                    |--------------------------------------------------------------------------
                    */

                    if (
                        (int) $product->stock <= 0
                    ) {
                        $product->update([
                            'is_available' => false,
                        ]);
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | Empty Cart
                |--------------------------------------------------------------------------
                */

                $cart->items()->delete();

                return $order;
            });


            /*
            |--------------------------------------------------------------------------
            | Success
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'orders.show',
                    $order->id
                );

        } catch (\Exception $e) {

            return redirect()
                ->route('checkout.index')
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }


    /**
     * Calculate maximum vendor distance for cart.
     *
     * For multiple vendors, the farthest vendor decides
     * the single delivery charge.
     */
    private function calculateCartDistance(
        Cart $cart,
        float $addressLatitude,
        float $addressLongitude
    ): float {

        $maxDistanceKm = 0;

        foreach ($cart->items as $item) {

            $product = $item->product;

            if (!$product) {
                throw new \Exception(
                    'One of the products in your cart no longer exists.'
                );
            }

            if (!$product->vendor) {
                throw new \Exception(
                    $product->name .
                    ' does not have a valid vendor.'
                );
            }

            $vendor = $product->vendor;

            if (
                $vendor->latitude === null ||
                $vendor->longitude === null
            ) {
                throw new \Exception(
                    'Store location is not available for ' .
                    $product->name .
                    '.'
                );
            }

            $distance = $this->distanceInKm(
                $addressLatitude,
                $addressLongitude,
                (float) $vendor->latitude,
                (float) $vendor->longitude
            );

            if (
                $distance >
                self::DELIVERY_RADIUS_KM
            ) {
                throw new \Exception(
                    $product->name .
                    ' is outside our 10 KM delivery area.'
                );
            }

            if ($distance > $maxDistanceKm) {
                $maxDistanceKm = $distance;
            }
        }

        return $maxDistanceKm;
    }


    /**
     * Delivery charge according to distance.
     */
    private function deliveryChargeForDistance(
        float $distanceKm
    ): float {

        if ($distanceKm <= 2) {
            return 10;
        }

        if ($distanceKm <= 5) {
            return 20;
        }

        if ($distanceKm <= 8) {
            return 30;
        }

        if ($distanceKm <= 10) {
            return 40;
        }

        throw new \Exception(
            'This order is outside our 10 KM delivery area.'
        );
    }


    /**
     * Calculate distance between two coordinates.
     */
    private function distanceInKm(
        float $latitude1,
        float $longitude1,
        float $latitude2,
        float $longitude2
    ): float {

        $earthRadius = 6371;

        $latDifference = deg2rad(
            $latitude2 - $latitude1
        );

        $lonDifference = deg2rad(
            $longitude2 - $longitude1
        );

        $a =
            sin($latDifference / 2) ** 2 +
            cos(deg2rad($latitude1)) *
            cos(deg2rad($latitude2)) *
            sin($lonDifference / 2) ** 2;

        $c = 2 * atan2(
            sqrt($a),
            sqrt(1 - $a)
        );

        return $earthRadius * $c;
    }
    /**
 * Calculate delivery charge for selected address.
 */
public function deliveryCharge(Request $request)
{
    $request->validate([
        'address_id' => [
            'required',
            'exists:addresses,id',
        ],
    ]);

    $address = auth()->user()
        ->addresses()
        ->where('id', $request->address_id)
        ->first();

    if (!$address) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid delivery address.',
        ], 403);
    }

    if (
        $address->latitude === null ||
        $address->longitude === null
    ) {
        return response()->json([
            'success' => false,
            'message' => 'Location is not saved for this address.',
        ], 422);
    }

    $cart = Cart::with([
        'items.product.vendor',
    ])
        ->where('user_id', auth()->id())
        ->first();

    if (!$cart || $cart->items->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Your cart is empty.',
        ], 422);
    }

    $subtotal = 0;

    foreach ($cart->items as $item) {

        if (!$item->product) {
            return response()->json([
                'success' => false,
                'message' => 'A product in your cart no longer exists.',
            ], 422);
        }

        $subtotal +=
            (float) $item->price *
            (int) $item->quantity;
    }

    try {

        $distanceKm = $this->calculateCartDistance(
            $cart,
            (float) $address->latitude,
            (float) $address->longitude
        );

        $deliveryCharge =
            $this->deliveryChargeForDistance(
                $distanceKm
            );

        $discount = 0;

        $totalAmount =
            $subtotal +
            $deliveryCharge -
            $discount;

        return response()->json([
            'success' => true,
            'distance_km' => round($distanceKm, 2),
            'delivery_charge' => $deliveryCharge,
            'subtotal' => round($subtotal, 2),
            'discount' => $discount,
            'total_amount' => round($totalAmount, 2),
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 422);
    }
}
}