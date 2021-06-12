
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
                <form action="{{ route('testimonial') }}"  method="post">

                    <div class="input-group mb-3">
                    @csrf
                        <input type="text" name="test" class="form-control" placeholder="Write your Testimonial" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" type="button">Add</button>
                                </div>
                    </div>

</form>
                 </div>

            </div>

        </div>

    </div>

@endsection

