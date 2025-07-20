<td style="background: #0000000a  !important ; padding:0">
    <div class="d-flex order-actions">

        <button type="button" class="delete-btn btn btn-sm mb-0 px-2 py-1 delete-product-btn" title="Delete"
            data-id="{{ $id }}">
            <i class="far fa-trash-alt text-danger" style="font-size: 1.1rem">
            </i>
        </button>

        <button type="button" class="btn btn-sm edit-product-btn" data-id="{{ $id }}" data-bs-toggle="modal"
            data-bs-target="#editModal">
            <i class="fas fa-edit text-success"></i>
        </button>

    </div>
</td>
