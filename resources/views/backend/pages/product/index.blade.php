@extends('backend.layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Products Overview</h5>
                        </div>
                        <div class="font-22 ms-auto">
                            <a href="{{ route('admin.product.create') }}" class="btn btn-warning text-white">
                                <i class="bx bx-layer-plus"></i> insert
                            </a>

                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive" style="max-height: calc(100vh - 14.5rem); overflow-y: auto;">
                        <table  id="searchTable" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="position: sticky ; top:0"></th>

                                    <th style="position: sticky ; top:0">Product id</th>
                                    <th style="position: sticky ; top:0">Name</th>
                                    <th style="position: sticky ; top:0">Category id</th>
                                    <th style="position: sticky ; top:0">Subcategory id</th>
                                    <th style="position: sticky ; top:0">Slug</th>
                                    <th style="position: sticky ; top:0">Description</th>
                                    <th style="position: sticky ; top:0">Short Description</th>


                                    <th style="position: sticky ; top:0">sku </th>
                                    <th style="position: sticky ; top:0">price</th>
                                    <th style="position: sticky ; top:0">sale_price </th>
                                    <th style="position: sticky ; top:0">cost_price</th>
                                    <th style="position: sticky ; top:0">stock_quantity</th>
                                    <th style="position: sticky ; top:0">min_quantity</th>
                                    <th style="position: sticky ; top:0">weight</th>
                                    <th style="position: sticky ; top:0">dimensions</th>

                                    <th style="position: sticky ; top:0">is_active</th>
                                    <th style="position: sticky ; top:0">is_featured</th>
                                    <th style="position: sticky ; top:0">manage_stock</th>
                                    <th style="position: sticky ; top:0">stock_status</th>
                                    <th style="position: sticky ; top:0">image</th>
                                    <th style="position: sticky ; top:0">meta_title</th>
                                    <th style="position: sticky ; top:0">meta_description</th>
                                    <th style="position: sticky ; top:0">rating_average</th>
                                    <th style="position: sticky ; top:0">rating_count</th>

                                    <th style="position: sticky ; top:0">created_at</th>
                                    <th style="position: sticky ; top:0">updated_at</th>
                                </tr>
                            </thead>
                            <tbody>



                                @foreach ($products as $product)
                                    <tr>

                                        <td style="background: #0000000a  !important ; padding:0">
                                            <div class="d-flex order-actions">


                                                <form action="{{ route('admin.product.delete', $product->id) }}"
                                                    method="POST" class="d-inline" style="">
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


                                                <form method="GET"
                                                    action="{{ route('admin.product.edit', $product->id) }}" style="">
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


                                        <td style="text-align: center">{{ $product->id }} </td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="recent-product-img">
                                                    <img src="{{ asset($product->image) }}" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">{{ $product->name }}</h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td>{{ $product->category->name }} </td>
                                        <td>{{ $product->subcategory->name }} </td>




                                        <td>{{ $product->slug }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->short_description }}</td>


                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->sale_price }}</td>
                                        <td>{{ $product->cost_price }}</td>
                                        <td>{{ $product->stock_quantity }}</td>
                                        <td>{{ $product->min_quantity }}</td>
                                        <td>{{ $product->weight }}</td>
                                        <td>{{ $product->dimensions }}</td>

                                        <td>{{ $product->is_active }}</td>
                                        <td>{{ $product->is_featured }}</td>
                                        <td>{{ $product->manage_stock }}</td>
                                        <td>{{ $product->stock_status }}</td>
                                        <td>{{ $product->image }}</td>
                                        <td>{{ $product->meta_title }}</td>
                                        <td>{{ $product->meta_description }}</td>
                                        <td>{{ $product->rating_average }}</td>
                                        <td>{{ $product->rating_count }}</td>

                                        <td>{{ $product->created_at }}</td>
                                        <td>{{ $product->updated_at }}</td>







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
