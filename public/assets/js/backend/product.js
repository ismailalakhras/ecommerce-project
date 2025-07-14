$(function () {

    $('.product-table').DataTable({
        ajax: '/admin/product',
        columns: [
            { data: 'actions' },
            { data: 'id' },
            { data: 'name' },
            { data: 'image' },

            { data: 'category_name' },
            { data: 'subcategory_name' },
            { data: 'slug' },
            { data: 'description' },

            { data: 'short_description' },
            { data: 'sku' },
            { data: 'price' },
            { data: 'sale_price' },

            { data: 'cost_price' },
            { data: 'stock_quantity' },
            { data: 'min_quantity' },
            { data: 'weight' },

            { data: 'dimensions' },
            { data: 'is_active' },
            { data: 'is_featured' },
            { data: 'manage_stock' },

            { data: 'stock_status' },
            { data: 'meta_title' },
            { data: 'meta_description' },
            { data: 'rating_average' },

            { data: 'rating_count' },
            { data: 'created_at' },
            { data: 'updated_at' },
        ],
        columnDefs: [
            {
                targets: 1,
                className: 'text-center'
            }
        ],

    });
});

//! update product

$(function () {
    $(document).on('click', '.edit-product-btn', function () {
        const btn = $(this);

        $('#editModal input[name="name"]').val(btn.data('name'));
        $('#editModal input[name="sku"]').val(btn.data('sku'));
        $('#editModal input[name="price"]').val(btn.data('price'));
        $('#editModal input[name="slug"]').val(btn.data('slug'));
        $('#editModal input[name="sale_price"]').val(btn.data('sale_price'));
        $('#editModal input[name="cost_price"]').val(btn.data('cost_price'));
        $('#editModal select[name="category_id"]').val(btn.data('category_id')).trigger('change');

        window.oldSubcategoryId = btn.data('subcategory_id');

        $('#editModal textarea[name="description"]').val(btn.data('description'));
        $('#editModal textarea[name="short_description"]').val(btn.data('short_description'));
        $('#editModal input[name="stock_quantity"]').val(btn.data('stock_quantity'));
        $('#editModal input[name="min_quantity"]').val(btn.data('min_quantity'));
        $('#editModal input[name="weight"]').val(btn.data('weight'));
        $('#editModal input[name="dimensions"]').val(btn.data('dimensions'));
        $('#editModal select[name="is_active"]').val(btn.data('is_active'));
        $('#editModal select[name="is_featured"]').val(btn.data('is_featured'));
        $('#editModal select[name="manage_stock"]').val(btn.data('manage_stock'));
        $('#editModal select[name="stock_status"]').val(btn.data('stock_status'));
        $('#editModal input[name="image"]').val(btn.data('image'));
        $('#editModal input[name="meta_title"]').val(btn.data('meta_title'));
        $('#editModal textarea[name="meta_description"]').val(btn.data('meta_description'));
        $('#editModal input[name="rating_average"]').val(btn.data('rating_average'));
        $('#editModal input[name="rating_count"]').val(btn.data('rating_count'));

        $('#update-product-btn').data('id', btn.data('id'));
    });



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
                $('.product-table').DataTable().ajax.reload();
            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });


    subcategorySelect()
});


//! create product

$(function () {

    $(document).on('click', '#store-product-btn', function (e) {
        e.preventDefault();
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
                $('.product-table').DataTable().ajax.reload();
            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });

    subcategorySelect()
});



//! delete product

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
        title: res.success,
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
        title: 'Update Failed!',
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
function subcategorySelect() {
    // Initialize category/subcategory dropdowns only if both exist
    if ($('#categorySelect').length && $('#subcategorySelect').length) {
        const subcategories = window.subcategories || [];
        const oldId = window.oldSubcategoryId || null;

        $('#categorySelect').on('change', function () {
            const catId = $(this).val();

            // Filter and build options for subcategories based on selected category
            const options = subcategories
                .filter(sub => sub.category_id == catId)
                .map(sub =>
                    `<option value="${sub.id}" ${sub.id == oldId ? 'selected' : ''}>${sub.name}</option>`
                ).join('');

            $('#subcategorySelect').html('<option value="">-- Choose Subcategory --</option>' + options);
        }).trigger('change');
    }
}