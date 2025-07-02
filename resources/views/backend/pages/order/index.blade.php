@extends('backend.layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Orders Overview</h5>
                        </div>
                        <div class="font-22 ms-auto">
                            <a href="{{ route('admin.order.create') }}" class="btn btn-warning text-white">
                                <i class="bx bx-layer-plus"></i> insert
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive" style="max-height: calc(100vh - 14.5rem); overflow-y: auto;">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="position: sticky ; top:0"></th>
                                    <th style="position: sticky ; top:0">Order number</th>
                                    <th style="position: sticky ; top:0">Items</th>



                                    <th style="position: sticky ; top:0">Customer name</th>
                                    <th style="position: sticky ; top:0">Shipping address</th>

                                    <th style="position: sticky ; top:0">Status</th>

                                    <th style="position: sticky ; top:0">Shipping amount</th>
                                    <th style="position: sticky ; top:0">Discount amount</th>
                                    <th style="position: sticky ; top:0">Tax amount</th>
                                    <th style="position: sticky ; top:0">Total amount</th>



                                    <th style="position: sticky ; top:0">Created_at</th>
                                    <th style="position: sticky ; top:0">Updated_at</th>
                                </tr>
                            </thead>
                            <tbody>



                                @foreach ($orders as $order)
                                    <tr>

                                        <td style="background: #0000000a  !important ; padding:0">
                                            <div class="d-flex order-actions">
                                                <form action="{{ route('admin.order.delete', $order->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-btn btn btn-sm mb-0 px-2 py-1"
                                                        title="Delete">
                                                        <a href="">
                                                            <i class="far fa-trash-alt text-danger"
                                                                style="font-size: 1.1rem">
                                                            </i>
                                                        </a>
                                                    </button>
                                                </form>


                                                <form method="GET" action="{{ route('admin.order.edit', $order->id) }}">
                                                    @csrf

                                                    <button type="submit"class="update-btn btn btn-sm  mb-0 px-2 py-1 ">
                                                        <a href="javascript:;" class="ms-4" style="margin: 0 !important">
                                                            <i class="fas fa-edit text-success" style="font-size: 1.1rem">
                                                            </i>
                                                        </a>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                        <td >{{ $order->order_number }} </td>

                                        <td>
                                            <ul style="padding-left: 0px;">
                                                @foreach ($order->order_items as $item)
                                                    <li style="margin-bottom: 5px; list-style-type: none;">

                                                        <div class="d-flex align-items-center">
                                                            <div class="recent-product-img">
                                                                <img src="{{ asset($item->product->image) }}"
                                                                    alt="">
                                                            </div>
                                                            <div class="ms-2">
                                                                <h6 class="mb-1 font-14"> {{ $item->product_name }} -
                                                                    {{ $item->quantity }} ×
                                                                    ${{ $item->price }}</h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>



                                        <td>
                                            {{ optional($order->shipping_address)->first_name }}
                                            {{ optional($order->shipping_address)->last_name }}
                                        </td>


                                        <td>

                                            <p>
                                                <span style="font-weight: 600">Street:</span>
                                                {{ optional($order->shipping_address)->address_line_1 }}
                                            </p>

                                            <p>
                                                <span style="font-weight: 600">City:</span>
                                                {{ optional($order->shipping_address)->city }}
                                            </p>

                                            <p>
                                                <span style="font-weight: 600">Country:</span>
                                                {{ optional($order->shipping_address)->country }}
                                            </p>
                                        </td>

                                        <td>{{ $order->status }}</td>

                                        <td>{{ $order->shipping_amount }}</td>
                                        <td>{{ $order->discount_amount }}</td>
                                        <td>{{ $order->tax_amount }}</td>
                                        <td>{{ $order->total_amount }}</td>



                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->updated_at }}</td>



                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
