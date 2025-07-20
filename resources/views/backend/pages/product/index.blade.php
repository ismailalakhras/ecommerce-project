@extends('backend.layout.master')

@push('css')
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="page-content" style="position: fixed">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Products Overview</h5>
                        </div>
                        <div class="font-22 ms-auto">

                            <button type="button" class="btn btn-warning text-white create-product-btn"
                                data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="bx bx-layer-plus"></i> insert
                            </button>

                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive"
                        style="max-height: calc(100vh - 14.5rem);max-width: calc(100vw - 20.5rem); overflow-y: auto; overflow-x: auto;">
                        <table id="searchTable" class="table align-middle mb-0 product-table" style="white-space: nowrap;">
                            <thead class="table-light">
                                <tr>
                                    <th style="position: sticky ; top:0"></th>
                                    <th style="position: sticky ; top:0">Product id</th>
                                    <th style="position: sticky ; top:0">Name</th>
                                    <th style="position: sticky ; top:0">image</th>

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
                                    <th style="position: sticky ; top:0">meta_title</th>
                                    <th style="position: sticky ; top:0">meta_description</th>
                                    <th style="position: sticky ; top:0">rating_average</th>

                                    <th style="position: sticky ; top:0">rating_count</th>
                                    <th style="position: sticky ; top:0">created_at</th>
                                    <th style="position: sticky ; top:0">updated_at</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    @include('backend.pages.product.partials.edit-modal')

    {{-- Create Modal --}}
    @include('backend.pages.product.partials.create-modal')
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/backend/product.js') }}"></script>
@endpush
