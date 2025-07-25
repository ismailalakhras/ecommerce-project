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

    <main id="content" class="main">
        @yield('content')
    </main>

    @include('frontend.pages.homePartials.quickView')

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
    <script src="{{ asset('assets/js/frontend/frontend.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#Proceed_to_checkout').click(function() {
                $('#shipping_addresses_form').toggle(500);
                $('#Proceed_to_checkout').hide()

            });
        });
    </script>

</body>

</html>
