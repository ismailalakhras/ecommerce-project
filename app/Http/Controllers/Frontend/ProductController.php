<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productsByCategoryId($id)
    {
        $products = Product::where('category_id', $id)->get();

        $categories = Category::with(['subcategories'])->get();


        return view('frontend.pages.products',compact('categories'));
    }
}
