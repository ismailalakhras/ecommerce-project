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
        $categories = Category::with('subcategories')->get();

        $shoppingCart = Shopping_cart::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->get();


        return view('frontend.pages.productsByCategory', compact('categories', 'shoppingCart', 'products', 'productsCount'));
    }


    public function productsBySubcategoryId($id)
    {
        $products = Product::where('subcategory_id', $id)
            ->orderBy('price', 'asc')
            ->paginate(10);

        $productsCount = Product::where('subcategory_id', $id)->count();

        $categories = Category::with('subcategories')->get();

        $shoppingCart = Shopping_cart::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->get();


        return view('frontend.pages.productsBySubcategory', compact('categories', 'shoppingCart', 'products', 'productsCount'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('frontend.pages.product' , compact('product'));
    }
}
