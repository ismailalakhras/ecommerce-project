<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shopping_cart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $shoppingCart = Shopping_cart::where('user_id', auth()->user()->id)->get();

        $categories = Category::with('subcategories')->get();


        return view('frontend.pages.cart', compact('shoppingCart', 'categories'));
    }

    public function store(Request $request, $productId)
    {
        try {
            $product = Product::findOrFail($productId);

            $price = $product->price;

            Shopping_cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $productId,
                'price' => $price,
                'total' => $price

            ]);
        } catch (\Exception $e) {
             dd($e->getMessage());
        }

        return redirect()->route('home');
    }
}
