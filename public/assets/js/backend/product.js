//! ------------------------- << create product >>----------------------------
$(function () {
    $(document).on('click', '.create-product-btn', function () {

        $.ajax({
            url: `/admin/product-create`,
            method: 'GET',
            success: function (res) {
                createSubcategorySelect(res.subcategories)
            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });

})


//! ------------------------- << store product >>--------------------------
$(function () {

    $(document).on('click', '#store-product-btn', function () {
        const formData = new FormData($('#createProductForm')[0]);

        $.ajax({
            url: `/admin/product-store`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                showSuccessAlert(res)
                $('#createModal').modal('hide');
                $('#product-table').DataTable().ajax.reload();
            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });
});

//! ------------------------- << edit product >>----------------------------
$(function () {
    $(document).on('click', '.edit-product-btn', function () {
        const btn = $(this);
        const productId = btn.data('id')

        $.ajax({
            url: `/admin/product-edit/${productId}`,
            method: 'GET',
            success: function (res) {

                subcategorySelect(res.subcategories)
                formFilling(res)
                $('#update-product-btn').data('id', productId);

            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });

})


//! ------------------------- << update product >>---------------------------
$(function () {
    $(document).on('click', '#update-product-btn', function (e) {
        e.preventDefault();

        const productId = $(this).data('id');
        const formData = new FormData($('#editProductForm')[0]);

        $.ajax({
            url: `/admin/product-update/${productId}`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                showSuccessAlert(res)

                $('#editModal').modal('hide');
                $('#product-table').DataTable().ajax.reload();

            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });
});


//! ------------------------- << delete product >>---------------------------
$(function () {
    $(document).on('click', '.delete-product-btn', function () {
        const btn = $(this)

        confirmDelete()

            .then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/product-delete/${btn.data('id')}`,
                        method: 'DELETE',
                        success: function (res) {
                            showSuccessAlert(res)

                            btn.closest('tr').fadeOut(1000, function () {
                                $(this).remove();
                            });
                        },

                        error: function (err) {
                            showErrorAlert(err)
                        }
                    })
                }
            })
    })
})


//todo show Success Alert Function
function showSuccessAlert(res) {
    Swal.fire({
        icon: 'success',
        title: res.title,
        text: res.message,
        toast: true,
        position: 'top-end',
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: true,
    });
}

//todo show Error Alert Function
function showErrorAlert(err) {
    Swal.fire({
        icon: 'error',
        title: err.responseJSON?.title,
        text: err.responseJSON?.message || 'Something went wrong',
        toast: true,
        position: 'top-end',
        timer: 5000,
        showConfirmButton: false,
        timerProgressBar: true,
    })
}

//todo Confirm Delete Function
function confirmDelete() {
    return Swal.fire({
        title: 'Are you sure you want to delete this product?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
    })
}

//todo subcategory Select Function
function subcategorySelect(subcategories) {
    // Initialize category/subcategory dropdowns only if both exist
    if ($('#categorySelect').length && $('#subcategorySelect').length) {

        $('#categorySelect').on('change', function () {
            const catId = $(this).val();

            // Filter and build options for subcategories based on selected category
            const options = subcategories
                .filter(sub => sub.category_id == catId)
                .map(sub =>
                    `<option value="${sub.id}" >${sub.name}</option>`
                ).join('');

            $('#subcategorySelect').html('<option value="">-- Choose Subcategory --</option>' + options);
        }).trigger('change');
    }
}

function createSubcategorySelect(subcategories) {
    // Initialize category/subcategory dropdowns only if both exist
    if ($('#createCategorySelect').length && $('#createSubcategorySelect').length) {

        $('#createCategorySelect').on('change', function () {
            const catId = $(this).val();

            // Filter and build options for subcategories based on selected category
            const options = subcategories
                .filter(sub => sub.category_id == catId)
                .map(sub =>
                    `<option value="${sub.id}" >${sub.name}</option>`
                ).join('');

            $('#createSubcategorySelect').html('<option value="">-- Choose Subcategory --</option>' + options);
        }).trigger('change');
    }
}

//todo Form Filling Function
function formFilling(res) {
    $('#editModal input[name="name"]').val(res.product.name);
    $('#editModal input[name="sku"]').val(res.product.sku);
    $('#editModal input[name="price"]').val(res.product.price);
    $('#editModal input[name="slug"]').val(res.product.slug);
    $('#editModal input[name="sale_price"]').val(res.product.sale_price);
    $('#editModal input[name="cost_price"]').val(res.product.cost_price);
    $('#editModal select[name="category_id"]').val(res.product.category_id).trigger('change');
    $('#editModal select[name="subcategory_id"]').val(res.product.subcategory_id);

    $('#editModal textarea[name="description"]').val(res.product.description);
    $('#editModal textarea[name="short_description"]').val(res.product.short_description);
    $('#editModal input[name="stock_quantity"]').val(res.product.stock_quantity);
    $('#editModal input[name="min_quantity"]').val(res.product.min_quantity);
    $('#editModal input[name="weight"]').val(res.product.weight);
    $('#editModal input[name="dimensions"]').val(res.product.dimensions);
    $('#editModal select[name="is_active"]').val(res.product.is_active);
    $('#editModal select[name="is_featured"]').val(res.product.is_featured);
    $('#editModal select[name="manage_stock"]').val(res.product.manage_stock);
    $('#editModal select[name="stock_status"]').val(res.product.stock_status);
    $('#editModal input[name="image"]').val(res.product.image);
    $('#editModal input[name="meta_title"]').val(res.product.meta_title);
    $('#editModal textarea[name="meta_description"]').val(res.product.meta_description);
    $('#editModal input[name="rating_average"]').val(res.product.rating_average);
    $('#editModal input[name="rating_count"]').val(res.product.rating_count);

}

//todo add class 
$(function () {
    $('#product-table thead tr').addClass('bg-header-row');
});