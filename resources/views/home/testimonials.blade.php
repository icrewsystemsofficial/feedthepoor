@extends('layouts.layouts')
@section('css')	
  <link	
    rel="stylesheet"	
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"	
  />	
@endsection
@section('content')
<style media="screen">
  .heading3{
    padding-left: 8%;
  }
</style>

<section class="spotlight C-parallax bg-cover bg-size--cover" data-spotlight="fullscreen">
  <span class="mask bg-tertiary alpha-5"></span>
  <div class="spotlight-holder py-lg pt-lg-xl">
    <div class="container d-flex align-items-center no-padding">
      <div class="col">
        <div class="row cols-xs-space align-items-center text-center text-md-left justify-content-start">
          <div class="col-7">
            <div class="text-left mt-5">
              <img src="https://cdn.discordapp.com/attachments/530789778912837640/691801343723307068/1585008642050.png"
                  style="width: 200px;" class="img-fluid animated" data-animation-in="jackInTheBox"
                  data-animation-delay="1000">
              <h4 class="lead text-white mt-3 lh-180 c-white animated" data-animation-in="fadeInUp"
                  data-animation-delay="2500">
                  <span style="font-size: 3rem;">#ShareYourThoughts</span> <br />
                  "We always love to hear from you"
              </h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="py-xl">
  <!-- <span class="mask bg-primary alpha-6"></span> -->
  <div class="container d-flex align-items-center no-padding">
    <div class="col">  
      @error('general')
      <div class="row">
        <div class="col-md-12">
          <div class="card bg-danger text-white">
            <div class="card-body">
              @error('general_title')
              <h2 class="heading pt-3 pb-2 text-white">
                {{ $message }}<br />
              </h2>
              @enderror
              @error('general_msg')
              <p class="mb-5">
                {{ $message }}
              </p>
              @enderror
              @error('btn_link')
              <a class="btn btn-block btn-sm bg-white text-blue btn-animated btn-animated-y" href="{{ $message }}">
                <span class="btn-inner--visible">@error('btn_text') {{ $message }} @enderror</span>
                <span class="btn-inner--hidden"><i class="fas fa-arrow-right"></i></span>
              </a>
              @enderror
            </div>
          </div>
        </div>
      </div>
      <br><br>
      @enderror
      @if(session()->has('success'))
      <div class="row">
        <div class="col-md-12">
          <div class="card bg-success text-white">
            <div class="card-body">
              <h2 class="heading pt-3 pb-2 text-white">
                Thank you for your testimonial!<br />
              </h2>
              <p class="mb-5">
                Your testimonial has been submitted succesfully! Each testimonial goes a long way in reaching more people who can make a change! Thank you for taking the time to submit a testimonial! We'll inform you when the testimonial goes live on our website!
              </p>
            </div>
          </div>
        </div>
      </div>
      <br><br>
      @endif
      <div class="row">
        <div class="col-md-12">
            <div class="card bg-tertiary text-white">
              <div class="card-body">
                <h2 class="heading pt-3 pb-2 text-white">
                  How was your experience with <strong>#feed</strong>ThePoor?<br />
                </h2>
                <p class="mb-5">
                  Please note that testimonials can only be submitted after you've donated. To donate now, <strong><a href="{{ url('/money') }}">click here</a></strong>. All fields are required.
                </p>
                <form method="POST" action="{{ url('/testimonialsuccess') }}">
                  <div class="form-row">
                    {{ csrf_field() }}
                    <div class="col-md-12 mb-3">
                      <label for="full_name">Full Name</label>
                      <input type="text" class="form-control " id="full_name" placeholder="What do we call you?" name="full_name" required>
                      @error('full_name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div><br>
                  <div class="form-row">
                    <div class="col-lg-12 mb-3">
                      <label for="email">Email ID: (which was used while donation)</label>
                      <input type="email" value="" autocomplete="on" class="form-control " id="email" name="email" placeholder="Email ID">
                      @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div><br>
                  <div class="form-row">
                    <div class="col-lg-12 mb-3">
                      <label for="message">Testimonial:</label>
                      <textarea name="message" id="message" rows="8" cols="125" class="form-control" placeholder="Express your thoughts here..."></textarea>
                      @error('message')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                  <button class="btn btn-primary" type="submit">Submit form</button> &nbsp;&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-warning" type="reset">Reset</button>
                </form>
              </div><br>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="slice bg-primary">
  <div class="container">
    <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space text-center text-lg-left">
      <div class="col-lg-12">
        <h1 class="heading h2 text-white strong-500">
            It's absolutely amazing for the team to hear what you feel about <strong>#feed</strong>ThePoor! And the best part is, you would help us reach even more changemakers!
        </h1>
        <p class="lead text-white mb-0"></p>
      </div>
    </div>
  </div>
</section>

@endsection