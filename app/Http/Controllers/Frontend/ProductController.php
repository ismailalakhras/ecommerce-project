<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shopping_cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productsByCategoryId($id)
    {
        $products = Product::where('category_id', $id)
            ->orderBy('price', 'asc')
            ->paginate(10);


        $productsCount = Product::where('category_id', $id)->count();
        $categories = Category::with(['subcategories'])->get();

        $shoppingCart = Shopping_cart::where('user_id', auth()->id())->get();



        return view('frontend.pages.products', compact('categories', 'shoppingCart', 'products', 'productsCount'));
    }
}
