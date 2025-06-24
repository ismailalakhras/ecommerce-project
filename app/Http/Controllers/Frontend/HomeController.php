<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shopping_cart;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->get();
        $featuredProducts = Product::where('is_featured', true)->take(8)->get();
        $shoppingCart = Shopping_cart::where('user_id', auth()->user()->id)->get();

        return view('frontend.pages.home', compact('categories', 'featuredProducts', 'shoppingCart'));
    }
}
