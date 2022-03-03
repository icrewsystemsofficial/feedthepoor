@extends('layouts.frontend')
@section('meta')
<title>
   {{ config('app.name') }} | Donate Transparently
</title>
@endsection
@section('css')
<style>
   .hero-section{
   height: calc(100vh - 5rem);
   width: 100vw;
   }
</style>
@endsection
@section('js')
<script>
   var notify = {
    timeout: "5000",
    animatedIn: "bounceInRight",
    animatedOut: "bounceOutRight",
    position: "bottom-right"
   }

   var stepper = document.getElementById("stepper");

   function toggleVisibility(element) {
   var x = document.getElementById(element);
   if (x.style.display === "none") {
   x.style.display = "block";
   } else {
   x.style.display = "none";
   }
   }


   setInterval(function() {
   if(stepper.classList.contains('step1')) {
       stepper.classList.remove('step1');
        stepper.classList.add('step2');

        toggleVisibility('step1-p');
        toggleVisibility('step2-p');
   } else if(stepper.classList.contains('step2')) {
        stepper.classList.remove('step2');
        stepper.classList.add('step3');
        toggleVisibility('step2-p');
        toggleVisibility('step3-p');
   } else if(stepper.classList.contains('step3')) {
        stepper.classList.remove('step3');
        stepper.classList.add('step1');
        toggleVisibility('step3-p');
        toggleVisibility('step1-p');
   }
   }, 5000);



    // Hero Section Dynamic changes.

    var donation_images = {!! $donation_images !!};
    var donation_names = {!! $donation_names !!};
    var total_meals_fed = {{ $total_meals_fed }};
    var total_donations_received = {{ $total_donations_received }};

    // Counter for total meals.
    var total_people_fed_today = document.getElementById('total-people-fed-today');
    total_people_fed_today.innerText = total_meals_fed;


    var image_count = 0;
    var next_image = null;

    setInterval(function() {
    var hidden_container = document.getElementById('hidden-image-for-preload');
    var container = document.getElementById('hero-section-image-container');
    if(next_image == null) {
        current_image = donation_images[image_count];
        next_image_count = image_count + 1;
        next_image = donation_images[next_image_count]
    } else {
        current_image = hidden_container.src;
        next_image_count = image_count + 1;
        next_image = donation_images[next_image_count]
        // console.log(hidden_container.src);
    }
    container.style.backgroundImage = "url('" + current_image + "')";

    hidden_container.src = next_image;
    // This allows the next image to preload, allowing the transition to be
    // smooth.
    // Comment the previous line and see the delay.

    //Leonard, 16 April 2021.

    // console.log('Changning image in hero section to array # ' + image_count);
    if (image_count == donation_images.length) {
        image_count = 0;
    } else {
        image_count++;
    }


    //To change donor name.
    var donor = document.getElementById('hero-donor-name');
    donor.innerText = donation_names[image_count];

    // To change meal count.
    var meal = document.getElementById('hero-donor-meal-count');
    meal.innerText = Math.floor(Math.random() * 100);

    }, 4000)
</script>
@endsection


@section('content')

<style>
    .hero-header {
        min-height: 50vh;
        background: #000 url(https://i.imgur.com/5KfRXY1.png) center center no-repeat;
        background-size: cover;
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        box-shadow: 0 0 200px rgba(0,0,0,0.9) inset;
    }

    .underline {
        text-decoration: underline;
        font-weight: bold;
        color: var(--theme-color) !important;
    }

</style>

<section class="section section-header text-white pb-md-10 hero-header">
   <div class="container">
      <div class="row justify-content-between align-items-center">

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card alpha-container text-white border-0 overflow-hidden mt-2 hover-shadow-theme">
              <a href="#" target="_blank">
                <div id="hero-section-image-container" class="card-img-bg" style="background-image: url('https://images.milaap.org/milaap/image/upload/v1590737431/production/images/uploader_images/IMG-20200426-WA0015_1590737429.jpg?format=jpg&mode=max&width=1170');">
                </div>

                {{-- The soul purpose of this container is to preload the images. Don't remove it.--}}
                <img id="hidden-image-for-preload" src="null" style="display: none;" />

                <span class="mask bg-dark alpha-1 alpha-9--hover"></span>

                <div class="card-body px-5 py-5">
                  <div style="min-height: 100px;">
                        <div class="mt-5 mb-1 lh-180">
                            <div style="padding-top: 50px;">

                                <span class="fst-italic">
                                    #DailyFeedingCampaign
                                </span>

                                <br><br>

                                <span class="fw-bolder text-theme">Leonard</span> from
                                <span class="fw-bolder text-theme">Chennai</span>
                                donated
                                <span class="fw-bold">
                                    42 meals
                                </span>
                            </div>
                        </div>

                        <div class="mt-3">
                            <span class="">
                                {{ now()->subDay(2)->format('d F, Y')}}
                            </span>
                        </div>
                    </div>
                </div>
              </a>
            </div>
          </div>


         <div class="col-lg-8 col-md-6 p-5 col-sm-12">
            <h1 class="display-4 mb-4">
                We fed <span class="underline">859</span> hungry souls on <span class="underline">{{ now()->format('d F, Y') }}</span>
            </h1>
            <p class="mb-1">
                <span class="text-theme fw-bold">₹19,823</span> was donated by <span class="text-theme fw-bold">592</span> donors on <span class="fw-bold text-theme">{{ now()->subDay(1)->format('d F, Y') }}</span>.

                <br>
                We have donated <span class="text-theme fw-bold">1,23,973,682 meals</span> since inception.
            </p>

            <br>
            <small class="text-light-gray">* This data was automatically updated at 00:00 {{ now()->subDay(1)->format('d F, Y') }}.</small>

            <div class="d-flex flex-wrap mt-4 mt-lg-5">
                <a href="#" class="btn btn-white mb-xl-0 me-3 btn-hover">
                    Transparency Report
                </a>
                {{-- <a href="#" class="btn btn-white"><span class="icon icon-brand me-2"><span class="fab fa-google-play"></span></span> <span class="d-inline-block text-left"><small class="fw-normal d-block">Available on</small> Google Play</span></a></div> --}}
         </div>

        </div>
         {{-- <div class="col-12 col-md-6 text-center"><img class="d-none d-md-inline-block" src="../../assets/img/illustrations/app-landing.svg" alt="Mobile App Mockup"></div> --}}
      </div>
   </div>
</section>

<section class="section bg-secondary text-white">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="display-4">
                    We are <span class="text-theme">Roshni Moolchandani Charitable Trust</span>.

                    <br>
                    <span class="display-6">
                        We're on a mission to make <span class="fst-italic">India hunger-free</span>. Currently present in <span class="text-theme">8* locations</span> across the country.
                    </span>
                </h2>

                <p class="lead mt-5">


                    We're a <span class="fw-bold">GuideStar India certified 100% transparent organization***</span>.

                    <br>

                    <span class="display-6">
                    We firmly believe transparency is not just about <span class="text-theme">numbers</span>.
                    Track your donations <span class="fw-bolder text-theme">every step of the way!</span>
                    </span>
                </p>

                <div class="mt-3">
                    <a href="#" class="btn btn-outline-white">
                        How does it work?
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-header bg-white ">
   <div class="container">
      <div class="row justify-content-between align-items-center">
         <div class="col-12 col-md-7 col-lg-6 text-center text-md-left">
            <p>
                WORK IN PROGRESS
            </p>
         </div>

      </div>
   </div>
</section>
@endsection

@section('content')
    <section class="slice slice-md">
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <div class="text-left pt-lg-md">
                <h2 class="heading h1 mb-2">
                  We fed
                    <strong>
                        <u><span id="total-people-fed-today">0</span></u>
                    </strong> people on
                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ strtolower(date('d-m-Y', strtotime('yesterday'))) }}">
                        {{ strtolower(date('l', strtotime('yesterday'))) }}.
                    </span>
                </h2>
                <p class="lead lh-180">
                  with absolute transparency, donate more confidently. <strong>#feedThePoor</strong>
                  <br><br>
                  <button onclick="window.location='#how'" class="btn btn-sm btn-primary btn-outline-danger">
                    How?
                  </button>
                </p>
              </div>
            </div>

            <div class="col-lg-4">
                <br>
                <div class="card bg-dark alpha-container text-white border-0 overflow-hidden">
                  <a href="#" target="_blank">
                    <div id="hero-section-image-container" class="card-img-bg" style="background-image: url('https://cdn.discordapp.com/attachments/694578470772146237/744472703897174036/icrew_feeding_the_poor_5.jpg');"></div>
                    {{-- The soul purpose of this container is to preload the images. Don't remove it.--}}
                    <img id="hidden-image-for-preload" src="null" style="display: none;" />
                    <span class="mask bg-dark alpha-5 alpha-9--hover"></span>
                    <div class="card-body px-5 py-5">
                      <div style="min-height: 100px;">
                        {{-- <h3 class="heading h1 text-white mb-3">Mr. Dhruv Bhatt</h3> --}}
                        <p class="mt-4 mb-1 h5 text-white lh-180">
                          <br><br>
                            <strong>
                                <span id="hero-donor-name">
                                    Leonard
                                </span>
                            </strong> donated <span id="hero-donor-meal-count">40</span> meals.
                          <br>
                          <small><span class="text-white font-weight-100">Jodhpur campaign</span></small>
                        </p>
                      </div>
                      <span href="#" class="text-white font-weight-500">
                        #feedThePoor
                      </span>
                    </div>
                  </a>
                </div>
              </div>
          </div>
        </div>
    </section>


    <div>
        {{-- <svg height="100%" width="100%" id="svg" viewBox="0 0 1440 500" xmlns="http://www.w3.org/2000/svg" class="transition duration-300 ease-in-out delay-150"><defs><linearGradient id="gradient"><stop offset="5%" stop-color="#ff690066"></stop><stop offset="95%" stop-color="#eb144c66"></stop></linearGradient></defs><path d="M 0,500 C 0,500 0,125 0,125 C 71.17179487179487,123.04358974358973 142.34358974358975,121.08717948717948 220,122 C 297.65641025641025,122.91282051282052 381.7974358974359,126.6948717948718 467,136 C 552.2025641025641,145.3051282051282 638.4666666666667,160.13333333333333 723,159 C 807.5333333333333,157.86666666666667 890.3358974358976,140.7717948717949 973,130 C 1055.6641025641024,119.22820512820512 1138.1897435897436,114.77948717948719 1216,115 C 1293.8102564102564,115.22051282051281 1366.9051282051282,120.1102564102564 1440,125 C 1440,125 1440,500 1440,500 Z" stroke="none" stroke-width="0" fill="url(#gradient)" class="transition-all duration-300 ease-in-out delay-150"></path><defs><linearGradient id="gradient"><stop offset="5%" stop-color="#ff690088"></stop><stop offset="95%" stop-color="#eb144c88"></stop></linearGradient></defs><path d="M 0,500 C 0,500 0,250 0,250 C 69.8025641025641,224.74871794871797 139.6051282051282,199.4974358974359 228,210 C 316.3948717948718,220.5025641025641 423.3820512820513,266.75897435897434 502,262 C 580.6179487179487,257.24102564102566 630.8666666666667,201.4666666666667 708,203 C 785.1333333333333,204.5333333333333 889.1512820512821,263.374358974359 972,269 C 1054.8487179487179,274.625641025641 1116.5282051282052,227.03589743589743 1191,215 C 1265.4717948717948,202.96410256410257 1352.7358974358974,226.4820512820513 1440,250 C 1440,250 1440,500 1440,500 Z" stroke="none" stroke-width="0" fill="url(#gradient)" class="transition-all duration-300 ease-in-out delay-150"></path><defs><linearGradient id="gradient"><stop offset="5%" stop-color="#ff6900ff"></stop><stop offset="95%" stop-color="#eb144cff"></stop></linearGradient></defs><path d="M 0,500 C 0,500 0,375 0,375 C 80.08461538461538,373.7794871794872 160.16923076923075,372.55897435897435 241,364 C 321.83076923076925,355.44102564102565 403.4076923076924,339.54358974358973 474,343 C 544.5923076923076,346.45641025641027 604.1999999999999,369.2666666666667 688,375 C 771.8000000000001,380.7333333333333 879.7923076923078,369.3897435897436 972,360 C 1064.2076923076922,350.6102564102564 1140.6307692307691,343.17435897435894 1216,346 C 1291.3692307692309,348.82564102564106 1365.6846153846154,361.91282051282053 1440,375 C 1440,375 1440,500 1440,500 Z" stroke="none" stroke-width="0" fill="url(#gradient)" class="transition-all duration-300 ease-in-out delay-150"></path></svg> --}}
        <svg height="100%" width="100%" id="svg" viewBox="0 0 1440 400" xmlns="http://www.w3.org/2000/svg" class="transition duration-300 ease-in-out delay-150"><defs><linearGradient id="gradient"><stop offset="5%" stop-color="#ff690066"></stop><stop offset="95%" stop-color="#eb144c66"></stop></linearGradient></defs><path d="M 0,400 C 0,400 0,100 0,100 C 68.42820512820512,85.71282051282051 136.85641025641024,71.42564102564104 221,81 C 305.14358974358976,90.57435897435896 405.00256410256407,124.0102564102564 481,133 C 556.9974358974359,141.9897435897436 609.1333333333334,126.53333333333333 687,115 C 764.8666666666666,103.46666666666667 868.4641025641026,95.85641025641026 963,101 C 1057.5358974358974,106.14358974358974 1143.0102564102565,124.04102564102564 1221,126 C 1298.9897435897435,127.95897435897436 1369.4948717948719,113.97948717948718 1440,100 C 1440,100 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" class="transition-all duration-300 ease-in-out delay-150"></path><defs><linearGradient id="gradient"><stop offset="5%" stop-color="#ff690088"></stop><stop offset="95%" stop-color="#eb144c88"></stop></linearGradient></defs><path d="M 0,400 C 0,400 0,200 0,200 C 88.67179487179487,201.8025641025641 177.34358974358975,203.6051282051282 247,195 C 316.65641025641025,186.3948717948718 367.2974358974359,167.38205128205126 443,162 C 518.7025641025641,156.61794871794874 619.4666666666667,164.86666666666667 704,173 C 788.5333333333333,181.13333333333333 856.8358974358976,189.15128205128204 949,203 C 1041.1641025641024,216.84871794871796 1157.1897435897436,236.52820512820514 1243,237 C 1328.8102564102564,237.47179487179486 1384.4051282051282,218.7358974358974 1440,200 C 1440,200 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" class="transition-all duration-300 ease-in-out delay-150"></path><defs><linearGradient id="gradient"><stop offset="5%" stop-color="#ff6900ff"></stop><stop offset="95%" stop-color="#eb144cff"></stop></linearGradient></defs><path d="M 0,400 C 0,400 0,300 0,300 C 71.36923076923077,316.4153846153846 142.73846153846154,332.83076923076925 216,332 C 289.26153846153846,331.16923076923075 364.4153846153846,313.0923076923077 458,305 C 551.5846153846154,296.9076923076923 663.6,298.8 756,293 C 848.4,287.2 921.1846153846154,273.70769230769235 983,272 C 1044.8153846153846,270.29230769230765 1095.6615384615384,280.36923076923074 1170,287 C 1244.3384615384616,293.63076923076926 1342.1692307692308,296.81538461538463 1440,300 C 1440,300 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" class="transition-all duration-300 ease-in-out delay-150"></path></svg>
        {{-- <svg height="100%" width="100%" id="svg" viewBox="0 0 1440 400" xmlns="http://www.w3.org/2000/svg" class="transition duration-300 ease-in-out delay-150"><defs><linearGradient id="gradient"><stop offset="5%" stop-color="#002bdc66"></stop><stop offset="95%" stop-color="#32ded466"></stop></linearGradient></defs><path d="M 0,400 C 0,400 0,100 0,100 C 105.01435406698562,117.74162679425837 210.02870813397124,135.48325358851673 307,130 C 403.97129186602876,124.51674641148325 492.8995215311005,95.80861244019137 596,92 C 699.1004784688995,88.19138755980863 816.3732057416267,109.28229665071773 912,114 C 1007.6267942583733,118.71770334928227 1081.6076555023924,107.0622009569378 1166,102 C 1250.3923444976076,96.9377990430622 1345.1961722488038,98.4688995215311 1440,100 C 1440,100 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" class="transition-all duration-300 ease-in-out delay-150"></path><defs><linearGradient id="gradient"><stop offset="5%" stop-color="#002bdc88"></stop><stop offset="95%" stop-color="#32ded488"></stop></linearGradient></defs><path d="M 0,400 C 0,400 0,200 0,200 C 107.00478468899522,204.68899521531102 214.00956937799043,209.37799043062202 298,204 C 381.99043062200957,198.62200956937798 442.96650717703346,183.17703349282297 533,185 C 623.0334928229665,186.82296650717703 742.1244019138757,205.91387559808612 853,209 C 963.8755980861243,212.08612440191388 1066.5358851674641,199.16746411483254 1163,195 C 1259.4641148325359,190.83253588516746 1349.732057416268,195.41626794258372 1440,200 C 1440,200 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" class="transition-all duration-300 ease-in-out delay-150"></path><defs><linearGradient id="gradient"><stop offset="5%" stop-color="#002bdcff"></stop><stop offset="95%" stop-color="#32ded4ff"></stop></linearGradient></defs><path d="M 0,400 C 0,400 0,300 0,300 C 121.3397129186603,313.88516746411483 242.6794258373206,327.77033492822966 322,319 C 401.3205741626794,310.22966507177034 438.62200956937795,278.80382775119614 525,281 C 611.377990430622,283.19617224880386 746.8325358851677,319.0143540669857 848,319 C 949.1674641148323,318.9856459330143 1016.0478468899521,283.1387559808612 1109,274 C 1201.952153110048,264.8612440191388 1320.976076555024,282.4306220095694 1440,300 C 1440,300 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" class="transition-all duration-300 ease-in-out delay-150"></path></svg> --}}
    </div>
   {{-- <section class="spotlight C-parallax bg-cover bg-size--cover" data-spotlight="fullscreen">
      <span class="mask bg-tertiary alpha-5"></span>
      <div class="spotlight-holder py-lg pt-lg-xl" style="height: 722px;">
         <div class="container d-flex align-items-center no-padding">
            <div class="col">
               <div class="row cols-xs-space align-items-center text-center text-md-left justify-content-start">
                  <div class="col-7">
                     <div class="text-left mt-5">
                        <!-- <h2 class="heading display-4 font-weight-400 text-white mt-5 animated" data-animation-in="fadeInUp" data-animation-delay="2000">
                           <span class="font-weight-700">812</span> hungry mouths fed today
                           </h2> -->
                        <p class="lead text-white mt-3 lh-180 c-white animated" data-animation-in="fadeInUp" data-animation-delay="2500">
                           <span style="font-size: 2.2rem;"><strong>#FeedThePoor</strong> Initiative</span> <br>
                           "Feeding the hungry is greater work than raising the dead"
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section> --}}
  <section class="slice-lg">
    <div class="container">
        <div class="row row-grid justify-content-around align-items-center">
          <div class="col-md-10">
             <h1 class="heading h2">How does it <span class="font-weight-700 text-underline font-italic">work</span>?</h1>
             <p>
                Getting "proof" for donations have always been a herculean task. We've managed to simplify it using <strong>technology</strong>
             </p>
          </div>
          <div class="col-md-10">
             <div class="d-flex">
                <div class="stepper-div">
                   <div class="step3" id="stepper">
                      <ul class="stepper">
                         <li><span>Donate</span></li>
                         <li><span>Food</span></li>
                         <li><span>Proof</span></li>
                      </ul>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-md-10">
             <div class="card z-depth-3">
                <div class="card-body">
                   <div id="step1-p" class="animate__animated animate__fadeIn" style="display: none;">
                      <h3 class="h3">You make your donation</h3>
                      You donate to our NGO partner via Razorpay payment gateway. The payment is automatically verified and accepted by our website. We immediately place the order for the food to donate the next day. You will recieve a recipt within the next 5 - 10 minutes.
                   </div>
                   <div id="step2-p" class="animate__animated animate__fadeIn" style="display: none;">
                    <h3 class="h3">We distribute the food </h3>
                      With the help of our Voulenteers, we distribute the food which was arranged by your donation to the underprivileged people in certain locations.
                   </div>
                   <div id="step3-p" class="animate__animated animate__fadeIn" style="display: block;">
                    <h3 class="h3">You get happy pictures</h3>
                      While we distribute the food, we take a quick moment to click a picture of your donation, along with your name with the person who is receiving it and mail it to you. We post the same
                      on our NGO partner's instagram account. If you have provided instagram handle, we'll tag you.
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>

 {{-- Reason behind feedthepoor section --}}


 <section class="slice slice-lg">
    <div class="container">
        <div class="row row-grid justify-content-around align-items-center">
        <div class="card hover-shadow-lg hover-scale-110 order-2 col-lg-6">
          <div class="card-body p-5">
            <h6 class="text-muted">
                What's the reason behind <strong>#feedThePoor</strong>?
            </h6>
            <p class="h4 lh-150">
                India is home to the largest <span class="font-italic font-weight-700">undernourished</span> population in the world 😔
                <ul>
                    <li><strong>194.4 million people</strong> i.e. 14.5% of our population is undernourished</li>
                    <li><strong>20.8%</strong> of children under 5 are underweight</li>
                    <li><strong>37.9%</strong> of children under 5 years of age are stunted</li>
                    <li><strong>51.4%</strong> women in the reproductive age (15-49 years) are anaemic</li>
                </ul>

                <small>source <a href="https://www.indiafoodbanking.org/hunger?ref={{ config('app.url') }}"
                        target="_blank">indiafoodbanking.org</a></small>

                <br /><br /><br />
                There are always people who strive to help. There are people who deep down "want" to help, but they're
                haunted by one burning question inside their minds
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>


 <section class="slice slice-lg">
    <div class="container">
        <div class="row align-items-center px-5">
            <div class="col-lg-6">
                <div class="d-flex align-items-center">
                  <h3 class="heading h3 text-center">

                  </h3>
                </div>

                <p>
                </p>
            </div>


            <div class="col-lg-6">
                <div class="d-flex">
                    <div class="icon-text">
                       <h2 class="heading h2 text-muted">"I want to help..., but who knows my money is
                          actually being used to feed the poor?"
                       </h2>
                       <p>
                       </p>
                       <h1>- This is what we are solving</h1>
                       The first thing that haunts the mind of every good soul that wants to help, is the doubt, the grey area, and lack of <strong>"Transparency"</strong>
                       <br><br>
                       <h4>Seeing is beliving.</h4>
                       #feedThePoor initiative is all about transparency. With the help of our NGO partners, we are able to show our donors who they've fed, and how every penny of their donation is putting a smile across
                       thousands of faces. <strong><i>Transparency.</i></strong>
                       <p></p>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</section>


 {{-- Testimonials Section --}}
 <section class="slice slice-lg">
    <div class="container">
      <div class="mb-5 text-center">
        <h3 class=" mt-4">It's standard practice to boost promotions via advertisements</h3>
        <div class="fluid-paragraph mt-3">
          <p class="h4">
              though, what better advertisement than the <span class="text-underline font-weight-700 font-italic">truth</span>?
          </p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-11">
          <div class="swiper-js-container row align-items-center">
            <div class="col-xl-4 d-none d-xl-block">
              <div class="pr-4">
                <p class="lead mt-3">
                    Testimonials left by our donors. They love <span class="font-weight-700">#feedThePoor</span> for a reason.
                </p>
              </div>
            </div>
            <div class="col-xl-8">
              <div class="swiper-container swiper-container-initialized swiper-container-horizontal" data-swiper-items="1" data-swiper-space-between="0" data-swiper-sm-items="2" style="cursor: grab;">
                <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                  <div class="swiper-slide p-4 swiper-slide-active" style="width: 333.5px;">
                    <!-- Testimonial entry 1 -->
                    <div class="card bg-dark">
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <div>
                            <img alt="Image placeholder" src="https://picsum.photos/200/201" class="avatar  rounded-circle">
                          </div>
                          <div class="pl-3">
                            <h5 class="h6 mb-0 text-white">Heather Wright</h5>
                            <small class="d-block text-muted">Google</small>
                          </div>
                        </div>
                        <p class="mt-4 lh-180">Amazing template! All-in-one, clean code, beautiful design, and really not hard to work with.Highly recommended for any kind on website.</p>
                        <span class="static-rating static-rating-sm">
                          <i class="star fas fa-star voted"></i>
                          <i class="star fas fa-star voted"></i>
                          <i class="star fas fa-star voted"></i>
                          <i class="star fas fa-star voted"></i>
                          <i class="star fas fa-star voted"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide p-4 swiper-slide-next" style="width: 333.5px;">
                    <!-- Testimonial entry 2 -->
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <div>
                            <img alt="Image placeholder" src="https://picsum.photos/200/202" class="avatar  rounded-circle">
                          </div>
                          <div class="pl-3">
                            <h5 class="h6 mb-0">Monroe Parker</h5>
                            <small class="d-block text-muted">Apple</small>
                          </div>
                        </div>
                        <p class="mt-4 lh-180">Amazing template! All-in-one, clean code, beautiful design, and really not hard to work with.Highly recommended for any kind on website.</p>
                        <span class="static-rating static-rating-sm">
                          <i class="star fas fa-star voted"></i>
                          <i class="star fas fa-star voted"></i>
                          <i class="star fas fa-star voted"></i>
                          <i class="star fas fa-star voted"></i>
                          <i class="star fas fa-star voted"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide p-4" style="width: 333.5px;">
                    <!-- Testimonial entry 3 -->
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <div>
                            <img alt="Image placeholder" src="https://picsum.photos/200/203" class="avatar  rounded-circle">
                          </div>
                          <div class="pl-3">
                            <h5 class="h6 mb-0">John Sullivan</h5>
                            <small class="d-block text-muted">Amazon</small>
                          </div>
                        </div>
                        <p class="mt-4 lh-180">Amazing template! All-in-one, clean code, beautiful design, and really not hard to work with.Highly recommended for any kind on website.</p>
                        <span class="static-rating static-rating-sm">
                          <i class="star fas fa-star voted"></i>
                          <i class="star fas fa-star voted"></i>
                          <i class="star fas fa-star voted"></i>
                          <i class="star fas fa-star voted"></i>
                          <i class="star fas fa-star voted"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
              <!-- Add Pagination -->
              <div class="swiper-pagination w-100 pt-4 d-flex align-items-center justify-content-center swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    <section class="slice slice-lg">
        <div class="container">
        <div class="row row-grid justify-content-around align-items-center">
            <div class="col-lg-5">
            <div class="">
                <h5 class=" h3">
                    Just another donation website? No.
                </h5>
                <p class="my-4">
                    #feedThePoor is backed by ICREWSYSTEMS SOFTWARE ENGINEERING LLP. The MVP of this website,
                    is to make donation as much as transparent it can be.
                </p>
                <a href="#" class="link link-underline- font-weight-bold">Find out more</a>
            </div>
            </div>
            <div class="col-lg-6">
            <img alt="Image placeholder" src="assets/img/theme/light/presentation-2.png" class="img-fluid img-center">
            </div>
        </div>
        </div>
    </section>
  {{-- <section class="slice slice-lg">
    <div class="container">
      <div class="mb-5 text-center">
        <span class="badge badge-soft-success badge-pill badge-lg">
          Our process
        </span>
        <h3 class=" mt-4">Customize with confidence</h3>
        <div class="fluid-paragraph mt-3">
          <p class="lead lh-180">Customization has never been easier. Purpose has all the right tools in order to make your website building process a breeze.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="card hover-translate-y-n10 hover-shadow-lg p-2">
            <div class="card-body">
              <div class="">
                <div class="pb-5">
                  <div class="icon bg-primary text-white rounded-circle icon-lg icon-shape shadow">
                    <i class="fas fa-file-archive"></i>
                  </div>
                </div>
                <h5 class="font-weight-bold">Download Purpose</h5>
                <p class="mt-2 mb-0">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card hover-translate-y-n10 hover-shadow-lg p-2">
            <div class="card-body">
              <div class="">
                <div class="pb-5">
                  <div class="icon bg-primary text-white rounded-circle icon-lg icon-shape shadow">
                    <i class="fas fa-palette"></i>
                  </div>
                </div>
                <h5 class="font-weight-bold">Change its colors</h5>
                <p class="mt-2 mb-0">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card hover-translate-y-n10 hover-shadow-lg p-2">
            <div class="card-body">
              <div class="">
                <div class="pb-5">
                  <div class="icon bg-primary text-white rounded-circle icon-lg icon-shape shadow">
                    <i class="fas fa-tools"></i>
                  </div>
                </div>
                <h5 class="font-weight-bold">Create your website</h5>
                <p class="mt-2 mb-0">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> --}}



<section class="bg-gradient-lighter slice-lg">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">

            </div>
            <div class="col-lg-6">
               <div class="block block-image">
                  <img style="height: auto; width: 100%;" src="https://feedthepoor.online/en/public/images/donate_trandparently.png" class="img-center img-fluid rounded z-depth-3" alt="">
               </div>
            </div>
         </div>
      </div>
   </section>
   <section>
      <div class="container d-flex align-items-center no-padding">
         <div class="col">
            <div class="row">
               <div class="col-lg-12 py-5 pr-5">
                  <div style="z-depth-3" class="rounded p-2">
                     <div id="carouselExampleIndicators" class="carousel slide rounded" data-ride="carousel">
                        <ol class="carousel-indicators">
                           <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="3" class=""></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="4" class=""></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="5" class=""></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="6" class=""></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
                        </ol>
                        <div class="carousel-inner">
                           <div class="carousel-item">
                              <img style="height: auto; width: 100%;" src="https://b.zmtcdn.com/feeding-india/a0216293d82df205e7d6e19a56d1a1661585293269.png" class="img-center img-fluid" alt="">
                           </div>
                           <div class="carousel-item">
                              <img style="height: auto; width: 100%;" src="https://cdn.discordapp.com/attachments/694578470772146237/744470487404380170/icrew_feed_the_poor_2.jpg" class="img-center img-fluid" alt="">
                           </div>
                           <div class="carousel-item active">
                              <img style="height: auto; width: 100%;" src="https://cdn.discordapp.com/attachments/694578470772146237/744471075697721454/icrew_feeding_india_3.jpg" class="img-center img-fluid" alt="">
                           </div>
                           <div class="carousel-item">
                              <img style="height: auto; width: 100%;" src="https://cdn.discordapp.com/attachments/694578470772146237/744472013044973589/icrew_feeding_india_4.jpg" class="img-center img-fluid" alt="">
                           </div>
                           <div class="carousel-item">
                              <img style="height: auto; width: 100%;" src="https://cdn.discordapp.com/attachments/694578470772146237/744472703897174036/icrew_feeding_the_poor_5.jpg" class="img-center img-fluid" alt="">
                           </div>
                           <div class="carousel-item">
                              <img style="height: auto; width: 100%;" src="https://cdn.discordapp.com/attachments/694578470772146237/744473611909201990/icrew_6.jpg" class="img-center img-fluid" alt="">
                           </div>
                           <div class="carousel-item">
                              <img style="height: auto; width: 100%;" src="https://cdn.discordapp.com/attachments/694578470772146237/744474193516822590/icrew_7.jpg" class="img-center img-fluid" alt="">
                           </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-md-12 py-5">
                  <p class="lead text-dark">
                  </p>
                  <h1>Do you see that smile? <br>
                     <small>Thanks to our donors, partners &amp; volenteers we've rescued <strong>1,82,109
                     people</strong> so far
                     from <strong><i>hunger</i></strong> and put a <i><strong>smile</strong></i> on their
                     face</small>
                  </h1>
                  * All numbers mentioned here are for representation purposes
                  <p></p>
               </div>
               <div class="col-lg-12 py-5">
                  <ul class="C-donate-nav nav nav-pills nav-fill flex-column flex-sm-row" id="myTab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link mb-sm-3 active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">
                           <img src="https://www.pngrepo.com/png/31041/180/rupee.png" style="width: 50px; height: auto;">
                           <br><br>
                           <h3>Donate Money</h3>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link mb-sm-3 " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                           <img src="https://www.iconbunny.com/icons/media/catalog/product/1/9/1956.9-fruits-vegetables-icon-iconbunny.jpg" style="width: 50px; height: auto;">
                           <br><br>
                           <h3>Donate Food</h3>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link mb-sm-3" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                           <img src="https://image.flaticon.com/icons/svg/1305/1305723.svg" style="width: 50px; height: auto;">
                           <br><br>
                           <h3>Volunteer</h3>
                        </a>
                     </li>
                  </ul>
                  <div class="C-tab-cont mt-5 tab-content" id="myTabContent">
                     <div class="C-tab-item tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p>
                           It Only costs INR 60 to feed an underprivileged a day. It's easier than you think.
                           The very decision you make now, will defenitely rescue someone from hunger. You will
                           instantly
                           receive a recipt of donation, and a picture of the whom you're helping to feed will be
                           published within 48 hours.
                           <br>
                           All donations are tax-exempted as eligible under section 80G of the the Income Tax Act,
                           1961. (Yet to register)
                        </p>
                        <center>
                           <a href="http://feedthepoor.online/en/money" class="btn btn-md bg-success text-white btn-animated btn-animated-y">
                              <span class="btn-inner--visible">Donate Money</span>
                              <span class="btn-inner--hidden">
                                 <svg class="svg-inline--fa fa-arrow-right fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="arrow-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path>
                                 </svg>
                                 <!-- <i class="fas fa-arrow-right"></i> -->
                              </span>
                           </a>
                        </center>
                        <p></p>
                     </div>
                     <div class="C-tab-item tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p>
                           It Only costs INR 60 to feed an underpriviledged a day. It's easier than you think.
                           The very decision you make now, will defenitely rescue someone from hunger.
                        </p>
                        <center>
                           <a href="http://feedthepoor.online/en/coming-soon" class="btn btn-md bg-secondary text-white btn-animated btn-animated-y">
                              <span class="btn-inner--visible">Donate Money</span>
                              <span class="btn-inner--hidden">
                                 <svg class="svg-inline--fa fa-arrow-right fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="arrow-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path>
                                 </svg>
                                 <!-- <i class="fas fa-arrow-right"></i> -->
                              </span>
                           </a>
                        </center>
                        <p></p>
                     </div>
                     <div class="C-tab-item tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <p>
                           It Only costs INR 60 to feed an underpriviledged a day. It's easier than you think.
                           The very decision you make now, will defenitely rescue someone from hunger.
                        </p>
                        <center>
                           <a href="http://feedthepoor.online/en/voulenteer" class="btn btn-md bg-success text-white btn-animated btn-animated-y">
                              <span class="btn-inner--visible">Sign Up</span>
                              <span class="btn-inner--hidden">
                                 <svg class="svg-inline--fa fa-arrow-right fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="arrow-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path>
                                 </svg>
                                 <!-- <i class="fas fa-arrow-right"></i> -->
                              </span>
                           </a>
                        </center>
                        <p></p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-lg-8 col-md-12 pr-5">
                     <img style="height: auto; width: 100%;" src="https://feedthepoor.online/en/public/images/sponsor_a_meal.png" class="img-center img-fluid rounded z-depth-3" alt="">
                  </div>
                  <div class="col-lg-4 col-md-12">
                    <div class="card bg-primary text-white">
                       <div class="card-body">
                          <h4 class="heading h2 text-white pt-3 pb-5">
                            <strong>Step 1</strong>
                            <br>
                            <small>
                                Choose the amount
                            </small>
                          </h4>
                          <form class="form-primary">
                             <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-12">


                                        <div id="money-buttons-group">
                                            <center class="mb-2">
                                                <button type="button" onclick="updateMoney(100);" class="btn btn-success btn-sm">
                                                    ₹100
                                                </button>

                                                <button type="button" onclick="updateMoney(250);" class="btn btn-success btn-sm ml-0">
                                                    ₹250
                                                </button>

                                                <button type="button" onclick="updateMoney(500);" class="btn btn-success btn-sm ml-0">
                                                    ₹500
                                                </button>

                                                <button type="button" onclick="toggleCustomDonation();" class="btn btn-secondary btn-sm ml-0 mt-2 btn-block">
                                                    Enter custom amount
                                                </button>

                                                {{-- <button type="button" class="btn btn-secondary btn-sm ml-0 mt-2">
                                                    Choose no. of meals
                                                </button> --}}
                                            </center>
                                        </div>

                                        <script>
                                            function updateMoney(value) {

                                                if(value == '') {
                                                    alert('Choose an amount first');
                                                } else {
                                                    if(value > 10000) {
                                                    //TODO: Do this via SweetAlert.
                                                        alert('Dear donor, For any amount higher than ₹10,000, please contact staff. donations@feedthepoor.in')
                                                    }

                                                    if(value < 30) {
                                                        alert('Dear donor, it takes us a minimum of ₹30 to feed a person. Please consider a higher amount to continue.')
                                                    }
                                                }

                                                var donationAmount = document.getElementById('donationAmount');
                                                donationAmount.innerHTML = value;
                                                calculateNumberOfMeals(value);
                                            }

                                            function toggleCustomDonation() {
                                                var customDonationAmountBox = document.getElementById('customDonationAmountBox');
                                                if(customDonationAmountBox.style.display == 'none') {
                                                    customDonationAmountBox.style.display = '';
                                                } else {
                                                    customDonationAmountBox.style.display = 'none';
                                                }
                                            }

                                            function calculateNumberOfMeals(money) {
                                                var costpermeal = 50;
                                                var meals = 0;

                                                meals = Math.floor(money / costpermeal);
                                                if(meals < 0) {
                                                    meals = 0;
                                                }

                                                document.getElementById('mealsPossible').innerHTML = meals;
                                                document.getElementById('moneyPossible').innerHTML = money;
                                            }

                                            function processNextStep() {
                                             var amount = donationAmount.innerHTML;
                                             window.location.href = "{{ url('donate') }}/" + amount;
                                            }

                                        </script>

                                        <div class="input-group mb-3" id="customDonationAmountBox" style="display: none;">
                                            <input type="text" class="form-control" placeholder="Minimum of ₹30" id="custom-amount">
                                            <div class="input-group-append">
                                                <button onclick="updateMoney(document.getElementById('custom-amount').value); toggleCustomDonation();" class="btn btn-secondary" type="button">Process</button>
                                            </div>
                                        </div>

                                     </div>
                                   {{-- <div class="col-md-2" style="padding: 0px; margin: 0px;">
                                      <a class="btn btn-sm donate-plus-button text-dark btn-secondary">
                                         <i class="fa fa-plus"></i>
                                      </a>
                                   </div>
                                   <div class="col-md-2" style="padding: 0px; margin: 0px;">
                                      <a class="btn btn-sm text-dark donate-minus-button btn-secondary">
                                        <i class="fa fa-minus"></i>
                                      </a>
                                   </div> --}}
                                </div>
                             </div>
                             <button onclick="processNextStep();" class="btn btn-block btn-lg bg-white mt-4 btn-animated btn-animated-x text-success">
                                <span class="btn-inner--visible">Proceed to donate ₹<span id="donationAmount">50</span></span>
                                <span class="btn-inner--hidden">
                                   <svg class="svg-inline--fa fa-credit-card fa-w-18" aria-hidden="true" data-prefix="fas" data-icon="credit-card" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                      <path fill="currentColor" d="M0 432c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V256H0v176zm192-68c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H204c-6.6 0-12-5.4-12-12v-40zm-128 0c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM576 80v48H0V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48z"></path>
                                   </svg>
                                   <!-- <i class="fas fa-credit-card"></i> -->
                                </span>
                             </button>

                             <p class="mt-3 text-center text-white">
                                <span id="mealsPossible">1</span> donation(s) possible* ₹<span id="moneyPossible">50</span>
                             </p>
                          </form>
                       </div>
                    </div>
                </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="slice-lg">
      <div class="container">
         <div class="row py-5 align-items-center cols-xs-space cols-sm-space cols-md-space">
            <div class="col-md-12">
               <div class="campaign custom--card">
                  <div class="wrapper" style="background: url('https://cdn.discordapp.com/attachments/546410461193699334/745487084713672825/mission_daily_meal_website.png') center/cover no-repeat;">
                     <div class="custom--header">
                        <div class="date">
                           <span class="text-light">14,239.00 INR Raised</span>
                        </div>
                     </div>
                     <div class="data">
                        <div class="content">
                           <span class="author">Campaigns</span>
                           <h1 class="title"><a href="#">Mission: <i> Daily Meal</i></a></h1>
                           <p class="text py-5">This Campaign was launched by icrewsystems to raise donations to serve daily meals to all the underprivledged</p>
                           <a href="http://feedthepoor.online/en/mission" class="btn btn-primary btn-sm">Take part in this campaign</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- <section class="py-xl">
      <span class="mask bg-primary alpha-6"></span>
      <div class="container d-flex align-items-center no-padding">
          <div class="col">
              <div class="row">

              </div>
          </div>
      </div>
      </section> -->
@endsection

