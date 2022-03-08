<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://demo.themesberg.com/pixel-bootstrap-5-ui-kit">
        <meta property="og:title" content="Pixel Bootstrap 5 - Sign in">
        <meta property="og:description" content="Open source and free Bootstrap 5 UI Kit featuring 80 UI components, 5 example pages, and a Gulp and Sass workflow.">
        <meta property="og:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/pixel-lite/pixel-lite-preview.jpg">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://demo.themesberg.com/pixel-bootstrap-5-ui-kit">
        <meta property="twitter:title" content="Pixel Bootstrap 5 - Sign in">
        <meta property="twitter:description" content="Open source and free Bootstrap 5 UI Kit featuring 80 UI components, 5 example pages, and a Gulp and Sass workflow.">
        <meta property="twitter:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/pixel-lite/pixel-lite-preview.jpg">


        <title>{{ config('app.name', 'AUTHENTICATION') }}</title>
        
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	  <link href="{{ asset('adminkit/static/css/app.css') }}" rel="stylesheet">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Fontawesome -->
        <link type="text/css" href="{{ asset('theme/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

        <!-- Pixel CSS -->
        <link type="text/css" href="{{ asset('theme/css/pixel.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    <script src="{{ asset('theme/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/headroom.js/dist/headroom.min.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('theme/vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/jarallax/dist/jarallax.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/vivus/dist/vivus.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Pixel JS -->
    <script src="{{ asset('theme/assets/js/pixel.js') }}"></script>
    <script src="{{ asset('js/alpine.js') }}" defer></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
