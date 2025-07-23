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
                button.prop('disabled', false);

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



                $('#cartCount').text(res.cart_count)

                $(`#dropdown-cart li .shopping-cart-title h4 span[data-id=${res.product.id}] `).text(`${res.quantity} X `)

                // $('#totalPriceCart').text(`${(res.total)}$`)


                $('.total-price-cart').text(`${(res.total)}$`)


                // button.closest('li').fadeOut(1000, function () {
                //     $(this).remove();
                // });

                $(`.product-to-delete-${productId}`).fadeOut(1000, function () {
                    $(`.product-to-delete-${productId}`).remove();
                });

                $('.hidden-total-price').val(res.total)

                console.log($('.hidden-total-price').val());


                showSuccessAlert(res)
            },
            error: function (err) {
                showErrorAlert(err)
            }
        })
    })
})








//! -----------------{{ fetch product by category id }}-----------------------

$(function () {
    $(document).on('click', '.fetchProductByCategory-btn', function () {

        const btn = $(this)

        const currentPath = window.location.pathname.split('/').filter(Boolean)[0];


        if (currentPath === 'category') {

            $.ajax({
                url: `/category/${btn.data('id')}/products`,
                method: 'GET',
                success: function (res) {

                    const newPage = $(res.page);

                    $('.category-header').fadeOut(200, function () {
                        $(this).html(newPage.find('.category-header').html()).fadeIn(200);
                    });

                    $('.content-product').fadeOut(200, function () {
                        $(this).html(newPage.find('.content-product').html()).fadeIn(200);
                    });

                    window.history.pushState(null, '', `/category/${btn.data('id')}/products`);
                },
                error: function (err) {
                    console.log(err);
                }
            })

        } else {
            window.location.href = `/category/${btn.data('id')}/products`;
        }

    })
})





//! -----------------{{ fetch product by category id }}-----------------------

$(function () {
    $(document).on('click', '.fetchProductBySubcategory-btn', function () {
        const btn = $(this)

        const currentPath = window.location.pathname.split('/').filter(Boolean)[0];


        if (currentPath === 'subcategory') {

            $.ajax({
                url: `/subcategory/${btn.data('id')}/products`,
                method: 'GET',
                success: function (res) {

                    const newPage = $(res.page);
                    console.log(newPage);


                    $('.subcategory-header').fadeOut(200, function () {
                        $(this).html(newPage.find('.subcategory-header').html()).fadeIn(200);
                    });

                    $('.content-productBySubcategory').fadeOut(200, function () {
                        $(this).html(newPage.find('.content-productBySubcategory').html()).fadeIn(200);
                    });

                    window.history.pushState(null, '', `/subcategory/${btn.data('id')}/products`);
                },
                error: function (err) {
                    console.log(err);
                }
            })

        } else {
            window.location.href = `/subcategory/${btn.data('id')}/products`;
        }

    })
})




//todo mega menu Function
$(function () {
    $('.main-menu > nav > ul > li > a').on('click', function (e) {
        e.preventDefault();
        const megaMenu = $(this).siblings('ul.mega-menu');

        megaMenu.css({
            'opacity': megaMenu.css('opacity') == 1 ? 0 : 1,
            'visibility': megaMenu.css('opacity') == 1 ? 'hidden' : 'visible',
            'margin-top': megaMenu.css('opacity') == 1 ? '20px' : '0'
        });

        $('ul.mega-menu li button').on('click', function (e) {
            e.preventDefault();

            megaMenu.css({
                'opacity': 0,
                'visibility': 'hidden',
                'margin-top': '20px'
            });

        })
    });


    $(document).on('click', function (e) {
        if (!$(e.target).closest('.mega-menu, .main-menu > nav > ul > li > a').length) {
            $('ul.mega-menu').css({
                'opacity': 0,
                'visibility': 'hidden',
                'margin-top': '20px'
            });
        }
        console.log($('.hidden-total-price').val());

    });

    // $(window).on('scroll', function () {
    //     $('ul.mega-menu').css({
    //         'opacity': 0,
    //         'visibility': 'hidden',
    //         'margin-top': '20px'
    //     });
    // });

});

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

//todo bootstrap pagination
$(document).on('click', '#pagination-links a', function (e) {
    e.preventDefault();

    var url = $(this).attr('href');

    $.ajax({
        url: url,
        type: 'GET',
        success: function (res) {
            const newPage = $(res.page);

            $('#pagination-links').html($(res.page).find('#pagination-links').html());

            $('#product-list').fadeOut(200, function () {
                $(this).html(newPage.find('#product-list').html()).fadeIn(200);
            });

            window.history.pushState(null, '', url);
        },
        error: function () {
            alert('حدث خطأ أثناء تحميل البيانات.');
        }
    });
});

//todo update product quantity in cart

$(function () {
    $(document).on('click', '.qty-down', function (e) {
        e.preventDefault();

        const button = $(this);
        const id = button.data('id');
        const url = button.data('url');
        const totalPriceItem = $(`#totalPriceItem-${id}`)

        const input = $(`#qty-val-${id}`);
        let currentQty = parseInt(input.val());

        if (currentQty > 1) {
            const newQty = currentQty - 1;
            input.val(newQty);

            $.ajax({
                url: url,
                method: 'PUT',
                data: {
                    quantity: newQty,
                },
                success: function (res) {
                    totalPriceItem.html(`<h4 class="text-brand">$ ${res.totalPriceItem} </h4>`);
                    $('.cart-total-price').text(`$ ${res.total}`)
                    $('.cart-subtotal-price').text(`$ ${res.total}`)
                    $('.hidden-total-price').val(res.total)

                    showSuccessAlert(res);
                },
                error: function (err) {
                    showErrorAlert(err);
                    input.val(currentQty);
                }
            });
        }
    });


    $(document).on('click', '.qty-up', function (e) {
        e.preventDefault();

        const button = $(this);
        const id = button.data('id');
        const url = button.data('url');
        const totalPriceItem = $(`#totalPriceItem-${id}`)

        const input = $(`#qty-val-${id}`);
        let currentQty = parseInt(input.val());

        const newQty = currentQty + 1;
        input.val(newQty);

        $.ajax({
            url: url,
            method: 'PUT',
            data: {
                quantity: newQty,
            },
            success: function (res) {

                totalPriceItem.html(`<h4 class="text-brand">$ ${res.totalPriceItem} </h4>`);

                $('.cart-total-price').text(`$ ${res.total}`)
                $('.cart-subtotal-price').text(`$ ${res.total}`)
                $('.hidden-total-price').val(res.total)

                console.log($('.hidden-total-price').val());



                showSuccessAlert(res);
            },
            error: function (err) {
                showErrorAlert(err);
                input.val(currentQty);
            }
        });
    });


})



$(function () {
    $(document).on('click', '.update-hidden-total-price', function(){
        $('.hidden-total-price').val(res.total)

        console.log($('.hidden-total-price').val());
    })
})