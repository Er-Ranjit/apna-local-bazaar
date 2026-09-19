<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'vendor@example.com'],
            [
                'name' => 'Local Bazaar Vendor',
                'password' => bcrypt('password'),
                'role' => 'vendor',
            ]
        );

        Vendor::updateOrCreate(
            ['user_id' => $user->id],
            [
                'shop_name' => 'Fresh Mart',
                'phone' => '9876543210',
                'address' => 'Main Market',
                'city' => 'Mohali',
                'image' => null,
                'is_active' => true,
            ]
        );
    }
}