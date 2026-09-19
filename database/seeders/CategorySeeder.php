<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::updateOrCreate(
            ['slug' => 'fast-food'],
            [
                'name' => 'Fast Food',
                'image' => null,
                'description' => 'Pizza, Burger, Momos and other fast food items',
                'is_active' => true,
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'fruits-vegetables'],
            [
                'name' => 'Fruits & Vegetables',
                'image' => null,
                'description' => 'Fresh fruits and vegetables',
                'is_active' => true,
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'kirana'],
            [
                'name' => 'Kirana',
                'image' => null,
                'description' => 'Daily grocery and household items',
                'is_active' => true,
            ]
        );
    }
}