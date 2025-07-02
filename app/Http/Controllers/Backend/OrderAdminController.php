<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderAdminController extends Controller
{
    public function index()
    {
        /** @var User $user */

        $user = auth()->user();

        $orders = $user->orders()
            ->with(['order_items.product', 'shipping_address'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.pages.order.index', compact('orders'));
    }

    public function create() {}

    public function store() {}


    public function edit() {}


    public function update() {}


     public function destroy(Order $order)
    {
        try {
            $order->delete();
            toast()->position('top');
            Alert::success('Deleted','order number' . $order->order_number . ' deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while deleting the order')->autoClose(8000);
        }

        return redirect()->route('admin.order.index');
    }
}
