@extends('frontend.layout.master')
@section('content')
    <main class="main">
        <div class="container mb-80 mt-50">
            <div class="row title-page-after-header">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Your Cart</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are <span class="text-brand">{{ $shoppingCart->count() }}</span> products
                            in your cart</h6>

                    </div>
                </div>
            </div>

            @if ($shoppingCart->isEmpty())
                <div
                    style="font-size: 48px; color: #bfbebe; width: 100%; height: 200px; text-align: center; padding-top: 100px;">
                    No Items in your cart
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive shopping-summery">


                            <table class="table table-wishlist">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col" colspan="2">Product</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col" class="end">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    @foreach ($shoppingCart as $product)
                                        <tr class="pt-30 ismail-cart-tr product-to-delete-{{$product->product->id}}" >

                                            <td class="image product-thumbnail pt-40"><img
                                                    src="{{ $product->product->image }}" alt="#"></td>
                                            <td class="product-des product-name">
                                                <h6 class="mb-5"><a class="product-name mb-10 text-heading"
                                                        href="shop-product-right.html">{{ $product->product->name }}</a>
                                                </h6>
                                                <div class="product-rate-cover">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ $product->product->rating_average }})
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="price" data-title="Price">
                                                <h4 class="text-body">${{ $product->price }} </h4>
                                            </td>
                                            <td class="text-center detail-info" data-title="Stock">
                                                <div class="detail-extralink mr-15">

                                                    <div class="detail-qty border radius">
                                                        <a href="" class="qty-down"
                                                            data-id="{{ $product->product->id }}"
                                                            data-url="{{ route('cart.update', $product->product->id) }}">
                                                            <i class="fi-rs-angle-small-down"></i>
                                                        </a>

                                                        <input id="qty-val-{{ $product->product->id }}" type="text"
                                                            name="quantity" class="qty-val "
                                                            value="{{ $product->quantity }}" min="1">

                                                        <a href="" class="qty-up"
                                                            data-id="{{ $product->product->id }}"
                                                            data-url="{{ route('cart.update', $product->product->id) }}">
                                                            <i class="fi-rs-angle-small-up"></i>
                                                        </a>
                                                    </div>

                                                </div>
                                            </td>
                                            <td class="price " id="totalPriceItem-{{ $product->product->id }}"
                                                data-title="Price">
                                                <h4 class="text-brand">${{ $product->total }} </h4>
                                            </td>
                                            <td class="action text-center" data-title="Remove">

                                                <button class="delete-btn" data-id="{{ $product->product->id }}"
                                                    type="button"><i style="font-size:20px"
                                                        class="fi-rs-trash"></i>Delete</button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-50">
                            <div class="col-lg-5">
                                <div class="p-40">
                                    <h4 class="mb-10">Apply Coupon</h4>
                                    <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
                                    <form action="{{ route('coupon') }}" method="POST">
                                        @CSRF
                                        @method('PUT')
                                        <div class="d-flex justify-content-between">
                                            <input class="font-medium mr-15 coupon" type="text" name="code"
                                                placeholder="Enter Your Coupon">
                                            <button class="btn"><i class="fi-rs-label mr-10"></i>Apply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <div class="divider-2 mb-30"></div>
                                <div class="border p-md-4 cart-totals ml-30">
                                    <div class="table-responsive">
                                        <table class="table no-border">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">
                                                        <h6 class="text-muted">Subtotal</h6>
                                                    </td>
                                                    <td class="cart_total_amount ">
                                                        <h4 class="text-brand text-end cart-subtotal-price total-price-cart">
                                                            ${{ $totalPrice }}</h4>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="cart_total_label">
                                                        <h6 class="text-muted">Shipping</h6>
                                                    </td>
                                                    <td class="cart_total_amount">
                                                        <h5 class="text-heading text-end">Free</h4>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td class="cart_total_label">
                                                        <h6 class="text-muted">Copon discount</h6>
                                                    </td>
                                                    <td class="cart_total_amount">
                                                        @if (session('discount') > 0)
                                                            <h4 class="text-brand text-end">
                                                                ${{ ($totalPrice * session('discount')) / 100 }}
                                                            </h4>
                                                        @else
                                                            <h4 class="text-brand text-end">0</h4>
                                                        @endif
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td class="cart_total_label">
                                                        <h6 class="text-muted">Estimate for</h6>
                                                    </td>
                                                    <td class="cart_total_amount">
                                                        <h5 class="text-heading text-end">United Kingdom</h5>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="cart_total_label">
                                                        <h6 class="text-muted">Total</h6>
                                                    </td>
                                                    <td class="cart_total_amount ">
                                                        @if (session('discount') > 0)
                                                            <h4 class="text-brand text-end">
                                                                ${{ $totalPrice - ($totalPrice * session('discount')) / 100 }}
                                                            </h4>
                                                        @else
                                                            <h4 class="text-brand text-end cart-total-price total-price-cart">
                                                                ${{ $totalPrice }}</h4>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    {{-- Shipping addresses form --}}

                                    <div class="row" id="shipping_addresses_form" style="display: none">

                                        <div class="row title-page-after-header"
                                            style="height: 75px; --bs-gutter-x: 0; padding: 20px 10px; border-radius: 0;">

                                            <h4 class="mb-30">Shipping addresses</h4>
                                        </div>
                                        <form method="POST" action="{{ route('order.store') }}"
                                            class="shipping_addresses">
                                            @csrf

                                            <label>First Name <span style="color: red ; margin-bottom:5px">*</span></label>
                                            <input type="text" name="first_name" required>

                                            <label>Last Name <span style="color: red ; margin-bottom:5px">*</span></label>
                                            <input type="text" name="last_name" required>

                                            <label>Company</label>
                                            <input type="text" name="company">

                                            <label>Address Line 1 <span
                                                    style="color: red ; margin-bottom:5px">*</span></label>
                                            <input type="text" name="address_line_1" required>

                                            <label>Address Line 2</label>
                                            <input type="text" name="address_line_2">

                                            <label>City <span style="color: red ; margin-bottom:5px">*</span></label>
                                            <input type="text" name="city" required>

                                            <label>State</label>
                                            <input type="text" name="state">

                                            <label>Postal Code <span
                                                    style="color: red ; margin-bottom:5px">*</span></label>
                                            <input type="text" name="postal_code" required>

                                            <label>Country <span style="color: red ; margin-bottom:5px">*</span></label>
                                            <input type="text" name="country" required>

                                            <label>Phone</label>
                                            <input type="text" name="phone">


                                            @if (session('discount') > 0)
                                                <input type="hidden" name="total"
                                                    value="{{ $totalPrice - ($totalPrice * session('discount')) / 100 }}">
                                            @else
                                                <input class="hidden-total-price" type="hidden" name="total" value="{{ $totalPrice }}">
                                            @endif


                                            <input type="hidden" name="discount" value="{{ session('discount') }}">


                                            <button type="submit" class="btn mb-20 w-100"> Order now
                                                <i class="fi-rs-sign-out ml-15 "></i>
                                            </button>
                                        </form>
                                    </div>


                                    <a id="Proceed_to_checkout" class="btn mb-20 w-100">Proceed To CheckOut<i
                                            class="fi-rs-sign-out ml-15"></i></a>
                                </div>
                            </div>





                        </div>
                    </div>

                </div>
            @endif

        </div>
    </main>
@endsection
