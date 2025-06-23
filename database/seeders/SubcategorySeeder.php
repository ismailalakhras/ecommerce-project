<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            // Electronics (category_id = 1)
            ['category_id' => 1, 'name' => 'Smartphones'],
            ['category_id' => 1, 'name' => 'Laptops'],
            ['category_id' => 1, 'name' => 'Tablets'],
            ['category_id' => 1, 'name' => 'Headphones'],
            ['category_id' => 1, 'name' => 'Cameras'],

            // Fashion (category_id = 2)
            ['category_id' => 2, 'name' => 'Men\'s Clothing'],
            ['category_id' => 2, 'name' => 'Women\'s Clothing'],
            ['category_id' => 2, 'name' => 'Footwear'],
            ['category_id' => 2, 'name' => 'Accessories'],
            ['category_id' => 2, 'name' => 'Jewelry'],

            // Home & Garden (category_id = 3)
            ['category_id' => 3, 'name' => 'Furniture'],
            ['category_id' => 3, 'name' => 'Kitchen'],
            ['category_id' => 3, 'name' => 'Garden Tools'],
            ['category_id' => 3, 'name' => 'Decor'],
            ['category_id' => 3, 'name' => 'Lighting'],

            // Books (category_id = 4)
            ['category_id' => 4, 'name' => 'Fiction'],
            ['category_id' => 4, 'name' => 'Non-fiction'],
            ['category_id' => 4, 'name' => 'Children\'s Books'],
            ['category_id' => 4, 'name' => 'Academic'],
            ['category_id' => 4, 'name' => 'Comics'],

            // Sports (category_id = 5)
            ['category_id' => 5, 'name' => 'Outdoor Sports'],
            ['category_id' => 5, 'name' => 'Gym Equipment'],
            ['category_id' => 5, 'name' => 'Cycling'],
            ['category_id' => 5, 'name' => 'Team Sports'],
            ['category_id' => 5, 'name' => 'Water Sports'],
        ];

        $insertData = [];

        foreach ($subcategories as $subcat) {
            $insertData[] = [
                'category_id' => $subcat['category_id'],
                'name' => $subcat['name'],
                'slug' => Str::slug($subcat['name']),
                'description' => 'Description for ' . $subcat['name'],
                'image' => null,
                'is_active' => true,
                'sort_order' => 0,
                'meta_title' => $subcat['name'] . ' Subcategory',
                'meta_description' => 'Explore our collection of ' . $subcat['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Subcategory::insert($insertData);
    }
}
