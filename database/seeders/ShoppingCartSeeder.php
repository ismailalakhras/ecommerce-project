<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shopping_cart;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShoppingCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users = User::all();
        $products = Product::all();

        if ($users->count() === 0 || $products->count() === 0) {
            $this->command->warn('Users or Products table is empty. Skipping ShoppingCartSeeder.');
            return;
        }

        foreach ($users as $user) {
            $randomProducts = $products->random(2);

            foreach ($randomProducts as $product) {
                $quantity = rand(1, 3);
                $price = $product->price;
                $total = $price * $quantity;

                Shopping_cart::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => $total,
                ]);
            }
        }
    }
}
