<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;


use App\Models\Product;
use App\Models\ShoppingCart;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $shoppingCart = ShoppingCart::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();

        $totalPrice = 0;

        foreach ($shoppingCart as $product) {
            $totalPrice += $product->total;
        }

        return view('frontend.pages.cart', compact('shoppingCart', 'totalPrice'));
    }



    public function store($productId)
    {
        try {

            $product = Product::findOrFail($productId);

            $price = $product->sale_price;

            $cartItem = ShoppingCart::where('product_id', $productId)
                ->where('user_id', auth()->id())
                ->first();


            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $cartItem->quantity + 1,
                    'total' => $cartItem->total + $cartItem->price,
                ]);
                return redirect()->back()->with('success', 'This product is already in your cart. Quantity increased by 1');
            } else {
                ShoppingCart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $productId,
                    'price' => $price,
                    'total' => $price
                ]);
                return redirect()->back()->with('success', 'product added to cart successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'something error when add product to cart');
        }
    }



    public function update(Request $request, $productId)
    {
        try {

            $cartItem = ShoppingCart::where('product_id', $productId)
                ->where('user_id', auth()->id())
                ->first();


            $cartItem->update([
                'quantity' => $request->quantity,
                'total' =>  $cartItem->price * $request->quantity,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'something error when add product to cart');
        }

        return redirect()->back()->with('success', 'Quantity increased by 1');
    }


    public function destroy($productId)
    {
        $cartItem = ShoppingCart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Product has been deleted successfully ');
        }

        return redirect()->back()->with('error', 'Product not found');
    }
}
