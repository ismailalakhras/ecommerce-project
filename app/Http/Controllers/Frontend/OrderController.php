<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Shopping_cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class OrderController extends Controller
{

    public function index()
    {
        /** @var User $user */

        $user = auth()->user();

        $orders = $user->orders()
            ->with(['order_items.product', 'shipping_address'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.pages.order', compact('orders'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'company' => 'nullable|string|max:100',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = auth()->user();
        $cartItems = Shopping_cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        /** @var User $user */
        $order = $user->orders()->create([
            'order_number' => strtoupper(Str::random(10)),
            'total_amount' => $request->total,
            'currency' => 'USD',
            'payment_status' => 'pending',
            'status' => 'pending',
        ]);

        $order->shipping_address()->create($request->all());

        foreach ($cartItems as $item) {
            $order->order_items()->create([
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'product_sku' => $item->product->sku ?? 'N/A',
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->price * $item->quantity,
            ]);
        }

        Shopping_cart::where('user_id', $user->id)->delete();

        return redirect()->route('cart.index')->with('success', 'Order placed successfully.');
    }
}
