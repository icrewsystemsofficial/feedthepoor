<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="icrewsystems.com">
    <!-- Primary Meta Tags -->
    <title>#feedThePoor | Donate confidently & Transparently</title>
    <meta name="title" content="#feedThePoor | Donate confidently & Transparently">
    <meta name="description" content="#feedThePoor makes sure that your donation is transparent and gives you verification that your money actually reaches what you intended to.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://feedthepoor.online">
    <meta property="og:title" content="#feedThePoor | Donate confidently & Transparently">
    <meta property="og:description" content="#feedThePoor makes sure that your donation is transparent and gives you verification that your money actually reaches what you intended to.">
    <meta property="og:image" content="{{ asset('images/feedthepoor_meta_poster.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://feedthepoor.online">
    <meta property="twitter:title" content="#feedThePoor | Donate confidently & Transparently">
    <meta property="twitter:description" content="#feedThePoor makes sure that your donation is transparent and gives you verification that your money actually reaches what you intended to.">
    <meta property="twitter:image" content="{{ asset('images/feedthepoor_meta_poster.png') }}">
    <meta name="theme-color" content="#363636">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800|Roboto:400,500,700" rel="stylesheet">
    <!-- Theme CSS -->
    <link type="text/css" href="{{ asset('css/theme.css')}}" rel="stylesheet">
    <!-- FAQ CSS -->
    <link type="text/css" href="{{ asset('css/faq.css')}}" rel="stylesheet">
    <!-- Demo CSS - No need to use these in your project -->
    <link type="text/css" href="{{ asset('css/demo.css')}}" rel="stylesheet">

    <!-- Additional CSS codes -Leonard, 21/08/2020  -->
    <!-- testimonials css -->

    <link type="text/css" href="{{ asset('css/testimonials.css')}}" rel="stylesheet">
    <!-- Campaigns CSS -->
    <link type="text/css" href="{{ asset('css/campaigns.css')}}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/feedthepoor_logo_main.png') }}" type="image/png">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">
    <!--gallery-->
    {{-- <link type="text/css" href="{{ asset('css/homegallery.css')}}" rel="stylesheet"> --}}
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.14/css/lightgallery.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />

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

    @include('layouts.frontend.nav')
    <main class="main">
        @include('sweetalert::alert')
        @yield('content')
    </main>
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
    @notifyJs
</body>

</html>
