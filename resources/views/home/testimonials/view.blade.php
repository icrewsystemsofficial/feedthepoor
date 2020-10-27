@extends('layouts.layouts')

@section('content')

<section class="slice slice-xl bg-secondary">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <p class="lead mt-3 lh-180 animated" data-animation-in="fadeInUp" data-animation-delay="2500">
                {{ $testimonial->created_at->diffForHumans() }}, {{ $testimonial->name }} said <br />
                <h4 class="">{{ $testimonial->message }}</h4>

                <br />
                @if($testimonial->status == 2)
                  <span class="badge badge-warning"><i class="fa fa-star"></i> FEATURED</span>
                @endif
                </p>
            </div>
        </div>
    </div>
</section>

<section class="slice slice-xl">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <p class="lead mt-3 lh-180 animated" data-animation-in="fadeInUp" data-animation-delay="2500">
                  <span style="font-size: 2.2rem;">
                      <strong>#feedThePoor</strong> <i class="fa fa-heart text-danger"></i> {{ $testimonial->name }}
                  </span> <br />

                  <span class="text-muted">
                    When you share a testimonial it goes a long way, you inspire another person to donate and #feedThePoor.
                  </span>

                  <br /><br />
                  <a href="{{ url('/testimonials/add') }}" class="btn btn-sm btn-success btn-hover">
                    Write a testimonial
                  </a>

                  <!-- Add an interactive social share button here. Facebook, Twitter, & copy the text -->

                  <a href="{{ url('/testimonials/add') }}" class="btn btn-sm btn-secondary btn-hover">
                    Share this testimonial
                  </a>
                </p>
            </div>
        </div>
    </div>
</section>





<section class="bg-gradient-lighter slice-lg" style="display: none;">
    <div class="container">
        <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space">
            <div class="col-md-12 text-center">
                <div class="testimonial-slider">
                    <div class="testimonial-slider__wrp swiper-wrapper">
                        <div class="testimonial-slider__item swiper-slide">
                            <div class="testimonial-slider__content">
                                <span class="testimonial-slider__code">{{ $testimonial->created_at->format('j M Y') }}</span>
                                <div class="testimonial-slider__title">{{ $testimonial->name }}</div>
                                <div class="testimonial-slider__text">
                                    {{ $testimonial->message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <a href="{{ url('/testimonials') }}" class="btn bg-primary text-white">
                    View All Testimonials
                </a>
            </div>
        </div>
    </div>
</section>
<section class="slice bg-primary" style="display: none;">
    <div class="container">
        <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space text-center text-lg-left">
            <div class="col-lg-7">
            <h1 class="heading h2 text-white strong-500">
                Want to share your experience?
            </h1>
            <p class="text-white">
              All testimonials are verified and are displayed with proper consent of the author. To know more about our privacy policy, click <a href="{{ url('privacy') }}">here</a>
            </p>
            </div>
            <div class="col-lg-3 ml-lg-auto">
            <div class="text-center text-md-right">
                <a href="{{ url('/testimonials/add') }}" class="btn bg-secondary">
                  Share
                </a>
            </div>
            </div>
        </div>
    </div>
</section>
@endsection
