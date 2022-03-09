<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
      <meta name="author" content="icrewsystems">
      <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link rel="shortcut icon" href="{{ asset('adminkit/static/img/icons/icon-48x48.png') }}" />
      {{--
      <link rel="canonical" href="https://demo-basic.adminkit.io/" />
      --}}
      <title>{{ config('app.name') }} | Dashboard</title>

	  {{-- <link rel="stylesheet" href="https://demo.adminkit.io/css/dark.css"> --}}
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	  <link href="{{ asset('adminkit/static/css/app.css') }}" rel="stylesheet">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
      <script src="{{ asset('adminkit/static/js/app.js') }}"></script>
	  @yield('css')
   </head>
   <body>
      <div class="wrapper">
         <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
               <a class="sidebar-brand" href="index.html">
               <span class="align-middle">
               {{ config('app.name') }}
               </span>
               </a>

               @include('layouts.admin_sidebar')

               <div class="sidebar-cta">
                  <div class="sidebar-cta-content">
                     <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                     <div class="mb-3 text-sm">
                        Are you looking for more components? Check out our premium version.
                     </div>
                     <div class="d-grid">
                        <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
                     </div>
                  </div>
               </div>
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
	  @yield('js')

   </body>
</html>
