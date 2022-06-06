<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="icrewsystems">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('adminkit/static/img/icons/icon-48x48.png') }}"/>
    {{----}}
    <link rel="canonical" href="https://demo-basic.adminkit.io/"/>
    <title> 403 | Forbidden</title>


    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>

    {{-- APPs COMPILED CSS? --}}
    <link href="{{ asset('adminkit/static/css/app.css') }}" rel="stylesheet">

    {{-- WEBSITE ICONS (FONTAWESOME) --}}
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">--}}

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

</head>
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<main class="d-flex w-100 h-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center">
                        <h1 class="display-1 font-weight-bold">{{ $e->getStatusCode() }}</h1>
                        <p class="h2">{{ $e->getMessage() }}</p>
                        <p class="h3 font-weight-normal mt-3 mb-4">You don't have permissions to access this page </p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg"><- Go back </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>


</body>
</html>