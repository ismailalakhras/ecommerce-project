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
    <meta name="user-id" content="{{ auth()->id() }}">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <style>
        .chat-msg-animate {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease-in-out;
        }

        .chat-msg-animate.show {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll {
            scroll-behavior: smooth;
        }

        .chat-toggle-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #1d3557;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 50px;
            cursor: pointer;
            z-index: 9999;
            font-size: 16px;
        }

        .chat-aside {
            position: fixed;
            top: 0;
            right: -400px;
            width: 350px;
            height: 100%;
            background-color: #f1f1f1;
            box-shadow: -2px 0 8px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            z-index: 10000;
        }

        .chat-aside.open {
            right: 0;
        }

        .chat-header {
            background-color: #3bb77e;
            color: white;
            padding: 15px;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
        }

        .chat-box {
            max-width: 800px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .message-group {
            display: flex;
            gap: 10px;
        }

        .message-group.user {
            flex-direction: row-reverse;
            text-align: right;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ddd;
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .message-content {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .meta {
            font-size: 13px;
            color: #888;
        }

        .message-bubble {
            background-color: #e3f2fd;
            color: #333;
            padding: 10px 15px;
            border-radius: 10px;
            max-width: 500px;
            width: fit-content;
        }

        .user .message-bubble {
            align-self: flex-end;
            background-color: #d0ebff;
        }

        .user .meta {
            text-align: right;
        }

        .chat-footer {
            padding: 10px;
            border-top: 1px solid #ccc;
            background-color: #fff;
        }

        .chat-footer input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            outline: none;
        }



        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>





<body>
    <aside class="chat-aside" id="chatAside">
        <div class="chat-header">
            Chat Support
            <button class="close-btn">×</button>
        </div>
        <div class="chat-body" id="chatBody">

            <div id="frontend-chat-box" class="chat-box">

                {{-- <!-- Support Message Group -->
                <div class="message-group">
                    <div class="avatar">
                        <img src="https://i.imgur.com/6VBx3io.png" alt="avatar">
                    </div>
                    <div class="message-content">
                        <div class="meta">Support, 07:11 PM</div>
                        <div class="message-bubble">Eiusmod tempor incididunt ut labore.</div>
                    </div>
                </div>

                <!-- User Message -->
                <div class="message-group user">
                    <div class="message-content">
                        <div class="meta">you, 07:20 PM</div>
                        <div class="message-bubble">Eu fugiat nulla pariatur lorem ipsum.</div>
                    </div>
                </div>

                <!-- Multiple messages from support -->
                <div class="message-group">
                    <div class="avatar">
                        <img src="https://i.imgur.com/6VBx3io.png" alt="avatar">
                    </div>
                    <div class="message-content">
                        <div class="meta">Support, 07:45 PM</div>
                        <div class="message-bubble">Eiusmod tempor incididunt ut labore.</div>
                        <div class="meta">Support, 08:12 PM</div>
                        <div class="message-bubble">Consectetur adipiscing elit sed do.</div>
                        <div class="meta">Support, 09:08 PM</div>
                        <div class="message-bubble">Exercitation ullamco laboris nisi ut.</div>
                    </div>
                </div> --}}



            </div>


            {{-- <p><strong>Support:</strong> Hello! How can I help you?</p> --}}

        </div>
        <div class="chat-footer">
            <input id="frontend-input-message" type="text" placeholder="Type a message...">
        </div>
    </aside>
    <div id="support-btn" class="hotline">
        <img src="{{ asset('build/assets/imgs/theme/icons/icon-headphone.svg') }}" alt="hotline" />
        {{-- <p>Support <span>Support Center</span></p> --}}
    </div>

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
    <script src="{{ asset('assets/js/frontend/chat.js') }}"></script>


    <!-- Chat Scripts -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    @vite(['resources/js/app.js'])

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
