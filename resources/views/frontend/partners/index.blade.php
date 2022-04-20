@extends('layouts.frontend')

@section('meta')
<title>
    {{ config('app.name') }} | Donate Transparently
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('css')
<style>
    .hero-header {
        min-height: 50vh;
        max-height: 100vh;
        background: url('{{ asset('images/branding/partners/banner.jpg') }}') center center no-repeat;
        background-size: cover;
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .hero-header::before{
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
    }

    .spotlight-partners{
        filter: grayscale(100%);
        opacity: 0.8;
        width: 80%;
        display: block;
        margin: 0 auto;
    }
</style>
@endsection

@section('content')

<section class="section section-header text-white hero-header">
    <div class="container" style="position: relative;z-index: 2;">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-md-7 col-lg-6 text-center text-md-left">
                <h1 class="display-3 mb-4">
                    Join hands with us to make a difference
                </h1>
                <p class="lead mb-4 text-muted">
                    Offer your expertise to help us put a smile on a face.
                </p>
                <a href="#partners" class="btn btn-tertiary me-3 animate-up-2">
                    Read More <span class="ms-2"><span class="fas fa-arrow-down"></span></span>
                </a>
            </div>

            <div class="col-12 col-md-5 d-none d-md-block text-center">
                <img src="{{ asset('images/branding/roshni-foundation.png') }}" alt="">
            </div>

       </div>
    </div>
</section>


<section class="section text-black pb-md-8" id="partners">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center display-3">
                    Partnership has its benefits
                </h2>
                <p class="text-center text-muted mb-6 display-5">
                    You help us to make a difference and we give you a chance to be a part of it
                </p>
            </div>
        </div>

        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-md-6 col-lg-6 text-md-left" style="padding-right: 45px;">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-md-6 col-lg-6">
                        <img src="{{ asset('images/branding/partners/success1.jpg') }}" alt="" srcset="" style="width: 100%; float: left; ">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <img src="{{ asset('images/branding/partners/success2.jpg') }}" alt="" srcset="" style="width: 100%; float: right; margin-top: 5% !important;">
                        <img src="{{ asset('images/branding/partners/success3.jpg') }}" alt="" srcset="" style="width: 100%; float: right; margin-top: 5% !important;">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 text-md-left">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-md-6 col-lg-6">
                        <h2 class="text-center display-5">
                            Partnership has its benefits
                        </h2>
                        <p class="text-center text-muted mb-6">
                            You help us to make a difference and we give you a chance to be a part of it
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <h2 class="text-center display-5">
                            Partnership has its benefits
                        </h2>
                        <p class="text-center text-muted mb-6">
                            You help us to make a difference and we give you a chance to be a part of it
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section text-black pb-md-8">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-6">
                <h1 class="text-center mt-auto">
                    <span class="display-1">15M+</span><br> People helped
                </h1>
                <p class="text-center text-muted">
                    {{ config('app.ngo_name') }} <br>connects those in need with those who can help them.
                </p>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <img src="{{ asset('images/branding/partners/feeding.jpg') }}" alt="" srcset="" style="width: 90%; float: left; margin-left: 5%;">
            </div>            
        </div>
    </div>
</section>

<section class="section bg-gray pt-0 pb-md-8 text-white" style="padding-bottom: 0px !important;">
    <div class="container text-center">
        <div class="row justify-content-center p-6">
            <div class="col-12 col-md-10 col-lg-8">
                <h2 class="display-3 mb-4">
                    Join hands to <span class="font-bold fst-italic text-theme">make a difference</span>
                </h2>
                <p class="display-5 mb-4">
                    Your support would mean more dreams fulfilled and a better future, together.
                </p>
                <a href="" class="btn btn-tertiary me-3 animate-up-2">
                    Reach out to us<span class="ms-2"><span class="fas fa-arrow-down"></span></span>
                </a>
            </div>
        </div>
    </div>
</section>
    
<section class="section text-black pb-md-8">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center display-3">
                    Our Partners
                </h2>
                <p class="text-center text-muted mb-6 display-5">
                    We are proud to drive towards change with the following organizations.
                </p>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-12 col-md-3">
                <img class="spotlight-partners" src="{{ asset('images/branding/partners/logos/logo.png') }}" alt="">
            </div>
            <div class="col-12 col-md-3">
                <img class="spotlight-partners" src="{{ asset('images/branding/partners/logos/logo.png') }}" alt="">
            </div>
            <div class="col-12 col-md-3">
                <img class="spotlight-partners" src="{{ asset('images/branding/partners/logos/logo.png') }}" alt="">
            </div>
            <div class="col-12 col-md-3">
                <img class="spotlight-partners" src="{{ asset('images/branding/partners/logos/logo.png') }}" alt="">
            </div>
        </div>
    </div>
</section>

<section class="section pb-md-8">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-6" style="padding-right: 0px !important;">
                <img src="{{ asset('images/branding/partners/testimonial.jpg') }}" alt="" srcset="" style="width: 100%; float: left; height: 100vh !important;">
            </div>
            <div class="col-12 col-md-6 col-lg-6 bg-gray text-white" style="height: 100vh; padding: 60px;">
                <div class="row align-items-center my-auto h-100">
                    <h1 class="text-center display-4">
                        "We are proud to drive towards change with the following organizations. We are proud to drive towards change with the following organizations."
                    </h1>
                    <p class="text-center text-muted" style="padding: 20px;">
                        - {{ config('app.ngo_name') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection