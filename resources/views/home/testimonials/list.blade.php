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


<section id="wrapper">
    <div class="container">
        <div class="row">
            @if(isset($testimonials) && $testimonials->count()>0)
            @foreach($testimonials as $testimonial)
            <div class="col-md-6">
                <a href="{{ url('/testimonials/view/'.\Illuminate\Support\Facades\Crypt::encryptString($testimonial->id)) }}">
                    <div class="testimonial-slider">
                        <div class="testimonial-slider__wrp swiper-wrapper">
                            <div class="testimonial-slider__item swiper-slide">
                                <div class="testimonial-slider__img">
                                    <img src="https://cdn.discordapp.com/attachments/720604361310470146/769171117696483328/testimonials-icon.png" alt="">
                                </div>
                                <div class="testimonial-slider__content">
                                    <span class="testimonial-slider__code">{{ $testimonial->created_at->format('j M Y') }}</span>
                                    <div class="testimonial-slider__title">{{ $testimonial->name }}</div>
                                    <div class="testimonial-slider__text">
                                        {{ \Illuminate\Support\Str::limit($testimonial->message,50) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <br><br>
            </div>
            @endforeach
            @else
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h2 class="heading pt-3 pb-2 text-white">
                        No Testimonials Found<br />
                        </h2>
                        <p class="mb-5">
                        We don't have any testimonials to show here yet! Submit your testimonial using the button alongside!
                        </p>
                        <a class="btn btn-block btn-sm bg-white text-blue btn-animated btn-animated-y" href="{{ url('/testimonials/add') }}">
                        <span class="btn-inner--visible">Submit Testimonial</span>
                        <span class="btn-inner--hidden"><i class="fas fa-arrow-right"></i></span>
                        </a>
                    </div>
                    </div>
                </div>
            </div>
            <br><br>
            @endif
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
