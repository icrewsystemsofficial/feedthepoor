<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="icrewsystems.com">
	<!-- Primary Meta Tags -->
	<title>#feedThePoor Initiative by icrewsystems</title>
	<meta name="title" content="#feedThePoor Initiative by icrewsystems">
	<meta name="description" content="#feedThePoor is an initiative by icrewsystems. #feedThePoor makes sure that your donation is transparent and gives you verification that your money actually reaches what you intended to.">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="https://feedthepoor.online">
	<meta property="og:title" content="#feedThePoor Initiative by icrewsystems">
	<meta property="og:description" content="#feedThePoor is an initiative by icrewsystems. #feedThePoor makes sure that your donation is transparent and gives you verification that your money actually reaches what you intended to.">
	<meta property="og:image" content="https://cdn.discordapp.com/attachments/703998770332827740/745467105410940978/feedthepoor_meta_poster.png">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="https://feedthepoor.online">
	<meta property="twitter:title" content="#feedThePoor Initiative by icrewsystems">
	<meta property="twitter:description" content="#feedThePoor is an initiative by icrewsystems. #feedThePoor makes sure that your donation is transparent and gives you verification that your money actually reaches what you intended to.">
	<meta property="twitter:image" content="https://cdn.discordapp.com/attachments/703998770332827740/745467105410940978/feedthepoor_meta_poster.png">
	<meta name="theme-color" content="#363636">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800|Roboto:400,500,700" rel="stylesheet">
    <!-- Theme CSS -->
    <link type="text/css" href="{{ asset('boomerang/assets/css/theme.css')}}" rel="stylesheet">
    <!-- FAQ CSS -->
    <link type="text/css" href="{{ asset('boomerang/assets/css/faq.css')}}" rel="stylesheet">
    <!-- Demo CSS - No need to use these in your project -->
    <link type="text/css" href="{{ asset('boomerang/assets/css/demo.css')}}" rel="stylesheet">
    <!-- testimonials css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">

	<link rel="icon" href="https://cdn.discordapp.com/attachments/530789778912837640/691801343723307068/1585008642050.png" type="image/png">

    <style>
        ::-webkit-scrollbar {
            width: 14px;
        }

        ::-webkit-scrollbar-thumb {
            background-clip: content-box;
            border: 4px solid transparent;
            border-radius: 7px;
            box-shadow: inset 0 0 0 10px;
        }

        ::-webkit-scrollbar-button {
            width: 0;
            height: 0;
            display: none;
        }

        ::-webkit-scrollbar-corner {
            background-color: transparent;
        }

            {
            overflow: auto;
            color: #00000000;
            transition: color 0.3s;

            &:hover {
                color: #666666FF;
            }
        }

        ::-webkit-scrollbar-track{
            border-left: 1px solid rgba(0, 0, 0, 0.1);
        }

        ::-webkit-scrollbar-track-piece:start {
            background: transparent url("{{ asset('assets/images/backgrounds/scrollbar.png')}}") repeat-y !important;
        }

        ::-webkit-scrollbar-track-piece:end {
            background: transparent url("{{ asset('assets/images/backgrounds/scrollbar.png')}}") repeat-y !important;
        }

        .C-nav-shadow {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1) !important;
        }

        .C-parallax {
            /*background-image: url("https://media.discordapp.net/attachments/530789778912837640/725054207295619123/bg2-min.png");*/
            background-image: url("https://cdn.discordapp.com/attachments/694578470772146237/744469327096447056/icrew_feed_the_poor_1.png");
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .C-donate-nav .nav-item .nav-link{
            background-color: white;
            transition: all 0.2s !important;
        }
        .C-donate-nav .nav-item .nav-link.active{
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            border-radius: 10px !important;
        }
        .C-tab-cont{
            transition: all 0.2s ease;
        }
        .C-tab-item{
            padding: 20px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }
        .C-nav{

        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    @yield('css')
    @notifyCss
</head>

<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-transparent navbar-dark bg-dark py-4"> -->
    <nav class="C-nav navbar fixed-top navbar-expand-lg navbar-light bg-dark"
        style="background-color: white !important; !important; border-bottom: 1px solid rgba(0,0,0,0.1); transition: all 0.2s;">
        <div class="container">
            <a class="navbar-brand px-2" href="{{ env('APP_URL') }}" style="color: #708090">
                <strong style="color: black">#feed</strong>ThePoor
            </a>
            <button class="navbar-toggler" type="button" data-action="offcanvas-open" data-target="#navbar_main"
                aria-controls="navbar_main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fas fa-bars"></span>
            </button>
            <div class="navbar-collapse offcanvas-collapse" id="navbar_main">
                <ul class="navbar-nav ml-auto align-items-lg-center">
                    <li class="nav-item">

                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/who-did-we-feed-today') }}">Who did we feed today?</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbar_main_dropdown_1" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About</a>
                        <div class="dropdown-menu" aria-labelledby="navbar_1_dropdown_1">
                            <a class="dropdown-item" href="{{url ('/aboutus')}}">About us</a>
                            <a class="dropdown-item" href="{{url ('/work')}}">How does it work</a>
                            <a class="dropdown-item" href="{{url ('/volunteers')}}">Volunteers</a>
                            <a class="dropdown-item" href="{{url ('/partners')}}">Partners</a>
                            <a class="dropdown-item" href="{{url ('/contact')}}">Contact</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./docs/introduction.html">Docs</a>
                    </li>
                    <a class="nav-link" href="{{ url('/money') }}">
                        <button class="btn btn-block btn-sm bg-gradient-blue text-white btn-animated btn-animated-y">
                            <span class="btn-inner--visible">Donate Now</span>
                            <span class="btn-inner--hidden"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main">
        @include('notify::messages')
        @yield ('content')
    </main>


    <footer class="pt-5 pb-3 footer  footer-dark bg-tertiary">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="pr-lg-5">
                        <h1 class="heading h6 text-uppercase font-weight-700 mb-3">icrewsystems LLP</h1>
                        <p>
                            icrewsystems is a start up based out of Chennai, India. We constantly tend to push beyond
                            the
                            limits of what is possible with this generations most powerful tool, the internet. We are
                            re-imagining the web, one page at a time</p>
                    </div>
                </div>
                <div class="col-6 col-md">
                </div>
                <div class="col-6 col-md">
                </div>
                <div class="col-6 col-md">
                    <h5 class="heading h6 text-uppercase font-weight-700 mb-3">QuickLinks</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">FAQ</a></li>
                        <li><a class="text-muted" href="#">Support</a></li>
                        <li><a class="text-muted" href="#">Report a problem</a></li>
                        <li><a class="text-muted" href="#">Feedback</a></li>
                        <li><a class="text-muted" href="#">Main Page</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <script type="text/javascript"
                        src="//rf.revolvermaps.com/0/0/6.js?i=5rmj73h4zxx&amp;m=0c&amp;c=ff0000&amp;cr1=ffffff&amp;f=calibri&amp;l=1&amp;v0=20&amp;lx=60&amp;ly=-160&amp;he=3&amp;cw=ffffff&amp;cb=152230"
                        async="async"></script>
                </div>
            </div>
            <hr>
            <div class="d-flex align-items-center">
                <span class="">
                    {{ env('APP_NAME') }} &copy; {{ date('Y') }} developed by <a href="https://icrewsystems.com"
                        class="footer-link" target="_blank">icrewsystems Software Development LLP</a>. All rights
                    reserved.
                </span>
                <ul class="nav ml-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="https://instagram.com/icrewsystemsofficial" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://facebook.com/icrewsystems.com" target="_blank"><i
                                class="fab fa-facebook"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://github.com/icrewsystemsofficial" target="_blank"><i
                                class="fab fa-github"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- Core -->
    <script src="{{ asset('boomerang/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('boomerang/assets/vendor/popper/popper.min.js')}}"></script>
    <script src="{{ asset('boomerang/assets/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- FontAwesome 5 -->
    <script src="{{ asset('boomerang/assets/vendor/fontawesome/js/fontawesome-all.min.js')}}" defer></script>
    <!-- Page plugins -->
    <script src="{{ asset('boomerang/assets/vendor/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ asset('boomerang/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('boomerang/assets/vendor/input-mask/input-mask.min.js')}}"></script>
    <script src="{{ asset('boomerang/assets/vendor/nouislider/js/nouislider.min.js')}}"></script>
    <script src="{{ asset('boomerang/assets/vendor/textarea-autosize/textarea-autosize.min.js')}}"></script>
    <!-- Theme JS -->

    <script src="{{ asset('boomerang/assets/js/theme.js')}}"></script>
    <script>
        $(window).scroll(function() {
            if ($(document).scrollTop() > 50) {
                $('.C-nav').addClass('C-nav-shadow');

            } else {
                $('.C-nav').removeClass('C-nav-shadow');
            }
        });
    </script>
    <!-- FAQ JS -->
    <script src="{{ asset('boomerang/assets/js/faq.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swipejs/2.2.18/swipe.min.js"></script>
    @yield('js')
    @notifyJs
</body>

</html>
