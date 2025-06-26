<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;


use App\Models\Product;
use App\Models\Shopping_cart;


use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $shoppingCart = Shopping_cart::where('user_id', auth()->user()->id)->get();

        $totalPrice = 0;
        
        foreach ($shoppingCart as $product) {
            $totalPrice += $product->total;
        }

        return view('frontend.pages.cart', compact('shoppingCart', 'totalPrice'));
    }



    public function store(Request $request, $productId)
    {
        try {

            $product = Product::findOrFail($productId);

            $price = $product->price;

            Shopping_cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'price' => $price,
                'total' => $price

            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect()->back()->with('success', 'success');
    }



    public function destroy($productId)
    {
        $cartItem = Shopping_cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Product has been deleted successfully ');
        }

        return redirect()->back()->with('error', 'Product not found');
    }
}
