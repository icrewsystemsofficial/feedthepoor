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
      <link rel="shortcut icon" href="{{ asset('adminkit/dist/img/icons/icon-48x48.png') }}" />
      {{-- 
      <link rel="canonical" href="https://demo-basic.adminkit.io/" />
      --}}
      <title>{{ config('app.name') }} | Dashboard</title>
      
	  {{-- <link rel="stylesheet" href="https://demo.adminkit.io/css/dark.css"> --}}
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>	
	  <link href="{{ asset('adminkit/dist/css/app.css') }}" rel="stylesheet">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

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
            <nav class="navbar navbar-expand navbar-light navbar-bg">
               <a class="sidebar-toggle js-sidebar-toggle">
               <i class="hamburger align-self-center"></i>
               </a>
               <div class="navbar-collapse collapse">
                  <ul class="navbar-nav navbar-align">
                     <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                           <div class="position-relative">
                              <i class="align-middle" data-feather="bell"></i>
                              <span class="indicator">4</span>
                           </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                           <div class="dropdown-menu-header">
                              4 New Notifications
                           </div>
                           <div class="list-group">
                              <a href="#" class="list-group-item">
                                 <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                       <i class="text-danger" data-feather="alert-circle"></i>
                                    </div>
                                    <div class="col-10">
                                       <div class="text-dark">Update completed</div>
                                       <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                       <div class="text-muted small mt-1">30m ago</div>
                                    </div>
                                 </div>
                              </a>
                              <a href="#" class="list-group-item">
                                 <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                       <i class="text-warning" data-feather="bell"></i>
                                    </div>
                                    <div class="col-10">
                                       <div class="text-dark">Lorem ipsum</div>
                                       <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                                       <div class="text-muted small mt-1">2h ago</div>
                                    </div>
                                 </div>
                              </a>
                              <a href="#" class="list-group-item">
                                 <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                       <i class="text-primary" data-feather="home"></i>
                                    </div>
                                    <div class="col-10">
                                       <div class="text-dark">Login from 192.186.1.8</div>
                                       <div class="text-muted small mt-1">5h ago</div>
                                    </div>
                                 </div>
                              </a>
                              <a href="#" class="list-group-item">
                                 <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                       <i class="text-success" data-feather="user-plus"></i>
                                    </div>
                                    <div class="col-10">
                                       <div class="text-dark">New connection</div>
                                       <div class="text-muted small mt-1">Christina accepted your request.</div>
                                       <div class="text-muted small mt-1">14h ago</div>
                                    </div>
                                 </div>
                              </a>
                           </div>
                           <div class="dropdown-menu-footer">
                              <a href="#" class="text-muted">Show all notifications</a>
                           </div>
                        </div>
                     </li>                    
                     <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                            <i class="align-middle" data-feather="settings"></i>
                        </a>
                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                            <img src="{{ asset('adminkit/dist/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                           <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                           <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                           <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="#">Log out</a>
                        </div>
                     </li>
                  </ul>
               </div>
            </nav>
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
      <script src="{{ asset('adminkit/dist/js/app.js') }}"></script>      
	  @yield('js')
   </body>
</html>