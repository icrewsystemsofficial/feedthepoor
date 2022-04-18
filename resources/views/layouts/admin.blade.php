<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
   <meta name="author" content="icrewsystems">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link rel="shortcut icon" href="{{ asset('adminkit/static/img/icons/icon-48x48.png') }}" />
   {{----}}
   <link rel="canonical" href="https://demo-basic.adminkit.io/" />
   <title>{{ config('app.name') }} | Dashboard</title>

   {{-- <link rel="stylesheet" href="https://demo.adminkit.io/css/dark.css"> --}}

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />

    {{-- APPs COMPILED CSS? --}}
    <link href="{{ asset('adminkit/static/css/app.css') }}" rel="stylesheet">

    {{-- WEBSITE ICONS (FONTAWESOME) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    {{--
        THIS LINK TO BE DEPRECATED / UPDATED,
        - LEONARD

    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css"> --}}

    {{-- WEBSITE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
    /* ALPINE JS CLOAK VARIABLE */
      [x-cloak] {
         display: none !important;
      }
    </style>

   @yield('css')

   {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}

   {{-- BOTH THESE BOOTSTRAP JS FILES ARE REQUIRED! --}}
   <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   {{-- APP JS --}}
   <script src="{{ asset('adminkit/static/js/app.js') }}"></script>
   {{-- ALPINE JS --}}
   <script src="{{ asset('js/alpine.js') }}" defer></script>
   {{-- SWEETALERT JS --}}
   <script src="{{ asset('js/sweetalert.js') }}"></script>
   @yield('js')
</head>

<body>

   @include('sweetalert::alert')

   <div class="wrapper">
      <nav id="sidebar" class="sidebar js-sidebar">
         <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="index.html">
               <span class="align-middle">
                  {{ config('app.name') }}
               </span>
            </a>
            <div class="sidebar-cta">
                <div class="sidebar-cta-content">
                   <strong class="d-inline-block mb-2">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Action Required (WIP)</strong>
                   <div class="mb-3">
                      There are X unacknowledged items in
                      procurement list.
                   </div>
                   <div class="d-grid">
                      <a href="{{ route('admin.operations.procurement.index') }}" class="btn btn-primary">
                        View
                      </a>
                   </div>
                </div>
             </div>
            @include('layouts.admin_sidebar')
         </div>
      </nav>
      <div class="main">
         @include('layouts.admin_navbar')
         <main class="content">
            <div class="container-fluid p-0">
               @yield('content')
            </div>
         </main>
         <footer class="footer">
            <div class="container-fluid">
               <div class="row text-muted">
                  <div class="col-6 text-start">
                     <p class="mb-0">
                        <strong>{{ config('app.name') }}</strong>
                     </p>
                  </div>
                  {{--
                     <div class="col-6 text-end">
                        <ul class="list-inline">
                           <li class="list-inline-item">
                              <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                           </li>
                           <li class="list-inline-item">
                              <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                           </li>
                           <li class="list-inline-item">
                              <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                           </li>
                           <li class="list-inline-item">
                              <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                           </li>
                        </ul>
                     </div>
                     --}}
               </div>
            </div>
         </footer>
      </div>
   </div>
</body>

</html>
