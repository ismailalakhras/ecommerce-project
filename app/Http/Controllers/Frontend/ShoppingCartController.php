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

        $totalPrice = $shoppingCart->sum('total');

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

            $shoppingCartCount = ShoppingCart::where('user_id', auth()->id())->count();

            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $cartItem->quantity + 1,
                    'total' => $cartItem->total + $cartItem->price,
                ]);

                $total = ShoppingCart::where('user_id', auth()->id())->sum('total');

                return response()->json([
                    'success' => true,
                    'isExists' => true,
                    'title' => 'Success!',
                    'message' => 'Quantity updated successfully',
                    'product' => $product,
                    'cart_count' => $shoppingCartCount,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'total' => $total // ✅ مجموع السلة كامل
                ]);
            } else {
                $shoppingCartCount += 1;

                ShoppingCart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $productId,
                    'price' => $price,
                    'total' => $price,
                ]);

                $total = ShoppingCart::where('user_id', auth()->id())->sum('total');

                return response()->json([
                    'success' => true,
                    'isExists' => false,
                    'title' => 'Success!',
                    'message' => 'Product added to cart successfully',
                    'product' => $product,
                    'cart_count' => $shoppingCartCount,
                    'price' => $price,
                    'total' => $total,
                    'quantity' => 1
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Failed!',
                'message' => 'Something went wrong when adding product to cart',
                'error' => $e->getMessage()
            ], 500);
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

            $total = ShoppingCart::where('user_id', auth()->id())->sum('total');


            return response()->json([
                'success' => true,
                'title' => 'Updated!',
                'message' => 'Quantity updated successfully',
                'quantity' => $cartItem->quantity,
                'totalPriceItem' => $cartItem->total,
                'total'=>$total

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Failed!',
                'message' => 'Something went wrong when update quantity',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy($product)
    {
        try {
            $cartItem = ShoppingCart::where('product_id', $product)
                ->where('user_id', auth()->id())
                ->first();

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'title' => 'Not Found!',
                    'message' => 'Product not found in cart.',

                ], 404);
            }

            $cartItem->delete();

            $shoppingCartCount = ShoppingCart::where('user_id', auth()->id())->count();

            $total = ShoppingCart::where('user_id', auth()->id())->sum('total');


            return response()->json([
                'success' => true,
                'title' => 'Deleted!',
                'message' => 'Product removed from cart successfully.',
                'cart_count' => $shoppingCartCount,
                'product' => $product,
                'total' => $total

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Failed!',
                'message' => 'Something went wrong when deleting product from cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
