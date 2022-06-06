<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Primary Meta Tags -->
<title>{{ config('setting.app_name') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Primary Meta Tags -->
<title>{{ config('app.ngo_name') }} | Powered by FeedThePoor v2</title>
<meta name="title" content="{{ config('app.ngo_name') }} | Powered by FeedThePoor v2">
<meta name="description" content="We are one of India's primier charity organization that offers 100% transparency for every donation irrespective of size and amount. We achieve this with the help of modern information technology.">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://roshnicharitabletrust.org/">
<meta property="og:title" content="{{ config('app.ngo_name') }} | Powered by FeedThePoor v2">
<meta property="og:description" content="We are one of India's primier charity organization that offers 100% transparency for every donation irrespective of size and amount. We achieve this with the help of modern information technology.">
<meta property="og:image" content=https://cdn.discordapp.com/attachments/861662752174506035/983210476521553960/roshni_foundation_meta_poster.png"">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://roshnicharitabletrust.org/">
<meta property="twitter:title" content="{{ config('app.ngo_name') }} | Powered by FeedThePoor v2">
<meta property="twitter:description" content="We are one of India's primier charity organization that offers 100% transparency for every donation irrespective of size and amount. We achieve this with the help of modern information technology.">
<meta property="twitter:image" content="https://cdn.discordapp.com/attachments/861662752174506035/983210476521553960/roshni_foundation_meta_poster.png">

<link rel="icon" type="image/png" href="{{ asset('images/branding/roshni-foundation.png') }}">

<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

<!-- Fontawesome -->
<link type="text/css" href="{{ asset('theme/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
{{-- TODO This is required for the donation page, refactor it.--}}

<!-- Pixel CSS -->
<link type="text/css" href="{{ asset('theme/css/additional.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('theme/css/pixel.css') }}" rel="stylesheet">

{!! NoCaptcha::renderJs() !!}

@yield('css')

</head>

<body>
    @include('layouts.partials.header')
    @include('sweetalert::alert')
    <main>

        {{-- <div class="preloader bg-dark flex-column justify-content-center align-items-center">
            <svg id="loader-logo" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 64 78.4">
                <path fill="#fff" d="M10,0h1.2V11.2H0V10A10,10,0,0,1,10,0Z"/>
                <rect fill="none" stroke="#fff" stroke-width="11.2" x="40" y="17.6" width="0" height="25.6"/>
                <rect fill="none" stroke="#fff" stroke-opacity="0.4" stroke-width="11.2" x="23" y="35.2" width="0" height="25.6"/>
                <path fill="#fff" d="M52.8,35.2H64V53.8a7,7,0,0,1-7,7H52.8V35.2Z"/>
                <rect fill="none" stroke="#fff" stroke-width="11.2" x="6" y="52.8" width="0" height="25.6"/>
                <path fill="#fff" d="M52.8,0H57a7,7,0,0,1,7,7h0v4.2H52.8V0Z"/>
                <rect fill="none" stroke="#fff" stroke-opacity="0.4" stroke-width="11.2" x="57.8" y="17.6" width="0" height="11.2"/>
                <rect fill="none" stroke="#fff" stroke-width="11.2" x="6" y="35.2" width="0" height="11.2"/>
                <rect fill="none" stroke="#fff" stroke-width="11.2" x="40.2" y="49.6" width="0" height="11.2"/>
                <path fill="#fff" d="M17.6,67.2H28.8v1.2a10,10,0,0,1-10,10H17.6V67.2Z"/>
                <rect fill="none" stroke="#fff" stroke-opacity="0.4" stroke-width="28.8" x="31.6" width="0" height="11.2"/>
                <rect fill="none" stroke="#fff" x="14" stroke-width="28.8" y="17.6" width="0" height="11.2"/>
            </svg>
        </div> --}}

        <!-- Hero -->

        @yield('content')

    </main>

    @include('layouts.partials.footer')

    <!-- Core -->
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

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
@yield('js')
</body>

</html>
