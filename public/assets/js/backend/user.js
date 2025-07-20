

//! ------------------------- << edit user role >>----------------------------
$(function () {
    $(document).on('click', '.update-user-btn', function () {

        const btn = $(this);
        const userId = btn.data('id')

        $.ajax({
            url: `/admin/user-edit/${userId}`,
            method: 'GET',
            success: function (res) {
           
                const icon = btn.find('i');

                if (icon.hasClass('fa-user-shield')) {
                    icon
                        .removeClass('fa-user-shield text-success')
                        .addClass('fa-user text-warning');
                } else {
                    icon
                        .removeClass('fa-user text-warning')
                        .addClass('fa-user-shield text-success');
                }

            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });

})




//! ------------------------- << delete user >>---------------------------
$(function () {
    $(document).on('click', '.delete-user-btn', function (e) {
        e.preventDefault()
        const btn = $(this)

        confirmDelete()
            .then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/user-delete/${btn.data('id')}`,
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
        title: 'Are you sure you want to delete this user?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
    })
}

