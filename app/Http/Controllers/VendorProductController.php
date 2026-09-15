<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VendorProductController extends Controller
{
    public function edit(Product $product)
    {
        if ($product->vendor_id !== auth()->user()->vendor->id) {
            abort(403);
        }

        $categories = Category::where('is_active', true)
            ->latest()
            ->get();

        return view('vendor.products.edit', compact(
            'product',
            'categories'
        ));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->vendor_id !== auth()->user()->vendor->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('products', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $product->id,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('vendor.dashboard')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->vendor_id !== auth()->user()->vendor->id) {
            abort(403);
        }

        $product->delete();

        return redirect()
            ->route('vendor.dashboard')
            ->with('success', 'Product deleted successfully.');
    }
}
