

//! ------------------------- << store coupon >>--------------------------
$(function () {

    $(document).on('click', '#store-coupon-btn', function () {
        const formData = new FormData($('#createCouponForm')[0]);

        $.ajax({
            url: `/admin/coupon-store`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {

                showSuccessAlert(res)
                $('#createCouponModal').modal('hide');
                $('#coupon-table').DataTable().ajax.reload();
            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });
});



//! ------------------------- << edit coupon >>----------------------------
$(function () {
    $(document).on('click', '.edit-coupon-btn', function () {

        const btn = $(this);
        const couponId = btn.data('id')

        $.ajax({
            url: `/admin/coupon-edit/${couponId}`,
            method: 'GET',
            success: function (res) {

                formFilling(res)
                $('#update-coupon-btn').data('id', couponId);

            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });

})


//! ------------------------- << update coupon >>---------------------------
$(function () {
    $(document).on('click', '#update-coupon-btn', function () {

        const couponId = $(this).data('id');

        const formData = new FormData($('#editCouponForm')[0]);

        $.ajax({
            url: `/admin/coupon-update/${couponId}`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                showSuccessAlert(res)

                $('#editCouponModal').modal('hide');
                $('#coupon-table').DataTable().ajax.reload();

            },
            error: function (err) {
                showErrorAlert(err)
            }
        });
    });
});


//! ------------------------- << delete coupon >>---------------------------
$(function () {
    $(document).on('click', '.delete-coupon-btn', function () {
        console.log('delete coupon');

        const btn = $(this)

        confirmDelete()

            .then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/coupon-delete/${btn.data('id')}`,
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
        title: 'Are you sure you want to delete this coupon?',
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
    $('#editCouponModal input[name="code"]').val(res.coupon.code);
    $('#editCouponModal select[name="type"]').val(res.coupon.type);
    $('#editCouponModal input[name="value"]').val(res.coupon.value);
    $('#editCouponModal input[name="minimum_amount"]').val(res.coupon.minimum_amount);
    $('#editCouponModal input[name="usage_limit"]').val(res.coupon.usage_limit);
    $('#editCouponModal input[name="used_count"]').val(res.coupon.used_count);
    $('#editCouponModal select[name="is_active"]').val(res.coupon.is_active);

    $('#editCouponModal input[name="starts_at"]').val(toDatetimeLocal(res.coupon.starts_at));
    $('#editCouponModal input[name="expires_at"]').val(toDatetimeLocal(res.coupon.expires_at));
}

function toDatetimeLocal(dateTimeString) {
    const date = new Date(dateTimeString);
    if (isNaN(date)) return '';
    return date.toISOString().slice(0, 16);
}



//todo add class 
$(function () {
    $('#coupon-table thead tr').addClass('bg-header-row');
});
