@extends('layouts.layouts')

@section('content')

<section class="slice slice-xl bg-secondary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <p class="lead mt-3 lh-180 animated" data-animation-in="fadeInUp" data-animation-delay="2500">
                <span style="font-size: 2.2rem;">
                    What do our donors say about
                    <strong>#feedThePoor</strong> ?
                </span> <br />
                    Hear from the changemakers themselves!
                </p>
            </div>
        </div>
    </div>
</section>


<section class="slice bg-primary">
    <div class="container">
        <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space text-center text-lg-left">
            <div class="col-lg-7">
            <h1 class="heading h2 text-white strong-500">
                Want to share your experience?
            </h1>
            <p class="lead text-white mb-0">We'd love to hear what's on your mind!</p>
            </div>
            <div class="col-lg-3 ml-lg-auto">
            <div class="text-center text-md-right">
                <a href="{{ url('/testimonials/add') }}" class="btn bg-secondary">
                Submit my testimonial
                </a>
            </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-gradient-lighter slice-lg">
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

<section class="slice bg-primary">
  <div class="container">
    <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space text-center text-lg-left">
      <div class="col-lg-12">
        <h1 class="heading h2 text-white strong-500">
            We're more than thrilled
        </h1>
        <p class="text-white">
          It's absolutely amazing for the team to hear what you feel about <strong>#feed</strong>ThePoor! And the best part is, you would help us reach even more changemakers!
        </p>
        <p class="lead text-white mb-0"></p>
      </div>
    </div>
  </div>
</section>
@endsection