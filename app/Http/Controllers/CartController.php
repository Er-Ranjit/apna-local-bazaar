<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private const DELIVERY_RADIUS_KM = 10;

    public function index()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        $cart->load('items.product.category');

        $subtotal = $cart->items->sum(function ($item) {
            return (float) $item->price * (int) $item->quantity;
        });

        return view('cart.index', compact('cart', 'subtotal'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        if (
            !$product->is_active ||
            !$product->is_available ||
            $product->stock <= 0
        ) {
            return back()->with(
                'error',
                'This product is currently unavailable.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Customer Location Check
        |--------------------------------------------------------------------------
        */

        $user = auth()->user();

        if (
            $user->latitude === null ||
            $user->longitude === null
        ) {
            return back()->with(
                'error',
                'Please set your location before adding products to cart.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Vendor Check
        |--------------------------------------------------------------------------
        */

        $product->load('vendor');

        if (!$product->vendor) {
            return back()->with(
                'error',
                'Vendor for this product was not found.'
            );
        }

        if (
            $product->vendor->latitude === null ||
            $product->vendor->longitude === null
        ) {
            return back()->with(
                'error',
                'This store has not set its delivery location yet.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 10 KM Distance Check
        |--------------------------------------------------------------------------
        */

        $distance = $this->distanceInKm(
            (float) $user->latitude,
            (float) $user->longitude,
            (float) $product->vendor->latitude,
            (float) $product->vendor->longitude
        );

        if ($distance > self::DELIVERY_RADIUS_KM) {
            return back()->with(
                'error',
                'This product is outside our 10 KM delivery area.'
            );
        }

        $quantity = (int) ($request->quantity ?? 1);

        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $newQuantity = (int) $item->quantity + $quantity;

            if ($newQuantity > (int) $product->stock) {
                return back()->with(
                    'error',
                    'Only ' . $product->stock . ' items are available in stock.'
                );
            }

            $item->quantity = $newQuantity;
            $item->save();
        } else {

            if ($quantity > (int) $product->stock) {
                return back()->with(
                    'error',
                    'Only ' . $product->stock . ' items are available in stock.'
                );
            }

            $price = $product->discount_price ?? $product->price;

            $newItem = new CartItem();

            $newItem->cart_id = $cart->id;
            $newItem->product_id = $product->id;
            $newItem->quantity = $quantity;
            $newItem->price = $price;

            $newItem->save();
        }

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Product added to cart.'
            );
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $product = $cartItem->product;

        if (!$product) {
            return back()->with(
                'error',
                'Product not found.'
            );
        }

        if (
            !$product->is_active ||
            !$product->is_available
        ) {
            return back()->with(
                'error',
                'This product is unavailable.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Customer Location
        |--------------------------------------------------------------------------
        */

        $user = auth()->user();

        if (
            $user->latitude === null ||
            $user->longitude === null
        ) {
            return back()->with(
                'error',
                'Please set your location before updating your cart.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Vendor Location
        |--------------------------------------------------------------------------
        */

        $product->load('vendor');

        if (!$product->vendor) {
            return back()->with(
                'error',
                'Vendor for this product was not found.'
            );
        }

        if (
            $product->vendor->latitude === null ||
            $product->vendor->longitude === null
        ) {
            return back()->with(
                'error',
                'This store has not set its delivery location yet.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 10 KM Check
        |--------------------------------------------------------------------------
        */

        $distance = $this->distanceInKm(
            (float) $user->latitude,
            (float) $user->longitude,
            (float) $product->vendor->latitude,
            (float) $product->vendor->longitude
        );

        if ($distance > self::DELIVERY_RADIUS_KM) {
            return back()->with(
                'error',
                'This product is outside our 10 KM delivery area.'
            );
        }

        $quantity = (int) $request->quantity;
        $stock = (int) $product->stock;

        if ($quantity > $stock) {
            return back()->with(
                'error',
                'Only ' . $stock . ' items are available in stock.'
            );
        }

        $cartItem->quantity = $quantity;
        $cartItem->save();

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Cart updated successfully.'
            );
    }

    public function remove(CartItem $cartItem)
    {
        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Product removed from cart.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Haversine Distance
    |--------------------------------------------------------------------------
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
}