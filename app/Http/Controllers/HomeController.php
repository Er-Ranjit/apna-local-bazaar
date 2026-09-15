<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;

class HomeController extends Controller
{
    private function nearbyVendorIds()
    {
        $user = auth()->user();

        if (!$user || $user->latitude === null || $user->longitude === null) {
            return null;
        }

        $latitude = (float) $user->latitude;
        $longitude = (float) $user->longitude;

        return Vendor::query()
            ->where('is_active', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereRaw(
                '(6371 * acos(
                    cos(radians(?))
                    * cos(radians(latitude))
                    * cos(radians(longitude) - radians(?))
                    + sin(radians(?))
                    * sin(radians(latitude))
                )) <= 10',
                [
                    $latitude,
                    $longitude,
                    $latitude,
                ]
            )
            ->pluck('id');
    }

    public function index()
    {
        $categories = Category::where('is_active', true)
            ->latest()
            ->get();

        $productsQuery = Product::where('is_active', true)
            ->where('is_available', true)
            ->with(['vendor', 'category']);

        $vendorsQuery = Vendor::where('is_active', true);

        $nearbyVendorIds = $this->nearbyVendorIds();

        if ($nearbyVendorIds !== null) {
            $productsQuery->whereIn('vendor_id', $nearbyVendorIds);
            $vendorsQuery->whereIn('id', $nearbyVendorIds);
        }

        $products = $productsQuery
            ->latest()
            ->take(10)
            ->get();

        $vendors = $vendorsQuery
            ->latest()
            ->take(6)
            ->get();

        $cartCount = 0;

        if (auth()->check()) {
            $cartCount = CartItem::whereHas('cart', function ($query) {
                $query->where('user_id', auth()->id());
            })->sum('quantity');
        }

        return view(
            'home',
            compact(
                'categories',
                'products',
                'vendors',
                'cartCount'
            )
        );
    }

    public function category(Category $category)
    {
        $productsQuery = $category->products()
            ->where('is_active', true)
            ->where('is_available', true)
            ->with(['vendor', 'category']);

        $nearbyVendorIds = $this->nearbyVendorIds();

        if ($nearbyVendorIds !== null) {
            $productsQuery->whereIn('vendor_id', $nearbyVendorIds);
        }

        $products = $productsQuery
            ->latest()
            ->get();

        return view(
            'category',
            compact('category', 'products')
        );
    }

    public function product(Product $product)
    {
        if (!$product->is_active || !$product->is_available) {
            abort(404);
        }

        $product->load([
            'vendor',
            'category',
        ]);

        $nearbyVendorIds = $this->nearbyVendorIds();

        if (
            $nearbyVendorIds !== null &&
            !$nearbyVendorIds->contains($product->vendor_id)
        ) {
            abort(404);
        }

        $relatedProductsQuery = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->where('is_available', true);

        if ($nearbyVendorIds !== null) {
            $relatedProductsQuery->whereIn('vendor_id', $nearbyVendorIds);
        }

        $relatedProducts = $relatedProductsQuery
            ->latest()
            ->take(4)
            ->get();

        $cartCount = 0;

        if (auth()->check()) {
            $cartCount = CartItem::whereHas('cart', function ($query) {
                $query->where('user_id', auth()->id());
            })->sum('quantity');
        }

        return view(
            'products.show',
            compact(
                'product',
                'relatedProducts',
                'cartCount'
            )
        );
    }
}