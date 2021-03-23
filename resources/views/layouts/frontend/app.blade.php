<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Probably the most complete UI kit out there. Multiple functionalities and controls added,  extended color palette and beautiful typography, designed as its own extended version of Bootstrap at  the highest level of quality.                             ">
    <meta name="author" content="Webpixels">

    @yield('meta')

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800|Roboto:400,500,700" rel="stylesheet">
    <!-- Theme CSS -->
    <link type="text/css" href="{{ asset('css/theme.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body>
    @include('sweetalert::alert')

    @include('layouts.frontend.nav')

    @yield('content')

    <!-- Core -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/popper.js/popper.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- FontAwesome 5 -->
    <script src="{{asset('vendor/fontawesome/js/fontawesome-all.min.js')}}" defer></script>
    <!-- Page plugins -->
    <script src="{{asset('vendor/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{asset('vendor/input-mask/input-mask.min.js')}}"></script>
    <script src="{{asset('vendor/nouislider/js/nouislider.min.js')}}"></script>
    <script src="{{asset('vendor/textarea-autosize/textarea-autosize.min.js')}}"></script>
    <!-- Theme JS -->
    <script src="{{asset('js/theme.js')}}"></script>

    @yield('js')
</body>

</html>
