$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})


$(function () {

    $('.addToCartBtn-productsByCategory').on('click', function () {

        const productId = $(this).data('id')

        $.ajax({
            url: `/cart/${productId}`,
            method: 'POST',
            success: function (res) {
                console.log(res.quantity);


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
                                <h4><span> 1 × </span>${res.product.price}</h4>
                            </div>

                            <form method="POST">
                                <button class="delete-btn" type="button"
                                    style="border-radius:100% !important; width:35px; height:35px;">
                                    <i style="font-size:20px" class="fi-rs-trash"></i>
                                </button>
                            </form>
                        </li>
                    `);
                }
            },

            error: function (err) {
                console.log(err);
            }
        });


    })
})