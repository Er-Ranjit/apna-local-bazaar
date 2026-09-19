<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $vendor = Vendor::where('shop_name', 'Fresh Mart')->first();

        $fastFood = Category::where('slug', 'fast-food')->first();
        $fruits = Category::where('slug', 'fruits-vegetables')->first();
        $kirana = Category::where('slug', 'kirana')->first();

        if (!$vendor || !$fastFood || !$fruits || !$kirana) {
            return;
        }

        $products = [
            [
                'name' => 'Cheese Burger',
                'slug' => 'cheese-burger',
                'category_id' => $fastFood->id,
                'price' => 120,
                'discount_price' => 99,
                'description' => 'Fresh and tasty cheese burger',
                'image' => null,
                'stock' => 50,
            ],
            [
                'name' => 'Fresh Apples',
                'slug' => 'fresh-apples',
                'category_id' => $fruits->id,
                'price' => 180,
                'discount_price' => 160,
                'description' => 'Fresh quality apples',
                'image' => null,
                'stock' => 100,
            ],
            [
                'name' => 'Basmati Rice',
                'slug' => 'basmati-rice',
                'category_id' => $kirana->id,
                'price' => 220,
                'discount_price' => 199,
                'description' => 'Premium quality basmati rice',
                'image' => null,
                'stock' => 75,
            ],
            [
                'name' => 'Veg Pizza',
                'slug' => 'veg-pizza',
                'category_id' => $fastFood->id,
                'price' => 250,
                'discount_price' => 219,
                'description' => 'Fresh vegetable pizza',
                'image' => null,
                'stock' => 40,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                [
                    'vendor_id' => $vendor->id,
                    'category_id' => $product['category_id'],
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'discount_price' => $product['discount_price'],
                    'image' => $product['image'],
                    'stock' => $product['stock'],
                    'is_available' => true,
                    'is_active' => true,
                ]
            );
        }
    }
}