@extends('layouts.layouts')

@section('content')


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
      <li data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/1-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/1-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/1.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/1-1600.jpg"
      data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
        <a href="{{ asset('images/educhild.png')}}">
          <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/thumb-1.jpg">
          <div class="demo-gallery-poster">
            <img src="https://sachinchoolur.github.io/lightGallery/static/img/zoom.png">
          </div>
        </a>
      </li>
      <li data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/1-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/1-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/1.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/1-1600.jpg"
      data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
        <a href="{{ asset('images/educhild.png')}}">
          <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/thumb-1.jpg">
          <div class="demo-gallery-poster">
            <img src="https://sachinchoolur.github.io/lightGallery/static/img/zoom.png">
          </div>
        </a>
      </li>
      <li data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/1-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/1-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/1.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/1-1600.jpg"
      data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
        <a href="{{ asset('images/educhild.png')}}">
          <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/thumb-1.jpg">
          <div class="demo-gallery-poster">
            <img src="https://sachinchoolur.github.io/lightGallery/static/img/zoom.png">
          </div>
        </a>
      </li>
      <li data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/2-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/2-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/2.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/2-1600.jpg"
      data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
        <a href="">
          <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/thumb-2.jpg">
          <div class="demo-gallery-poster">
            <img src="https://sachinchoolur.github.io/lightGallery/static/img/zoom.png">
          </div>
        </a>
      </li>
      <li data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/13-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/13-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/13.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/13-1600.jpg"
      data-sub-html="<h4>Sunset Serenity</h4><p>A gorgeous Sunset tonight captured at Coniston Water....</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
        <a href="">
          <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/thumb-13.jpg">
          <div class="demo-gallery-poster">
            <img src="https://sachinchoolur.github.io/lightGallery/static/img/zoom.png">
          </div>
        </a>
      </li>
      <li data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/1-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/1-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/1.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/1-1600.jpg"
      data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
        <a href="{{ asset('images/educhild.png')}}">
          <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/thumb-1.jpg">
          <div class="demo-gallery-poster">
            <img src="https://sachinchoolur.github.io/lightGallery/static/img/zoom.png">
          </div>
        </a>
      </li>
      <li data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/1-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/1-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/1.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/1-1600.jpg"
      data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
        <a href="{{ asset('images/educhild.png')}}">
          <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/thumb-1.jpg">
          <div class="demo-gallery-poster">
            <img src="https://sachinchoolur.github.io/lightGallery/static/img/zoom.png">
          </div>
        </a>
      </li>
      <li data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/4-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/4-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/4.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/4-1600.jpg"
      data-sub-html="<h4>Coniston Calmness</h4><p>Beautiful morning</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
        <a href="">
          <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/thumb-4.jpg">
          <div class="demo-gallery-poster">
            <img src="https://sachinchoolur.github.io/lightGallery/static/img/zoom.png">
          </div>
        </a>
      </li>
    </ul>
  </div>
</div>





@endsection