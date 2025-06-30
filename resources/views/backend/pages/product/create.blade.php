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
                            <li class="breadcrumb-item active" aria-current="page">Create New Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h6 class="mb-0 text-uppercase">Create Product Form</h6>
                    <hr />
                    <div class="card">
                        <div class="card-body">



                            <form action="{{ route('admin.product.store') }}" method="POST">
                                @csrf

                                <!-- Product Name -->
                                <label class="text-primary mb-1">Product Name <span class="text-danger">*</span></label>
                                <input class="form-control mb-3" type="text" name="name" value="{{ old('name') }}">

                        

                                <!-- Category -->
                                <label class="text-primary mb-1">Category Name <span class="text-danger">*</span></label>
                                <select name="category_id" id="categorySelect" class="form-control mb-3">
                                    <option value="">-- Choose a Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- SubCategory -->
                                <label class="text-primary mb-1">SubCategory Name <span class="text-danger">*</span></label>
                                <select name="subcategory_id" id="subcategorySelect" class="form-control mb-3">
                                    <option value="">-- Choose a SubCategory --</option>
                                </select>


                                <!-- Slug -->
                                <label class="text-primary mb-1">Slug <span class="text-danger">*</span></label>
                                <input class="form-control mb-3" type="text" name="slug" value="{{ old('slug') }}">

                                <!-- SKU -->
                                <label class="text-primary mb-1">SKU <span class="text-danger">*</span></label>
                                <input class="form-control mb-3" type="text" name="sku" value="{{ old('sku') }}">

                                <!-- Price -->
                                <label class="text-primary mb-1">Price <span class="text-danger">*</span></label>
                                <input class="form-control mb-3" type="number" name="price" value="{{ old('price') }}">

                                <!-- Sale Price -->
                                <label class="text-primary mb-1">Sale Price</label>
                                <input class="form-control mb-3" type="number" name="sale_price"
                                    value="{{ old('sale_price') }}">

                                <!-- Cost Price -->
                                <label class="text-primary mb-1">Cost Price</label>
                                <input class="form-control mb-3" type="number" name="cost_price"
                                    value="{{ old('cost_price') }}">

                                <!-- Description -->
                                <label class="text-primary mb-1">Description</label>
                                <textarea class="form-control mb-3" name="description" rows="5">{{ old('description') }}</textarea>

                                <!-- Short Description -->
                                <label class="text-primary mb-1">Short Description</label>
                                <textarea class="form-control mb-3" name="short_description" rows="5">{{ old('short_description') }}</textarea>

                                <!-- Stock Quantity -->
                                <label class="text-primary mb-1">Stock Quantity</label>
                                <input class="form-control mb-3" type="number" name="stock_quantity"
                                    value="{{ old('stock_quantity', 0) }}">

                                <!-- Min Quantity -->
                                <label class="text-primary mb-1">Min Quantity</label>
                                <input class="form-control mb-3" type="number" name="min_quantity"
                                    value="{{ old('min_quantity', 1) }}">

                                <!-- Weight -->
                                <label class="text-primary mb-1">Weight</label>
                                <input class="form-control mb-3" type="number" name="weight" value="{{ old('weight') }}">

                                <!-- Dimensions -->
                                <label class="text-primary mb-1">Dimensions</label>
                                <input class="form-control mb-3" type="text" name="dimensions"
                                    value="{{ old('dimensions') }}">

                                <!-- Is Active -->
                                <label class="text-primary mb-1">Is Active</label>
                                <select name="is_active" class="form-control mb-3">
                                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>No</option>
                                </select>

                                <!-- Is Featured -->
                                <label class="text-primary mb-1">Is Featured</label>
                                <select name="is_featured" class="form-control mb-3">
                                    <option value="0" {{ old('is_featured', 0) == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('is_featured') == 1 ? 'selected' : '' }}>Yes</option>
                                </select>

                                <!-- Manage Stock -->
                                <label class="text-primary mb-1">Manage Stock</label>
                                <select name="manage_stock" class="form-control mb-3">
                                    <option value="1" {{ old('manage_stock', 1) == 1 ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0" {{ old('manage_stock') == 0 ? 'selected' : '' }}>No</option>
                                </select>

                                <!-- Stock Status -->
                                <label class="text-primary mb-1">Stock Status</label>
                                <select name="stock_status" class="form-control mb-3">
                                    <option value="in_stock" {{ old('stock_status') == 'in_stock' ? 'selected' : '' }}>In
                                        Stock</option>
                                    <option value="out_of_stock"
                                        {{ old('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                    <option value="on_backorder"
                                        {{ old('stock_status') == 'on_backorder' ? 'selected' : '' }}>On Backorder</option>
                                </select>

                                <!-- Image -->
                                <label class="text-primary mb-1">Image</label>
                                <input class="form-control mb-3" type="text" name="image"
                                    value="{{ old('image', 'images/products/sample2.jpg') }}">

                                <!-- Meta Title -->
                                <label class="text-primary mb-1">Meta Title</label>
                                <input class="form-control mb-3" type="text" name="meta_title"
                                    value="{{ old('meta_title') }}">

                                <!-- Meta Description -->
                                <label class="text-primary mb-1">Meta Description</label>
                                <textarea class="form-control mb-3" name="meta_description" rows="5">{{ old('meta_description') }}</textarea>

                                <!-- Rating Average -->
                                <label class="text-primary mb-1">Rating Average</label>
                                <input class="form-control mb-3" type="number" name="rating_average"
                                    value="{{ old('rating_average', 0) }}">

                                <!-- Rating Count -->
                                <label class="text-primary mb-1">Rating Count</label>
                                <input class="form-control mb-3" type="number" name="rating_count"
                                    value="{{ old('rating_count', 0) }}">

                                <button type="submit" class="btn btn-primary">Create</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
