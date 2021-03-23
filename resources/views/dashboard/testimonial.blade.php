@extends('layouts.dashboard.admin')

@section('meta')
<title>
    Dashboard | FeedThePoor
</title>
@endsection

@section('css')
<style>
    /* Your Custom Styles Here*/
    .hero-section{
        height: calc(100vh - 5rem);
        width: 100vw;
    }
</style>
@endsection

@section('js')
<script>
    /* Your Custom Script Here*/
</script>
@endsection


@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Testimonial') }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-12 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Testimonial</h6>
                </div>

                <div class="card-body">



                </div>

            </div>

        </div>

    </div>

@endsection
