<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;">
        <div class="modal-content" style="width:50rem">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Product Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-9 mx-auto" style="width: 100%">
                        <div class="card">
                            <div class="card-body">
                                <form id="createProductForm" method="POST">
                                    @csrf
                                    <label class="text-primary mb-1">Product Name <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control mb-3" type="text" name="name">

                                    <!-- Category -->
                                    <label class="text-primary mb-1">Category Name <span
                                            class="text-danger">*</span></label>
                                    <select name="category_id" id="createCategorySelect" class="form-control mb-3">
                                        <option value="">-- Choose a Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <!-- SubCategory -->
                                    <label class="text-primary mb-1">SubCategory Name <span
                                            class="text-danger">*</span></label>
                                    <select name="subcategory_id" id="createSubcategorySelect" class="form-control mb-3">
                                        <option value="">-- Choose a SubCategory --</option>
                                    </select>

                                    <label class="text-primary mb-1">Slug <span class="text-danger">*</span></label>
                                    <input class="form-control mb-3" type="text" name="slug">

                                    <label class="text-primary mb-1">SKU <span class="text-danger">*</span></label>
                                    <input class="form-control mb-3" type="text" name="sku">

                                    <label class="text-primary mb-1">Price <span class="text-danger">*</span></label>
                                    <input class="form-control mb-3" type="number" step="0.01" name="price">

                                    <label class="text-primary mb-1">Sale Price</label>
                                    <input class="form-control mb-3" type="number" step="0.01" name="sale_price">

                                    <label class="text-primary mb-1">Cost Price</label>
                                    <input class="form-control mb-3" type="number" step="0.01" name="cost_price">

                                    <label class="text-primary mb-1">Description</label>
                                    <textarea class="form-control mb-3" name="description" rows="5"></textarea>

                                    <label class="text-primary mb-1">Short Description</label>
                                    <textarea class="form-control mb-3" name="short_description" rows="5"></textarea>

                                    <label class="text-primary mb-1">Stock Quantity</label>
                                    <input class="form-control mb-3" type="number" name="stock_quantity">

                                    <label class="text-primary mb-1">Min Quantity</label>
                                    <input class="form-control mb-3" type="number" name="min_quantity">

                                    <label class="text-primary mb-1">Weight</label>
                                    <input class="form-control mb-3" type="number" step="0.01" name="weight">

                                    <label class="text-primary mb-1">Dimensions</label>
                                    <input class="form-control mb-3" type="text" name="dimensions">

                                    <label class="text-primary mb-1">Is Active</label>
                                    <select name="is_active" class="form-control mb-3">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>

                                    <label class="text-primary mb-1">Is Featured</label>
                                    <select name="is_featured" class="form-control mb-3">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>

                                    <label class="text-primary mb-1">Manage Stock</label>
                                    <select name="manage_stock" class="form-control mb-3">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>

                                    <label class="text-primary mb-1">Stock Status</label>
                                    <select name="stock_status" class="form-control mb-3">
                                        <option value="in_stock">In Stock</option>
                                        <option value="out_of_stock">Out of Stock</option>
                                        <option value="on_backorder">On Backorder</option>
                                    </select>

                                    <label class="text-primary mb-1">Image</label>
                                    <input class="form-control mb-3" type="text" name="image">

                                    <label class="text-primary mb-1">Meta Title</label>
                                    <input class="form-control mb-3" type="text" name="meta_title">

                                    <label class="text-primary mb-1">Meta Description</label>
                                    <textarea class="form-control mb-3" name="meta_description" rows="5"></textarea>

                                    <label class="text-primary mb-1">Rating Average</label>
                                    <input class="form-control mb-3" type="number" step="0.01"
                                        name="rating_average" step="0.1">

                                    <label class="text-primary mb-1">Rating Count</label>
                                    <input class="form-control mb-3" type="number" name="rating_count">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button id="store-product-btn" type="button" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
