
//! ------------------------- << store subcategory >>--------------------------
$(function () {

    $(document).on('click', '#store-subcategory-btn', function () {
        const formData = new FormData($('#createSubcategoryForm')[0]);

        $.ajax({
            url: `/admin/subcategory-store`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {

                showSuccessAlert(res)
                $('#createSubcategoryModal').modal('hide');
                $('#subcategory-table').DataTable().ajax.reload();
            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });
});



//! ------------------------- << edit subcategory >>----------------------------
$(function () {
    $(document).on('click', '.edit-subcategory-btn', function () {
        
        const btn = $(this);
        const categoryId = btn.data('id')

        $.ajax({
            url: `/admin/subcategory-edit/${categoryId}`,
            method: 'GET',
            success: function (res) {

                formFilling(res)
                $('#update-subcategory-btn').data('id', categoryId);

            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });

})


//! ------------------------- << update subcategory >>---------------------------
$(function () {
    $(document).on('click', '#update-subcategory-btn', function () {

        const categoryId = $(this).data('id');
        
        const formData = new FormData($('#editSubcategoryForm')[0]);

        $.ajax({
            url: `/admin/subcategory-update/${categoryId}`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                showSuccessAlert(res)

                $('#editSubcategoryModal').modal('hide');
                $('#subcategory-table').DataTable().ajax.reload();

            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });
});


//! ------------------------- << delete subcategory >>---------------------------
$(function () {
    $(document).on('click', '.delete-subcategory-btn', function () {
        console.log('delete subcategory');

        const btn = $(this)

        confirmDelete()

            .then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/subcategory-delete/${btn.data('id')}`,
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
        title: 'Are you sure you want to delete this subcategory?',
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
    $('#editSubcategoryModal input[name="name"]').val(res.subcategory.name);
    $('#editSubcategoryModal input[name="slug"]').val(res.subcategory.slug);
    $('#editSubcategoryModal input[name="sort_order"]').val(res.subcategory.sort_order);

    $('#editSubcategoryModal select[name="is_active"]').val(res.subcategory.is_active);
    $('#editSubcategoryModal select[name="category_id"]').val(res.subcategory.category_id);

    $('#editSubcategoryModal input[name="image"]').val(res.subcategory.image);
    $('#editSubcategoryModal input[name="meta_title"]').val(res.subcategory.meta_title);
    $('#editSubcategoryModal textarea[name="meta_description"]').val(res.subcategory.meta_description);

}


//todo add class 
$(function () {
    $('#subcategory-table thead tr').addClass('bg-header-row');
});

