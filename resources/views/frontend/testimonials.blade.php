@extends('layouts.frontend.app')

@section('meta')
    <title>
        Testimonials | FeedThePoor - Donate money confidently and Transparently
    </title>
@endsection

@section('css')
    <style>

    </style>
@endsection

@section('js')
    <script>
        var notify = {
            timeout: "5000",
            animatedIn: "bounceInRight",
            animatedOut: "bounceOutRight",
            position: "bottom-right"
        }

    </script>
@endsection

@section('content')
    <main class="main">

        <section class="slice slice-xl bg-white">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <p class="lead mt-3 lh-180 animated" data-animation-in="fadeInUp" data-animation-delay="2500">
                            <span style="font-size: 2.2rem;">
                                What do our donors say about
                                <strong>#feedThePoor</strong> ?
                            </span> <br>
                            Hear from the changemakers themselves!
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <section class="slice bg-white mb-5 ">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <h1 class="text-black">Want to share your experience?</h1>
                        <p class="text-black">We'd love to hear what's on your mind!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group col-sm">
                        <input type="text" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group col-sm">
                        <input type="text" class="form-control" placeholder="Phone">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm">
                        <textarea class="form-control" placeholder="Enter your message here..." rows="3"
                            resize="none"></textarea>
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-lg btn-outline-secondary btn-icon col-sm">
                        <span class="btn-inner--text">Submit my testimonial</span>
                        <span class="btn-inner--icon"><i class="fas fa-arrow-right"></i></span>
                    </button>
                </div>
        </section>


        <section id="wrapper">

            <section class="slice bg-primary">
                <div class="container">
                    <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space text-center text-lg-left">
                        <div class="col-lg-12">
                            <h1 class="heading h2 text-white strong-500">
                                We're more than thrilled
                            </h1>
                            <p class="text-white">
                                It's absolutely amazing for the team to hear what you feel about
                                <strong>#feed</strong>ThePoor! And the best part is, you would help us reach even more
                                changemakers!
                            </p>
                            <p class="lead text-white mb-0"></p>
                        </div>
                    </div>
                </div>
            </section>

    </main>
@endsection
