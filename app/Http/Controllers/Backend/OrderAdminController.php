<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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


    public function destroy() {}
}
