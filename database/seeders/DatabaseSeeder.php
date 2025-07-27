<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleUserSeeder::class);
        

        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);

        $this->call(ProductSeeder::class);
        $this->call(ProductImageSeeder::class);

        $this->call(CouponSeeder::class);

        $this->call(ShippingAdressSeeder::class);

        $this->call(OrderSeeder::class);
        $this->call(OrderItemSeedr::class);

        $this->call(ShoppingCartSeeder::class);
        $this->call(MessageSeeder::class);

    }
}
