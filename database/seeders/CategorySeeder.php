<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Fast Food',
            'slug' => 'fast-food',
            'image' => null,
            'description' => 'Pizza, Burger, Momos and other fast food items',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Fruits & Vegetables',
            'slug' => 'fruits-vegetables',
            'image' => null,
            'description' => 'Fresh fruits and vegetables',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Kirana',
            'slug' => 'kirana',
            'image' => null,
            'description' => 'Daily grocery and household items',
            'is_active' => true,
        ]);
    }
}
