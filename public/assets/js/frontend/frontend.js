$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})

//! -----------------{{ add product to cart }}-----------------------
$(function () {

    $(document).on('click', '.addToCartBtn', function () {

        const button = $(this);

        const productId = button.data('id')

        $.ajax({
            url: `/cart/${productId}`,
            method: 'POST',
            success: function (res) {

                if (!res.isExists) {

                    $('#cartCount').text(res.cart_count)

                    $('#dropdown-cart').append(`
                        <li>
                            <div class="shopping-cart-img">
                                <a href="">
                                    <img alt="" src="/${res.product.image}" />
                                </a>
                            </div>
                            <div class="shopping-cart-title">
                                <h4><a href="">${res.product.name}</a></h4>
                                <h4><span data-id=${res.product.id} > 1 × </span>${res.price}</h4>
                            </div>

                                <button class="delete-btn" data-id=${res.product.id} type="button"
                                    style="border-radius:100% !important; width:35px; height:35px;">
                                    <i style="font-size:20px" class="fi-rs-trash"></i>
                                </button>
                        </li>
                    `);

                    $('#totalPriceCart').text(`${(res.total)}$`)
                } else {

                    $(`#dropdown-cart li .shopping-cart-title h4 span[data-id=${res.product.id}] `).text(`${res.quantity} X `)

                    $('#totalPriceCart').text(`${(res.total)}$`)
                }
                showSuccessAlert(res)

            },

            error: function (err) {
                showErrorAlert(err)

            }
        });


    })
})


//! -----------------{{ delete product from cart - dropdown }}-----------------------

$(function () {


    $(document).on('click', '.delete-btn', function () {
        const button = $(this);
        const productId = button.data('id')

        $.ajax({
            url: `/cart/${productId}`,
            method: 'DELETE',
            success: function (res) {

                console.log(res.product);

                $('#cartCount').text(res.cart_count)

                $(`#dropdown-cart li .shopping-cart-title h4 span[data-id=${res.product.id}] `).text(`${res.quantity} X `)

                $('#totalPriceCart').text(`${(res.total)}$`)



                showSuccessAlert(res)

                button.closest('li').fadeOut(1000, function () {
                    $(this).remove();
                });
            },
            error: function (err) {
                showErrorAlert(err)
            }
        })
    })
})



//todo show Success Alert Function
function showSuccessAlert(res) {
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: res.title,
        text: res.message,
        showConfirmButton: false,
        timer: 3000,
        width: '400px',
        padding: '16px',
        customClass: {
            popup: 'shadow-lg rounded-lg border border-green-100',
            title: 'text-green-600 text-base font-medium',
            icon: '!border-none'
        },
        toast: true,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
}

//todo show Error Alert Function
function showErrorAlert(err) {
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: err.responseJSON?.title,
        text: err.responseJSON?.message || 'Something went wrong',
        showConfirmButton: false,
        timer: 5000,
        width: '400px',
        padding: '16px',
        customClass: {
            popup: 'shadow-lg rounded-lg border border-red-100',
            title: 'text-red-600 text-base font-medium',
            icon: '!border-none'
        },
        toast: true,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
}