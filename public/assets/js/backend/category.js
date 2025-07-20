//todo add class 
$(function () {
    $('#category-table thead tr').addClass('bg-header-row');
});


//! ------------------------- << store category >>--------------------------
$(function () {

    $(document).on('click', '#store-category-btn', function () {
        const formData = new FormData($('#createCategoryForm')[0]);

        $.ajax({
            url: `/admin/category-store`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {

                showSuccessAlert(res)
                $('#createCategoryModal').modal('hide');
                $('#category-table').DataTable().ajax.reload();
            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });
});



//! ------------------------- << edit category >>----------------------------
$(function () {
    $(document).on('click', '.edit-category-btn', function () {
        
        const btn = $(this);
        const categoryId = btn.data('id')

        $.ajax({
            url: `/admin/category-edit/${categoryId}`,
            method: 'GET',
            success: function (res) {

                formFilling(res)
                $('#update-category-btn').data('id', categoryId);

            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });

})


//! ------------------------- << update category >>---------------------------
$(function () {
    $(document).on('click', '#update-category-btn', function () {

        const categoryId = $(this).data('id');
        
        const formData = new FormData($('#editCategoryForm')[0]);

        $.ajax({
            url: `/admin/category-update/${categoryId}`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                showSuccessAlert(res)

                $('#editCategoryModal').modal('hide');
                $('#category-table').DataTable().ajax.reload();

            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });
});


//! ------------------------- << delete category >>---------------------------
$(function () {
    $(document).on('click', '.delete-category-btn', function () {
        console.log('delete category');

        const btn = $(this)

        confirmDelete()

            .then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/category-delete/${btn.data('id')}`,
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
        title: 'Are you sure you want to delete this category?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
    })
}



//todo Form Filling Function
function formFilling(res) {
    $('#editCategoryModal input[name="name"]').val(res.category.name);
    $('#editCategoryModal input[name="slug"]').val(res.category.slug);
    $('#editCategoryModal input[name="sort_order"]').val(res.category.sort_order);

    $('#editCategoryModal select[name="is_active"]').val(res.category.is_active);
    $('#editCategoryModal input[name="image"]').val(res.category.image);
    $('#editCategoryModal input[name="meta_title"]').val(res.category.meta_title);
    $('#editCategoryModal textarea[name="meta_description"]').val(res.category.meta_description);

}
