<div class="modal fade" id="editSubcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;">
        <div class="modal-content" style="width:50rem">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Subcategory Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-9 mx-auto" style="width: 100%">
                        <div class="card">
                            <div class="card-body">
                                <form id="editSubcategoryForm" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="card-body">
                                        <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Subcategory Name
                                            <span style="color: red ; margin-bottom:5px">*</span></label>

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


                                        <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Slug</label>

                                        <input class="form-control mb-3" type="text" name="slug">

                                        <label class="text-primary mb-1">Is Active</label>
                                        <select name="is_active" class="form-control mb-3">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>

                                        <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Image</label>

                                        <input class="form-control mb-3" type="text" name="image">

                                        <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Meta
                                            Title</label>

                                        <input class="form-control mb-3" type="text" name="meta_title">

                                        <label style="color: rgb(0, 60, 255) ; margin-bottom:5px">Meta
                                            Description</label>

                                        <textarea class="form-control mb-3" type="text" name="meta_description" rows="5" cols="50"></textarea>



                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button id="update-subcategory-btn" type="button"
                                                class="btn btn-primary">Save
                                                changes</button>
                                        </div>
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
