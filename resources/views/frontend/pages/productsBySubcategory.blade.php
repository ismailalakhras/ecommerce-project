@php
    $x = 0;

@endphp


@extends('frontend.layout.master')


@section('content')
    <main class="main">
        <div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3 subcategory-header">

                            @if ($products->isNotEmpty())
                                <h1 class="mb-15">{{ $products[0]->subcategory->name }}</h1>
                                <div class="breadcrumb">
                                    <a href="#" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                    <span></span> {{ $products[0]->category->name }} <span></span>
                                    {{ $products[0]->subcategory->name }}
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row flex-row-reverse">
                <div class="col-lg-4-5 content-productBySubcategory">
                    <div class="shop-product-fillter">
                        <div class="totall-product">


                            <p>We found <strong class="text-brand">{{ $productsCount }}</strong> items for you!</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">50</a></li>
                                        <li><a href="#">100</a></li>
                                        <li><a href="#">150</a></li>
                                        <li><a href="#">200</a></li>
                                        <li><a href="#">All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                        <li><a href="#">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row product-grid" id="product-list" style="min-height: 60vh">

                        @foreach ($products as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a class="quick-view-btn" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal" data-id={{ $product->id }}>
                                                <img class="default-img" src="{{ asset($product->image) }}"
                                                    alt="" />
                                                <img class="hover-img" src="{{ asset($product->image) }}" alt="" />
                                            </a>
                                        </div>

                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Save
                                                {{ intval((($product->price - $product->sale_price) / $product->price) * 100) }}
                                                %</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a class="quick-view-btn" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal"
                                                data-id={{ $product->id }}>{{ $product->subcategory->name }}</a>
                                        </div>
                                        <h2><a class="quick-view-btn" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal"
                                                data-id={{ $product->id }}>{{ $product->name }}</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating"
                                                    style="width: {{ $product->rating_average * 20 }}%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted">
                                                ({{ $product->rating_average }})
                                            </span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">{{ $product->subcategory->name }}</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>${{ $product->sale_price }}</span>
                                                <span class="old-price">${{ $product->price }}</span>
                                            </div>

                                            <button type="submit" class="products-btn-add-cart addToCartBtn"
                                                data-id="{{ $product->id }}">
                                                <a><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </button>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="pagination-links">
                        {{ $products->links() }}
                    </div>

                    <!--end product card-->


                    <!--End Deals-->


                </div>
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                    <div class="sidebar-widget widget-category-2 mb-30">
                        <h5 class="section-title style-1 mb-30">Subcategory</h5>
                        <ul>
                            @foreach ($categories as $category)
                                @foreach ($category->subcategories as $subcategory)
                                    <li>

                                        <button class="fetchProductBySubcategory-btn"
                                            style=" display: flex;
                                                align-items: center;  
                                                padding: 0;
                                                margin:0 ;  
                                                line-height: 1.5;  
                                                color: #253d4e; 
                                                font-size: 14px;
                                                background: none;  
                                                border: none;  
                                                gap: 5px;
                                                width:100%"
                                            data-id="{{ $subcategory->id }}">

                                            <img style="width:30px" src="{{ asset($subcategory->image) }}"
                                                alt="" />
                                            {{ $subcategory->name }}
                                            <span class="count-2"
                                                style="margin-left: auto;">{{ $subcategory->products->count() }}</span>

                                        </button>
                                    </li>
                                @endforeach
                            @endforeach

                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </main>
@endsection
