<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Probably the most complete UI kit out there. Multiple functionalities and controls added,  extended color palette and beautiful typography, designed as its own extended version of Bootstrap at  the highest level of quality.                             ">
    <meta name="author" content="Webpixels">
    <title>Boomerang UI Kit - Free Bootstrap Framework by Webpixels</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800|Roboto:400,500,700" rel="stylesheet">
    <!-- Theme CSS -->
    <link type="text/css" href="{{ asset('/assets/css/theme.css') }}" rel="stylesheet">
    <!-- Demo CSS - No need to use these in your project -->
    <link type="text/css" href="{{ asset('/assets/css/demo.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body>

    @yield('content')

    <!-- Core -->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/popper/popper.min.js"></script>
    <script src="./assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- FontAwesome 5 -->
    <script src="./assets/vendor/fontawesome/js/fontawesome-all.min.js" defer></script>
    <!-- Page plugins -->
    <script src="./assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="./assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="./assets/vendor/input-mask/input-mask.min.js"></script>
    <script src="./assets/vendor/nouislider/js/nouislider.min.js"></script>
    <script src="./assets/vendor/textarea-autosize/textarea-autosize.min.js"></script>
    <!-- Theme JS -->
    <script src="./assets/js/theme.js"></script>

    @yield('js')
</body>

</html>
