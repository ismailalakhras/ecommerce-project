<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Product;
use App\Models\ShoppingCart;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['subcategories'])->get();
        $featuredProducts = Product::where('is_featured', true)->take(8)->get();
        $shoppingCart = ShoppingCart::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->get();

        $hotDealsProducts = Product::select('*')
            ->whereColumn('price', '>', 'sale_price')
            ->orderByRaw('(price - sale_price) DESC')
            ->take(3)
            ->get();

        $topRatedProducts = Product::select('*')
            ->orderBy('rating_average', 'DESC')
            ->take(3)
            ->get();



        $specialDealsProducts = Product::select('*')
            ->whereNotNull('sale_price')
            ->whereColumn('price', '>', 'sale_price')
            ->where('rating_average', '>', 4)
            ->orderByRaw('(price - sale_price) DESC')
            ->take(3)
            ->get();


        $RecentlyAddedProducts = Product::latest('created_at')
            ->take(3)
            ->get();


        return view('frontend.pages.home', compact('categories', 'hotDealsProducts', 'topRatedProducts', 'RecentlyAddedProducts', 'specialDealsProducts', 'featuredProducts',  'shoppingCart'));
    }
}
