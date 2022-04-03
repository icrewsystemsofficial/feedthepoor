@extends('layouts.frontend')

@section('css')
<style>
    #form {
        animation: fadeInAnimation ease 2s;
        animation-iteration-count: 1;
        animation-fill-mode: forwards;
    }

    @keyframes fadeInAnimation {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }
</style>
@endsection

@section('content')

<section class="section-header bg-dark mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <h1 class="display-4 text-white fs-1">
                    Contact us
                </h1>
                <p class="text-theme fs-2 fw-bolder">For all enquiries, email us using form below</p>
            </div>
        </div>
    </div>
</section>

<section class="" x-data="donationPage()" x-init="init()">
    <div class="container mt-n6 z-2 mb-5">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8">
                <div class="card shadow-lg border-gray-300 p-4 p-lg-5">

                    <p class="text-center text-dark fs-3 fw-bolder">How can we help you ?</p>

                    @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="far fa-thumbs-up"></i></span>
                        <span class="alert-inner--text"><strong>Well done!</strong> {{ session()->get('message') }}.</span>
                    </div>

                    @endif

                    <form action="{{route('frontend.savecontact')}}" method="POST" id="form">
                        @csrf

                        @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                        <p class="alert alert-danger"> {{$error}} </p>
                        @endforeach
                        @endif

                        <div class="mb-3">
                            <label for="name" class="d-flex">
                                <i class="fas fa-user pe-2 fs-4"></i>
                                Name : </label>
                            <input required="required" type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter your name...">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="d-flex">
                                <i class="fas fa-envelope pe-2 fs-4"></i>
                                Email : </label>
                            <input required="required" type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Enter your email...">
                        </div>

                        <div class="mb-3">
                            <label for="number" class="d-flex">
                                <i class="fas fa-phone pe-2 fs-4"></i>
                                Phone number : </label>
                            <input required="required" type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}" placeholder="Enter your phone number...">
                        </div>

                        <div class="mb-3">

                            <label for="message" class="d-flex">
                                <i class="fas fa-comment pe-2 fs-4" id="font"></i>
                                Message : </label>
                            <textarea required="required" class="form-control" name="message" value="{{old('message') }}" placeholder="Enter your message..." id="message" rows="4"></textarea>



                        </div>

                        <div class="mb-3 mt-3">
                            {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                        </div>



                        <div class="m-auto w-25 mt-3">
                            <input type="submit" class="btn btn-outline-dark text-center" type="button">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
