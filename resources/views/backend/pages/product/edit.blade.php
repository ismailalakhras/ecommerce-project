@extends('backend.layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Product</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h6 class="mb-0 text-uppercase">Update Product Form</h6>
                    <hr />
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.product.update', $product) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <label class="text-primary mb-1">Product Name <span class="text-danger">*</span></label>
                                <input class="form-control mb-3" type="text" name="name"
                                    value="{{ old('name', $product->name) }}">


                                      <!-- Category -->
                                <label class="text-primary mb-1">Category Name <span class="text-danger">*</span></label>
                                <select name="category_id" id="categorySelect" class="form-control mb-3">
                                    <option value="">-- Choose a Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                             {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- SubCategory -->
                                <label class="text-primary mb-1">SubCategory Name <span class="text-danger">*</span></label>
                                <select name="subcategory_id" id="subcategorySelect" class="form-control mb-3">
                                    <option value="">-- Choose a SubCategory --</option>
                                </select>


                                <label class="text-primary mb-1">Slug <span class="text-danger">*</span></label>
                                <input class="form-control mb-3" type="text" name="slug"
                                    value="{{ old('slug', $product->slug) }}">

                                <label class="text-primary mb-1">SKU <span class="text-danger">*</span></label>
                                <input class="form-control mb-3" type="text" name="sku"
                                    value="{{ old('sku', $product->sku) }}">

                                <label class="text-primary mb-1">Price <span class="text-danger">*</span></label>
                                <input class="form-control mb-3" type="number" name="price"
                                    value="{{ old('price', $product->price) }}">

                                <label class="text-primary mb-1">Sale Price</label>
                                <input class="form-control mb-3" type="number" name="sale_price"
                                    value="{{ old('sale_price', $product->sale_price) }}">

                                <label class="text-primary mb-1">Cost Price</label>
                                <input class="form-control mb-3" type="number" name="cost_price"
                                    value="{{ old('cost_price', $product->cost_price) }}">

                                <label class="text-primary mb-1">Description</label>
                                <textarea class="form-control mb-3" name="description" rows="5">{{ old('description', $product->description) }}</textarea>

                                <label class="text-primary mb-1">Short Description</label>
                                <textarea class="form-control mb-3" name="short_description" rows="5">{{ old('short_description', $product->short_description) }}</textarea>

                                <label class="text-primary mb-1">Stock Quantity</label>
                                <input class="form-control mb-3" type="number" name="stock_quantity"
                                    value="{{ old('stock_quantity', $product->stock_quantity) }}">

                                <label class="text-primary mb-1">Min Quantity</label>
                                <input class="form-control mb-3" type="number" name="min_quantity"
                                    value="{{ old('min_quantity', $product->min_quantity) }}">

                                <label class="text-primary mb-1">Weight</label>
                                <input class="form-control mb-3" type="number" name="weight"
                                    value="{{ old('weight', $product->weight) }}">

                                <label class="text-primary mb-1">Dimensions</label>
                                <input class="form-control mb-3" type="text" name="dimensions"
                                    value="{{ old('dimensions', $product->dimensions) }}">

                                <label class="text-primary mb-1">Is Active</label>
                                <select name="is_active" class="form-control mb-3">
                                    <option value="1"
                                        {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0"
                                        {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>No</option>
                                </select>

                                <label class="text-primary mb-1">Is Featured</label>
                                <select name="is_featured" class="form-control mb-3">
                                    <option value="0"
                                        {{ old('is_featured', $product->is_featured) == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1"
                                        {{ old('is_featured', $product->is_featured) == 1 ? 'selected' : '' }}>Yes</option>
                                </select>

                                <label class="text-primary mb-1">Manage Stock</label>
                                <select name="manage_stock" class="form-control mb-3">
                                    <option value="1"
                                        {{ old('manage_stock', $product->manage_stock) == 1 ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0"
                                        {{ old('manage_stock', $product->manage_stock) == 0 ? 'selected' : '' }}>No
                                    </option>
                                </select>

                                <label class="text-primary mb-1">Stock Status</label>
                                <select name="stock_status" class="form-control mb-3">
                                    <option value="in_stock"
                                        {{ old('stock_status', $product->stock_status) == 'in_stock' ? 'selected' : '' }}>
                                        In Stock</option>
                                    <option value="out_of_stock"
                                        {{ old('stock_status', $product->stock_status) == 'out_of_stock' ? 'selected' : '' }}>
                                        Out of Stock</option>
                                    <option value="on_backorder"
                                        {{ old('stock_status', $product->stock_status) == 'on_backorder' ? 'selected' : '' }}>
                                        On Backorder</option>
                                </select>

                                <label class="text-primary mb-1">Image</label>
                                <input class="form-control mb-3" type="text" name="image"
                                    value="{{ old('image', $product->image) }}">

                                <label class="text-primary mb-1">Meta Title</label>
                                <input class="form-control mb-3" type="text" name="meta_title"
                                    value="{{ old('meta_title', $product->meta_title) }}">

                                <label class="text-primary mb-1">Meta Description</label>
                                <textarea class="form-control mb-3" name="meta_description" rows="5">{{ old('meta_description', $product->meta_description) }}</textarea>

                                <label class="text-primary mb-1">Rating Average</label>
                                <input class="form-control mb-3" type="number" name="rating_average"
                                    value="{{ old('rating_average', $product->rating_average) }}">

                                <label class="text-primary mb-1">Rating Count</label>
                                <input class="form-control mb-3" type="number" name="rating_count"
                                    value="{{ old('rating_count', $product->rating_count) }}">

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
