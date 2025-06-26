<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [];
        $subcategories = Subcategory::all();

        foreach ($subcategories as $subcategory) {
            // توليد عدد عشوائي من المنتجات لكل فئة فرعية (بين 1 و10)
            $productCount = rand(1, 10);

            for ($i = 1; $i <= $productCount; $i++) {
                $productName = "Product{$i}-from {$subcategory->name}";

                $costPrice = rand(20, 300);
                $salePrice = $costPrice * (1 + rand(20, 40) / 100);
                $price = $salePrice * (1 + rand(5, 35) / 100);

                $stockQty = rand(0, 100);

                $products[] = [
                    'category_id' => $subcategory->category_id,
                    'subcategory_id' => $subcategory->id,
                    'name' => $productName,
                    'slug' => Str::slug($productName) . '-' . uniqid(),
                    'description' => "Long description for $productName.",
                    'short_description' => "Short description for $productName.",
                    'sku' => strtoupper(Str::random(8)),
                    'price' => round($price, 2),
                    'sale_price' => round($salePrice, 2),
                    'cost_price' => round($costPrice, 2),
                    'stock_quantity' => $stockQty,
                    'min_quantity' => 1,
                    'weight' => rand(1, 10),
                    'dimensions' => rand(10, 50) . 'x' . rand(10, 50) . 'x' . rand(10, 50),
                    'is_active' => true,
                    'is_featured' => (bool)rand(0, 1),
                    'manage_stock' => true,
                    'stock_status' => $stockQty > 0 ? 'in_stock' : ['out_of_stock', 'on_backorder'][rand(0, 1)],
                    'image' => 'products/sample.jpg',
                    'gallery' => json_encode(['products/gallery1.jpg', 'products/gallery2.jpg']),
                    'meta_title' => $productName,
                    'meta_description' => "Buy $productName online.",
                    'rating_average' => rand(0, 50) / 10,
                    'rating_count' => rand(0, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Product::insert($products);
    }
}
