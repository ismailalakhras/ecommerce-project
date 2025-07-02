@extends('frontend.layout.master')
@section('content')
    <main class="main">
        <div class="container mb-80 mt-50">
            <div class="row title-page-after-header">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Your orders</h1>
                    <div class="d-flex justify-content-between">

                    </div>
                </div>
            </div>


            @if ($orders->isEmpty())
                <div
                    style="font-size: 48px; color: #bfbebe; width: 100%; height: 200px; text-align: center; padding-top: 100px;">
                    You have no orders yet
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive shopping-summery">


                            <table class="table table-wishlist">

                                @foreach ($orders as $order)
                                    <div
                                        style="border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; border-radius: 10px; background-color: #f9f9f9;">

                                        <h3 style="font-size: 20px; color: #333;">
                                            Order #: {{ $order->order_number }}
                                        </h3>

                                        <p style="color: #666;">Status: {{ $order->status }}</p>

                                        <h4 style="margin-top: 15px; color: #444;">Shipping Address:</h4>

                                        <p style="margin: 0;">
                                            {{ optional($order->shipping_address)->first_name }}
                                            {{ optional($order->shipping_address)->last_name }}
                                        </p>
                                        <p style="margin: 0;">{{ optional($order->shipping_address)->address_line_1 }}</p>
                                        <p style="margin-bottom: 10px;">
                                            {{ optional($order->shipping_address)->city }},
                                            {{ optional($order->shipping_address)->country }}
                                        </p>

                                        <h4 style="color: #444;">Items:</h4>
                                        <ul style="padding-left: 20px;">
                                            @foreach ($order->order_items as $item)
                                                <li style="margin-bottom: 5px;">
                                                    {{ $item->product_name }} - {{ $item->quantity }} × ${{ $item->price }}
                                                </li>
                                            @endforeach
                                        </ul>

                                        <h3 style="font-size: 20px; ">
                                            Total price :
                                            <p style="margin-bottom: 10px;"> {{ $order->total_amount }} $</p>
                                        </h3>

                                    </div>
                                @endforeach


                            </table>
                        </div>


                    </div>

                </div>
            @endif

        </div>
    </main>
@endsection
