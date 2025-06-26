<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Electronics',
                'slug' => Str::slug('Electronics'),
                'description' => 'Devices, gadgets, and accessories.',
                'image' => 'images/electronics.svg',
                'is_active' => true,
                'sort_order' => 1,
                'meta_title' => 'Shop Electronics',
                'meta_description' => 'Find the best electronics at affordable prices.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fashion',
                'slug' => Str::slug('Fashion'),
                'description' => 'Clothing, shoes, and accessories for men and women.',
                'image' => 'images/fashion.svg',
                'is_active' => true,
                'sort_order' => 2,
                'meta_title' => 'Explore Fashion Trends',
                'meta_description' => 'Stay stylish with our latest fashion collections.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Books',
                'slug' => Str::slug('Books'),
                'description' => 'Wide range of fiction and non-fiction books.',
                'image' => 'images/books.svg',
                'is_active' => true,
                'sort_order' => 3,
                'meta_title' => 'Books and Novels',
                'meta_description' => 'Discover your next great read.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Home Appliances',
                'slug' => Str::slug('Home Appliances'),
                'description' => 'Kitchen and home appliances for everyday use.',
                'image' => 'images/home_appliances.svg',
                'is_active' => true,
                'sort_order' => 4,
                'meta_title' => 'Top Home Appliances',
                'meta_description' => 'Equip your home with modern appliances.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sports & Fitness',
                'slug' => Str::slug('Sports & Fitness'),
                'description' => 'Workout gear, accessories, and sports equipment.',
                'image' => 'images/sports.svg',
                'is_active' => true,
                'sort_order' => 5,
                'meta_title' => 'Fitness Essentials',
                'meta_description' => 'Everything you need for an active lifestyle.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
