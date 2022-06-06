@extends('layouts.frontend')
@section('meta')
    <title>
        {{ config('app.name') }} | Donate Transparently
    </title>
@endsection
@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="display-4 mt-9">
                   Coming soon.
                </h2>

                <p class="lead mt-5">
                    Our friends at <a href="https://icrewsystems.com?_ref={{ config('app.url') }}" class="" target="_blank">icrewsystems</a> are working on this page.
                    We'll keep you posted on our social media when we deploy an update.
                    Meanwhile, you can still donate.

                    <div class="text-center mt-2">
                        <a href="{{ route('frontend.donate') }}" class="btn btn-secondary">
                            Donate
                        </a>
                    </div>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
