@extends('layouts.layouts')

@section('content')


<section class="spotlight C-parallax bg-cover bg-size--cover" data-spotlight="fullscreen" style="background-image: url(https://cdn.pixabay.com/photo/2016/03/27/18/52/flower-1283602_1280.jpg)">
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
                                <span style="font-size: 3rem;">Gallery</span> <br />
                                "No one has ever become poor by giving." 
                                -Anne Frank
                            </h4>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section><br><br><br><br>



<div class="cont">

  <div class="demo-gallery">
    <ul id="lightgallery">
      @foreach($galleryimages as $image)
      <li data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/4-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/4-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/4.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/4-1600.jpg"
      data-sub-html="<h4>Coniston Calmness</h4><p>Beautiful morning</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
        <a href="storage/app/public/Galleryimages/{{$image['name']}}">
          <img class="img-responsive" src="storage/app/public/Galleryimages/{{$image['name']}}">
          <div class="demo-gallery-poster">
            <img src="https://sachinchoolur.github.io/lightGallery/static/img/zoom.png">
          </div>
        </a>
      </li>
      @endforeach
    </ul>
  </div>
</div>





@endsection