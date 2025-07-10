<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Nest - eCommerce')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('build/assets/imgs/theme/favicon.svg') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('build/assets/css/plugins/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/plugins/slider-range.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/main.css?v=5.3') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    @include('frontend.layout.body.navbar')

    <main class="main">
        @yield('content')
    </main>

    @include('frontend.layout.body.footer')
    @include('frontend.layout.body.preloader')

    <!-- JS -->
    <script src="{{ asset('build/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/jquery.elevatezoom.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('build/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('build/assets/js/shop.js?v=5.3') }}"></script>


    <script>
        $(document).ready(function() {
            $('#Proceed_to_checkout').click(function() {
                $('#shipping_addresses_form').toggle(500);
                $('#Proceed_to_checkout').hide()

            });
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(function() {
            $('.quick-view-btn').click(function() {
                let productId = $(this).data('id')
                $.ajax({
                    url: '/product/' + productId,
                    method: 'GET',

                }).then(response => {
                    $('#modalProductName').text(response.name);
                    $('#modalProductPrice').text(`${response.price}$`);
                    $('#modalProductSalePrice').text(`${response.sale_price}$`);
                    $('#modalProductDescription').text(response.description);
                    $('#modalProductImage-1').attr('src', response.image);
                    $('#modalProductImage-2').attr('src', response.image);
                    $('#modalProductImage-3').attr('src', response.image);
                    $('#modalProductImage-4').attr('src', response.image);
                    $('#modalRatingCount').text(`(${response.rating_count} reviews)`);
                }).catch(err => {
                    console.log(err);

                })
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $(document).on('click', '#pagination-links a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'GET',
                    beforeSend: function() {
                        $('#product-list').html('<div>جاري التحميل...</div>');
                    },
                    success: function(data) {
                        $('#product-list').html($(data).find('#product-list').html());
                        $('#pagination-links').html($(data).find('#pagination-links').html());
                    },
                    error: function() {
                        alert('حدث خطأ أثناء تحميل البيانات.');
                    }
                });
            });
        });
    </script>


    @include('sweetalert::alert')
    @if (session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 5000,
                background: '#ffffff',
                width: '400px',
                padding: '16px',
                backdrop: false,
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
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "{{ $errors->first() }}",
                showConfirmButton: false,
                timer: 5000,
                background: '#ffffff',
                width: '400px',
                padding: '16px',
                backdrop: false,
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
            });
        </script>
    @endif

</body>

</html>
