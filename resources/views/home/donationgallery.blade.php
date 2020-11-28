@extends('layouts.layouts')

@section('content')

<style media="screen">
  .heading3{
    padding-left: 8%;
  }
</style>

<section class="spotlight C-parallax bg-cover bg-size--cover" data-spotlight="fullscreen" style="background-image: url({{asset('images/subheader_contactpage.jpg')}})">
    <span class="mask bg-tertiary alpha-5"></span>
    <div class="spotlight-holder py-lg pt-lg-xl">
        <div class="container d-flex align-items-center no-padding">
            <div class="col">
                <div class="row cols-xs-space align-items-center text-center text-md-left justify-content-start">
                    <div class="col-4">
                        <div class="text-left mt-2">
                          <img src="https://cdn.discordapp.com/attachments/530789778912837640/691801343723307068/1585008642050.png"
                              style="width: 200px;" class="img-fluid animated" data-animation-in="jackInTheBox"
                              data-animation-delay="1000">

                            <!-- <h2 class="heading display-4 font-weight-400 text-white mt-5 animated" data-animation-in="fadeInUp" data-animation-delay="2000">
                <span class="font-weight-700">812</span> hungry mouths fed today
              </h2> -->
                            <h4 class="lead text-white mt-3 lh-180 c-white animated" data-animation-in="fadeInUp"
                                data-animation-delay="2500">
                                <span style="font-size: 3rem;">#WhoDidWeFeedToday?</span> <br />
                                "Here's an overview."
                            </h4>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section><br><br><br><br>

<section>
    <div class="container">
        <div class="navabar-search">
        <form action="{{url('/who-did-we-feed-today/search-results')}}" method="GET" class="navbar-search__form">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group" style="display:flex">
            <input type="text" class="form-control" value="" name="query" id="query"
                placeholder="Search">
            <button class="btn btn-primary navbar-search__button"> Search
            </button>
                 </div>
            </div>
            </div>
        </div>
            </form>
        </div>
    </div>
</section>

<section id="wrapper">
    <div class="container">
        <div class="row">
            @foreach($donationData as $data)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    <h5 class="heading heading-5 strong-600">{{$data -> donor_name}}</h5>
                    <h6 class="text-muted mb-4">Donated On {{$data->created_at}}</h6>
                    <h6 class="mb-4">Amount: {{$data->amount}} INR</h6>
                    <p class="card-text">{{$data->description}}</p>
                    <a href="{{route('show',$data)}}" class="btn btn-sm btn-primary">View Details</a>

                </div>
            </div>
            <br>

        </div>
        @endforeach
    </div>
</section>
@endsection
