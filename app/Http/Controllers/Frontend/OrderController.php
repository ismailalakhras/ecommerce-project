<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shopping_cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;


class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::all();

        return view('frontend.pages.order.index', compact('orders'));
    }



    public function create()
    {

       
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

        $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);

        $order = $user->orders()->create([
            'order_number' => strtoupper(Str::random(10)),
            'total_amount' => $subtotal,
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


        return redirect()->route('order.index')->with('success', 'Order placed successfully.');
    }







    public function edit(Order $order)
    {
        return view('frontend.pages.order.edit', compact('order'));
    }



    public function update(Request $request, Order $order)
    {
        toast()->position('top');

        try {
            // Validate input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ], [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name must not exceed 255 characters.',
            ]);

            $order->update($validatedData);

            Alert::success('Success', 'Order updated successfully');
        } catch (ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            Alert::error('Error', $firstError)->autoClose(8000);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while updating the order')->autoClose(8000);
        }

        return redirect()->route('order.index');
    }



    public function destroy(Order $order)
    {
        toast()->position('top');

        try {
            $order->delete();
            toast()->position('top');

            Alert::success('Deleted', 'Order deleted successfully')->autoClose(8000);
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while deleting the order')->autoClose(8000);
        }

        return redirect()->route('order.index');
    }
}
