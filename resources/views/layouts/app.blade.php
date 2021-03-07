<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Dashboard for admins, Roshni Foundation">
  <meta name="author" content="icrewsystems Software Engineering LLP | Chennai">
  <title>Dashboard | {{ env('APP_NAME') }}</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  @notifyCss
</head>

<body class="bg-gradient-primary">

  <br /><br />
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card o-hidden border-0 shadow-lg">
          <div class="card-body text-center">
            {{ env('APP_NAME') }} Initiative
          </div>
        </div>
      </div>
    </div>
  </div>
  <br /><br />

  @include('notify::messages')
  @yield('content')

  <br /><br />
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card o-hidden border-0 shadow-lg">
          <div class="card-body text-center">
            <span>Made with <i class="fa fa-heart text-danger"></i> by <a href="https://icrewsystems.com?ref={{ env('APP_URL') }}">icrewsystems</a> in India</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br /><br />
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

  @notifyJs
</body>
</html>
