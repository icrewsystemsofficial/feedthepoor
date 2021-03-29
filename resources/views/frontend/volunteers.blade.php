@extends('layouts.frontend.app')

@section('meta')
<title>
    Volunteers | FeedThePoor - Donate money confidently and Transparently
</title>
@endsection

@section('css')
<style>

.team-member {
  margin: 15px 0;
  padding: 0;
}

.team-member figure {
  position: relative;
  overflow: hidden;
  padding: 0;
  margin: 0;
}

.team-member figure img {
  min-width: 100%;
 
}

.team-member figcaption p {
  font-size: 16px;
}

.team-member h4 {
  margin: 10px 0 0;
  padding: 0;
}

.team-member figcaption {
  padding: 50px;
  color: transparent;
  background-color: transparent;
  position: absolute;
  z-index: 996;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 0;
  overflow: hidden;
  visibility: hidden;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  }

.team-member figure:hover figcaption {
  visibility: visible;
  color: black;
  background:  #fff;
   height: 100%;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  opacity:0.9;
}

.team-member figure img {
  -webkit-transform: scale(1) rotate(0) translateY(0);
  -o-transform: scale(1) rotate(0) translateY(0);
  -ms-transform: scale(1) rotate(0) translateY(0);
  transform: scale(1) rotate(0) translateY(0);
  -webkit-transition: all 0.4s ease-in-out;
  -moz-transition: all 0.4s ease-in-out;
  -o-transition: all 0.4s ease-in-out;
  transition: all 0.4s ease-in-out;
}

.team-member figure:hover img {
  -webkit-transform: scale(1.1) rotate(1deg) translateY(12px);
  -moz-transform: scale(1.1) rotate(1deg) translateY(12px);
  -o-transform: scale(1.1) rotate(1deg) translateY(12px);
  -ms-transform: scale(1.1) rotate(1deg) translateY(12px);
  transform: scale(1.1) rotate(1deg) translateY(12px);
  -webkit-transition: all 0.4s ease-in-out;
  -moz-transition: all 0.4s ease-in-out;
  -o-transition: all 0.4s ease-in-out;
  transition: all 0.4s ease-in-out;
}

</style>
@endsection

@section('js')
<script>
    /* Your Custom Script Here*/
</script>
@endsection

@section('content')
<section class="slice slice-xl bg-secondary">
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-12">
        <p class="lead mt-3 lh-180 animated" data-animation-in="fadeInUp" data-animation-delay="2500">
        <span style="font-size: 2.2rem;">
          Be a hunger hero with
        <strong>#feedThePoor</strong>
        </span> <br>
          It's a feeling that can't be described. Has to be felt first hand.
        </p>
      </div>
    </div>
  </div>
</section>

<section class="slice-lg">
    <div class="container">
        <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space">
            <div class="col-lg-5">
                <div class="d-flex align-items-start">
                    <div class="">
                        <h1>
                            Join your hands to get end the Hunger in India.
                        </h1>
                        <p class="volunteer_para">
                                Join our volunteer team of friends, leaders, neighbours and working professionals across India who work towards building communities where hunger doesn't come in the way of a brighter future.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-2">
                <div class="block block-image">
                    <img style="height: auto; width: 90%;" src="https://cdn.discordapp.com/attachments/694578470772146237/744474193516822590/icrew_7.jpg" class="img-center img-fluid rounded z-depth-3" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<br><br>
<section class="slice-lg">
        <div class="section-prop max-w-xl lg:max-w-6xl mx-auto h-full flex flex-col mb-2 md:mb-6">
            <div class="max-w-xl lg:max-w-6xl mx-auto px-6">
                <h1 class="mt-10 font-dark text-drak tracking text-center">Volunteers</h1>
                    <p class="mt-2 text-black font-secondary-300 text-center opacity-50">
                        The minds that brought the dream into reality
                    </p>
                </h1>
            </div>
        </div>
    <div class="container">
        <div class="row">

            <div class="col-md">
                    <div class="team-member">
                        <figure>
                            <div class="shadow-sm p-3 mb-5 bg-white rounded">
                                <img src="https://ik.imagekit.io/wig4h1dj7ks/subham_aCxsyKsG9.jpg" class="img-center img-fluid rounded z-depth-3 w-100 h-25 " alt="">
                            
                            </div>   
                        <figcaption>
                                    <div>
                                        <h1 class="text-black text-3xl font-dark text-dark tracking">Sayantan Chatterjee</h1>
                                        <h4 class="text-black mt-2 text-lg font-dark text-dark tracking opacity-75">Events Cooridinator</h4>
                                    </div>
                                    <p class="text-black font-secondary">
                                    Sayantan Chatterjee is a high school student. He helps us in planning various events, 
                                    missions and also helps in hosting them.
                                    </p>
                                    <p class="text-black font-secondary">Contact Details:<br>
                                        <a class="text-black mt-2 text-lg font-dark text-dark tracking opacity-75" href="mailto:sayantan@plantfor.me"><strong>sayantan@plantfor.me</strong></a>
                                    </p>
                            </figcaption>
                        </figure>
                    </div>
            </div>
           
            <div class="col-md">
                    <div class="team-member">
                        <figure>
                            <div class="shadow-sm p-3 mb-5 bg-white rounded">
                                <img src="https://ik.imagekit.io/wig4h1dj7ks/subham_aCxsyKsG9.jpg" class="img-center img-fluid rounded z-depth-3 w-100 h-25" alt="">
                            
                            </div>   
                        <figcaption>
                                    <div>
                                        <h1 class="text-black text-3xl font-dark text-dark tracking">Sayantan Chatterjee</h1>
                                        <h4 class="text-black mt-2 text-lg font-dark text-dark tracking opacity-75">Events Cooridinator</h4>
                                    </div>
                                    <p class="text-black font-secondary">
                                    Sayantan Chatterjee is a high school student. He helps us in planning various events, 
                                    missions and also helps in hosting them.
                                    </p>
                                    <p class="text-black font-secondary">Contact Details:<br>
                                        <a class="text-black mt-2 text-lg font-dark text-dark tracking opacity-75" href="mailto:sayantan@plantfor.me"><strong>sayantan@plantfor.me</strong></a>
                                    </p>
                            </figcaption>
                        </figure>
                    </div>
            </div>
            <div class="col-md">
                    <div class="team-member">
                        <figure>
                            <div class="shadow-sm p-3 mb-5 bg-white rounded">
                                <img src="https://ik.imagekit.io/wig4h1dj7ks/subham_aCxsyKsG9.jpg" class="img-center img-fluid rounded z-depth-3 w-100 h-25" alt="">
                            
                            </div>   
                        <figcaption>
                                    <div>
                                        <h1 class="text-black text-3xl font-dark text-dark tracking">Sayantan Chatterjee</h1>
                                        <h4 class="text-black mt-2 text-lg font-dark text-dark tracking opacity-75">Events Cooridinator</h4>
                                    </div>
                                    <p class="text-black font-secondary">
                                    Sayantan Chatterjee is a high school student. He helps us in planning various events, 
                                    missions and also helps in hosting them.
                                    </p>
                                    <p class="text-black font-secondary">Contact Details:<br>
                                        <a class="text-black mt-2 text-lg font-dark text-dark tracking opacity-75" href="mailto:sayantan@plantfor.me"><strong>sayantan@plantfor.me</strong></a>
                                    </p>
                            </figcaption>
                        </figure>
                    </div>
            </div>
        </div>
  </div>
</section>

@endsection
