<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nest - Multipurpose eCommerce HTML Template</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="build/assets/imgs/theme/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="build/assets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="build/assets/css/main.css?v=5.3" />
    <style>
   

    
</style>
</head>

<body>



    


    @include('frontend.layout.body.navbar')




    <main class="main">

        @yield('home')

        @yield('login')

        @yield('register')

    </main>


    @include('frontend.layout.body.footer')




    @include('frontend.layout.body.preloader')



    <script src="build/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="build/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="build/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="build/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="build/assets/js/plugins/slick.js"></script>
    <script src="build/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="build/assets/js/plugins/waypoints.js"></script>
    <script src="build/assets/js/plugins/wow.js"></script>
    <script src="build/assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="build/assets/js/plugins/magnific-popup.js"></script>
    <script src="build/assets/js/plugins/select2.min.js"></script>
    <script src="build/assets/js/plugins/counterup.js"></script>
    <script src="build/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="build/assets/js/plugins/images-loaded.js"></script>
    <script src="build/assets/js/plugins/isotope.js"></script>
    <script src="build/assets/js/plugins/scrollup.js"></script>
    <script src="build/assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="build/assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="build/assets/js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <script src="build/assets/js/main.js?v=5.3"></script>
    <script src="build/assets/js/shop.js?v=5.3"></script>
</body>

</html>
