@extends('layouts.frontend')

@section('css')

@endsection

@section('content')


<section class="section-header bg-dark mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <h1 class="display-4 text-white">
                    <div class="mt-2 mb-1 h2">
                        <span class="text-theme">
                            NGO Activity
                        </span>
                </h1>
                <small>
                    <span class="display-6 text-white">
                        At {{ config('app.ngo_name') }}, we believe in complete transparency to
                        higher volume of donations. Keeping in mind the privacy of our donors, we've shown only need-to-know information about
                        the donations.
                    </span>
                </small>
            </div>
        </div>
    </div>
</section>

<section class="">
    <div class="container mt-n6 z-2 mb-5">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-10">
                <div class="card shadow-lg border-gray-300 p-4 p-lg-5">
                    <div class="alert alert-danger">
                        <i class="fas fa-info-circle"></i> We're currently working on this feature. Please check back later.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
