<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Full access to the system',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'seller',
                'display_name' => 'Seller',
                'description' => 'Can manage products and view orders',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'customer',
                'display_name' => 'Customer',
                'description' => 'Can browse and buy products',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
