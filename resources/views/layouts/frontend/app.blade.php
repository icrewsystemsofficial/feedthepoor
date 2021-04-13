<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="Probably the most complete UI kit out there. Multiple functionalities and controls added,  extended color palette and beautiful typography, designed as its own extended version of Bootstrap at  the highest level of quality.                             ">
    <meta name="author" content="Webpixels">

    @yield('meta')

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800|Roboto:400,500,700" rel="stylesheet">
    <!-- Theme CSS -->
    <link type="text/css" href="{{ asset('css/theme.css') }}" rel="stylesheet">

    <style>
        .C-parallax {
            /*background-image: url("https://media.discordapp.net/attachments/530789778912837640/725054207295619123/bg2-min.png");*/
            background-image: url("https://cdn.discordapp.com/attachments/694578470772146237/744469327096447056/icrew_feed_the_poor_1.png");
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .C-donate-nav .nav-item .nav-link {
            background-color: white;
            transition: all 0.2s !important;
        }

        .C-donate-nav .nav-item .nav-link.active {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            border-radius: 10px !important;
        }

        .C-tab-cont {
            transition: all 0.2s ease;
        }

        .C-tab-item {
            padding: 20px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .C-nav-bg {
            background: rgba(0, 0, 0, 0.8);
            background: -moz-linear-gradient(top, rgba(0, 0, 0, 0.8) 0%, rgba(231, 56, 39, 0) 100%);
            background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0.8)), color-stop(100%, rgba(231, 56, 39, 0)));
            background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.8) 0%, rgba(231, 56, 39, 0) 100%);
            background: -o-linear-gradient(top, rgba(0, 0, 0, 0.8) 0%, rgba(231, 56, 39, 0) 100%);
            background: -ms-linear-gradient(top, rgba(0, 0, 0, 0.8) 0%, rgba(231, 56, 39, 0) 100%);
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8) 0%, rgba(231, 56, 39, 0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#000000', endColorstr='#e73827', GradientType=0);
        }

        .C-nav-white-bg {
            background-color: white;
        }

        .C-nav-link {
            color: white !important;
            transition: all 0.2s;
        }

        .Nav-scroll-text {
            color: black !important;
        }

        /*carousal height media query */
        @media screen and (min-width: 200px) {
            .extra {
                height: 250px;
                width: 8000px;
                object-fit: cover;
            }
        }

        @media screen and (min-width: 800px) {
            .extra {
                height: 500px;
                object-fit: cover;
            }
        }

    </style>

    @yield('css')
    @notifyCss

</head>

<body>
    @include('sweetalert::alert')

    @include('layouts.frontend.nav')

    @yield('content')

    @include('layouts.frontend.footer')

    <!-- Core -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/popper.js/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- FontAwesome 5 -->
    <script src="{{ asset('vendor/fontawesome/js/fontawesome-all.min.js') }}" defer></script>
    <!-- Page plugins -->
    <script src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('vendor/input-mask/input-mask.min.js') }}"></script>
    <script src="{{ asset('vendor/nouislider/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendor/textarea-autosize/textarea-autosize.min.js') }}"></script>
    <!-- Theme JS -->
    <script src="{{ asset('js/theme.js') }}"></script>

    <script>
        $(window).on("load", function() {
            if ($(location).attr('pathname') === '/donation/' || $(location).attr('pathname') ===
                '/donation/aboutus' || $(location).attr('pathname') === '/donation/volunteers' || $(location)
                .attr('pathname') === '/donation/partners' || $(location).attr('pathname') ===
                '/donation/mission') {
                $(window).scroll(function() {
                    if ($(document).scrollTop() > 50) {
                        $('.C-nav').removeClass('C-nav-bg');
                        $('.C-nav').addClass('C-nav-shadow');
                        $('.C-nav').addClass('C-nav-white-bg');
                        $('.C-nav-link').addClass('Nav-scroll-text');
                    } else {
                        $('.C-nav').removeClass('C-nav-shadow');
                        $('.C-nav-link').removeClass('Nav-scroll-text');
                        $('.C-nav').removeClass('C-nav-white-bg');
                        $('.C-nav').addClass('C-nav-bg');
                    }
                });
            } else {
                $('.C-nav').removeClass('C-nav-bg');
                $('.C-nav').addClass('C-nav-white-bg');
                $('.C-nav').addClass('C-nav-shadow');
                $('.C-nav-link').addClass('Nav-scroll-text');
            }

            function updateMeals(num) {
                $('.donate-meal-display').val(num + ' Meal');
                $('.donate-meal-button-span').text('Donate ' + (num * 60) + ' INR');
            }
            var total_meals = 1;
            updateMeals(total_meals);
            $('.donate-minus-button').on('click', function() {
                if (total_meals > 1) {
                    total_meals = total_meals - 1;
                    updateMeals(total_meals);
                }
            });
            $('.donate-plus-button').on('click', function() {
                total_meals = total_meals + 1;
                updateMeals(total_meals);
            });
            $('.donate-meal-button').on('click', function() {
                window.location.href = "{{ route('home') }}/" + (total_meals * 60);
            });
        });

    </script>

    @yield('js')
    @include('notify::messages')
        // Laravel 7 or greater
    <x:notify-messages />
    @notifyJs
</body>

</html>
