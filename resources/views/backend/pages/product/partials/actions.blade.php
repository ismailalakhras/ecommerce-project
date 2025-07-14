<td style="background: #0000000a  !important ; padding:0">
    <div class="d-flex order-actions">


        <button  type="button" class="delete-btn btn btn-sm mb-0 px-2 py-1 delete-product-btn" title="Delete" data-id="{{ $id }}">
            <i class="far fa-trash-alt text-danger" style="font-size: 1.1rem">
            </i>
        </button>


        <button type="button" class="btn btn-sm edit-product-btn" data-id="{{ $id }}"
            data-name="{{ $name }}" data-sku="{{ $sku }}" data-slug="{{ $slug }}"
            data-price="{{ $price }}" data-sale_price="{{ $sale_price }}" data-cost_price="{{ $cost_price }}"
            data-category_id="{{ $category_id }}" data-subcategory_id="{{ $subcategory_id }}"
            data-description="{{ $description }}" data-short_description="{{ $short_description }}"
            data-stock_quantity="{{ $stock_quantity }}" data-min_quantity="{{ $min_quantity }}"
            data-weight="{{ $weight }}" data-dimensions="{{ $dimensions }}"
            data-is_active="{{ $is_active }}" data-is_featured="{{ $is_featured }}"
            data-manage_stock="{{ $manage_stock }}" data-stock_status="{{ $stock_status }}"
            data-image="{{ $image }}" data-meta_title="{{ $meta_title }}"
            data-meta_description="{{ $meta_description }}" data-rating_average="{{ $rating_average }}"
            data-rating_count="{{ $rating_count }}" data-bs-toggle="modal" data-bs-target="#editModal">
            <i class="fas fa-edit text-success"></i>
        </button>




    </div>
</td>
