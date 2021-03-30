@extends('layouts.frontend.app')

@section('404errorcontent')
    <section style="padding-top: 100px; padding-bottom:50px;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <img src="img/svg/pagenotfound.svg" class="w-50" alt="Page Not Found SVG">
                    <h2 class="mt-4">Page Not Found</h2>
                    <p>We are sorry, the page you requested could not be found. Please go back to the homepage.</p>
                    <a href="/" class="btn btn-primary">Visit Homepage</a>
                </div>
            </div>
        </div>
    </section>
@endsection