    <div  >

        <button type="button" class="delete-btn btn btn-sm mb-0 px-2 py-1 delete-subcategory-btn" title="Delete"
            data-id="{{ $id }}">
            <i class="far fa-trash-alt text-danger" style="font-size: 1.1rem">
            </i>
        </button>

        <button type="button" class="btn btn-sm edit-subcategory-btn" data-id="{{ $id }}" data-bs-toggle="modal"
            data-bs-target="#editSubcategoryModal">
            <i class="fas fa-edit text-success " style="font-size: 1.1rem"></i>
        </button>

    </div>
