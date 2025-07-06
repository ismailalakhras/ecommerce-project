<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderAdminController extends Controller
{
    public function index()
    {
        /** @var User $user */

        $user = auth()->user();

        $orders = Order::with(['order_items.product', 'shipping_address'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.pages.order.index', compact('orders'));
    }
  
     public function destroy(Order $order)
    {
        try {
            $order->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while deleting the order');
        }
        return redirect()->route('admin.order.index')->with('success','order deleted successfully');
    }
}
