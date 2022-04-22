@extends('layouts.frontend')
@section('css')
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
        box-shadow: 0 0 200px rgba(0, 0, 0, 0.9) inset;
    }

    #map {
        height: 200px;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
@endsection

@section('js')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-providers/1.13.0/leaflet-providers.min.js" integrity="sha512-5EYsvqNbFZ8HX60keFbe56Wr0Mq5J1RrA0KdVcfGDhnjnzIRsDrT/S3cxdzpVN2NGxAB9omgqnlh4/06TvWCMw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var map = L.map('map').setView([23.23, 80], 2);

    @foreach($locations as $location)
        L.marker([{{ $location->location_latitude}}, {{ $location->location_longitude }}])
        .bindTooltip('{{ $location->location_name }}')
        .addTo(map);
    @endforeach

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        maxZoom: 20
    }).addTo(map);
</script>
@endsection

@section('content')
<!-- Hero -->
<section class="section section-header text-white pb-md-10 hero-header">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-md-7 col-lg-6 text-center text-md-left">
                <h1 class="display-3 mb-4">
                    {{ config('app.ngo_name') }}
                </h1>
                <p class="lead mb-4 text-muted">
                    All about who we are, what we do and most importantly, why we do them.
                </p>
                <a href="#who-we-are" class="btn btn-tertiary me-3 animate-up-2">
                    Read More <span class="ms-2"><span class="fas fa-arrow-down"></span></span>
                </a>
            </div>

            <div class="col-12 col-md-5 d-none d-md-block text-center">
                <img src="{{ asset('images/branding/roshni-foundation.png') }}" alt="">
            </div>

            {{-- Roshni Moolchandani Charitable Trust has been founded on 28th August 2019 in memory of Ms Roshni Moolchandani Ma'am who passed away at early age of 21 on 6th June 2019 in Oman Dubai Bus accident,
                We are India's most trusted Ngo because we  provide 100% transparency for every donation , we keep record of every beneficiary id proof, photo,video & share it with donor
    We are feeding  more than 30,000 unprivileged children, handicap, transgender community,oldage people approximately everyday through our food vans in slum areas & hunger spots of different cities of India also we are helping
unprivileged children with basic necessities like clothes ,shoes, school stationary & looking after their education & working towards to help handicapped people with prosthetic limbs & tricycles.
We are doing these social welfare activities at national level & mass level , our partners our Zomato feeding india , Nestle, Britannia and many more renowned brands and MNC’s --}}
        </div>
    </div>
</section>
<!-- End of Hero section -->
<!-- Section -->
<section class="section section-md">
    <div class="container">
        <div class="row align-items-center justify-content-around">
            <div class="col-md-6 col-xl-6 mb-5">
                <img class="organic-radius img-fluid" src="https://www.masala.com/cloud/2021/08/01/fc4LJDjo-RoshniMoolchandani.png.png" alt="Roshni_moolchandani_portfolio">
                <div class="mt-n9 mr-5">

                    <span class="text-white font-bold uppercase ml-12 px-5 text-sm" style="opacity: 50%;">
                        Ms. Roshni Moolchandani <br>
                        {{-- <span class="font-normal ml-12 px-5">
                                DD-MM-YY to 9-06-2019
                            </span> --}}
                    </span>

                    <img src="{{ asset('images/branding/roshni-foundation-black.png') }}" alt="" style="width: 150px; height: auto;">
                </div>
            </div>
            <div class="col-md-6 col-xl-5 text-center text-md-left" id="who-we-are">
                <h2 class="h1 mb-5">
                    Our story
                </h2>
                <p class="lead">
                    Roshni Moolchandani Charitable Trust was founded on <span class="font-bold">28th August, 2019</span> in loving memory of
                    <span class="font-bold text-theme" style="text-decoration: underline">Ms. Roshni Moolchandani</span>
                    who became one with nature at a very early age of 21, on <span class="font-bold">6th June 2019</span>
                    in a
                    <a href="https://www.gulftoday.ae/news/2019/06/10/fans-shocked-at-indian-model-roshni-moolchandani-death-in-dubai-accident" class="font-bold" target="_blank">tragic bus accident at Oman, Dubai. <i class="fas fa-link"></i>
                    </a>

                    <br><br>
                    May her soul find eternal rest 🙏
                </p>
                <p class="lead">
                    To this day forward,
                    every day, Ms. Roshni and her life's work is remembered
                    through the eyes of charity at {{ config('app.ngo_name') }} in
                    all the different causes and campaigns carried out by
                    the enthusiastic team led by Ms. Roshni's brother, <span class="font-bold">Mr. Darpan Moolchandani</span>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- End of section -->

<section class="section bg-gray section-lg pt-0 text-white">
    <div class="container text-center">
        <div class="row justify-content-center p-8">
            <div class="col-12 col-md-8 text-center">
                <h3 class="display-5">
                    What's different about <br>
                    <span class="text-theme">{{ config('app.ngo_name') }}?</span>
                </h3>
                <p class="display-3">
                    One word, <span class="font-bold fst-italic text-theme">Transparency.</span>
                </p>
                <p>
                    We are one of India's primier charity organization that offers 100% transparency
                    for <span class="font-bold fst-italic">every donation</span> irrespective of size and amount.
                    We achieve this with the help of modern information technology.
                </p>
            </div>
        </div>

        <div class="row align-items-center justify-content-around">

            <div class="col-md-12">
                <h3 class="display-3">
                    Some of our core <span class="text-theme">values & principles</span>
                </h3>
            </div>

            <div class="col-12 col-lg-4">
                <div class="icon-box text-center mb-5">
                    <div class="icon icon-shape icon-shape-secondary rounded-circle mb-4"><span class="far fa-lightbulb"></span></div>
                    <h3 class="h5">Ideas and Concepts</h3>
                    <p class="icon-box-text">
                        We put alot of thought into each of our causes and campaigns
                        to make sure they address the core needs of the underprivledged
                    </p>
                </div>

                <div class="icon-box text-center mb-5 mb-lg-0">
                    <div class="icon icon-shape icon-shape-secondary rounded-circle mb-4"><span class="fas fa-fingerprint"></span></div>
                    <h3 class="h5">
                        Exellence through transparency
                    </h3>
                    <p class="icon-box-text">
                        Transparency is the highest priority of all our charity operations.
                        We've had an excellent track record of all our financials and public relations.
                    </p>
                </div>
            </div>


            <div class="col-md-6 col-lg-4">
                <center>
                    <img class="d-none d-lg-block" src="{{ asset('images/branding/roshni-foundation.png') }}" alt="illustration" style="width: 200px; height: auto;">
                </center>
            </div>


            <div class="col-12 col-lg-4">
                <div class="icon-box text-center mb-5">
                    <div class="icon icon-shape icon-shape-secondary rounded-circle mb-4"><span class="fas fa-code"></span></div>
                    <h3 class="h5">Embracing modern technology</h3>
                    <p class="icon-box-text">
                        We've partnered with the best IT service providers in the country
                        who share a common belief of harnessing the full power of IT, for good
                        of humanity.
                    </p>
                </div>

                <div class="icon-box text-center mb-5 mb-lg-0">
                    <div class="icon icon-shape icon-shape-secondary rounded-circle mb-4"><span class="far fa-grin-stars"></span></div>
                    <h3 class="h5">Social Responsibility Platform</h3>
                    <p class="icon-box-text">
                        We provide a platform for enthusiastic volunteers of all ages
                        to serve the underprivledged communities of Rural India.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section -->
<section class="section section-lg mt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto text-center mb-5">

                <h3 class="display-4">
                    What have we <span class="text-theme">accomplished?</span>
                </h3>

                <p>
                    We've existed since 28th of August, 2019.
                    That's {{ (Carbon\Carbon::parse('28-08-2019'))->diffInDays(Carbon\Carbon::now()) }} days of operations.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-lg-4 text-center">
                <!-- Visit Box -->
                <div class="icon-box mb-4">
                    <div class="icon icon-primary mb-4">
                        {{-- <span class="font-bold">₹</span> --}}
                        <span class="fas fa-rupee-sign"></span>
                    </div>
                    <h3 class="h5">Donations Collected</h3>
                    <span class="counter display-3 text-gray d-block">
                        9,500,000+
                    </span>
                </div>
                <!-- End of Visit Box -->
            </div>
            <div class="col-md-4 col-lg-4 text-center">
                <!-- Call Box -->
                <div class="icon-box mb-4">
                    <div class="icon icon-primary mb-4">
                        <span class="fas fa-users"></span>
                    </div>
                    <h3 class="h5">People helped</h3>
                    <span class="counter display-3 text-gray d-block">15,000,000+</span>
                </div>
                <!-- End of Call Box -->
            </div>
            <div class="col-md-4 col-lg-4 text-center">
                <!-- Email Box -->
                <div class="icon-box mb-4">
                    <div class="icon icon-primary mb-4">
                        <span class="fas fa-gift"></span>
                    </div>
                    <h3 class="h5">Campaigns</h3>
                    <span class="counter display-3 text-gray d-block">50+</span>
                </div>
                <!-- End of Email Box -->
            </div>


            <div class="col-md-12 text-center">

                <p class="text-muted">
                    Wish to see more accurate statistics? Our numbers are updated in real time. Go to the statistics
                    page to view in-depth information
                </p>

                <a href="#" class="btn btn-md btn-theme btn-hover">
                    View live statistics
                </a>
            </div>

        </div>
    </div>
</section>
<!-- End of section -->


<section class="section section-lg pt-5">
    <div class="container">
        <div class="row">

            <div class="col-md-6 px-3">
                <p class="">

                <h3 class="display-4">
                    Our locations of <span class="text-theme">operations</span>
                </h3>


                We have operations in many major cities and rural areas
                across India.
                Our IT infrastructure works in a way that, all the donations
                are automatically routed to different locations.
                </p>
            </div>


            <div class="col-md-6">
                <div id="map" style="height: 200px; width: auto; z-index: 0;"></div>
            </div>
        </div>
    </div>
</section>

<section class="section section-lg pt-5">
    <div class="container text-center">
        <div class="row mb-1">
            <div class="col-md-6 mx-auto">
                <h3 class="display-4">
                    <span class="text-theme">Together</span>, we can do so much.
                </h3>
                <p>
                    We have partnered with brands that
                    have helped us directly by sponsoring donation campaigns, providing
                    us with material goods for distribution or provide their
                    valueable goods and services for the betterment of the NGO.
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-lx-10">
                <ul class="d-flex flex-wrap justify-content-center list-unstyled">
                    {{-- <li class="mx-3 mb-1"><img class="image-fluid pt-4" src="{{ asset('images/about_us/Britannia_Industries_logo.svg.png') }}" width="150px" height="auto" alt="corsair logo"></li>
                    <li class="mx-3 mb-1 "><img class="image-fluid" src="{{ asset('images/about_us/Nestle.jpeg') }}" width="250px" height="auto" alt="nestle logo"></li>
                    <li class="mx-3 mb-1"><img class="image-fluid pt-4" src="{{ asset('images/about_us/Zomato.png') }}" width="250px" height="auto" alt="paypal logo"></li> --}}
                    <li class="mx-3 mb-1"><img class="image-fluid pt-4" src="{{ asset('images/branding/partners/logos/logos-cluster.png') }}" width="550px" height="auto" alt="corsair logo"></li>
                </ul>

                <a href="{{ route('frontend.partners') }}" class="btn btn-theme text-white">View more about our partners</a>
            </div>
        </div>
    </div>
</section>

{{-- <section class="section">
    <div class="container">

        <div class="row mb-4">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/about_us/Nestle_donation_1.jpg') }}" class="d-block mx-auto w-50" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/about_us/Nestle_donation_2.jpg') }}" class="d-block mx-auto w-50" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/about_us/Nestle_donation_3.jpg') }}" class="d-block mx-auto w-50" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/about_us/Nestle_donation_4.jpg') }}" class="d-block mx-auto w-50" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/about_us/Nestle_donation_5.jpg') }}" class="d-block mx-auto w-50" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/about_us/Nestle_donation_6.jpg') }}" class="d-block mx-auto w-50" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/about_us/Nestle_donation_7.jpg') }}" class="d-block mx-auto w-50" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/about_us/Nestle_donation_8.jpg') }}" class="d-block mx-auto w-50" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev text-secondary" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next text-secondary" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col">
                <img class="card shadow-lg image-fluid" src="{{ asset('images/about_us/Nestle.jpeg') }}" width="300px" height="10px" alt="nestle logo">
            </div>
            <div class="col pt-4">
                <p class="text-secondary fs-5"> Nestle is our official partner , Nestle keep helping us with materialistic things like they provided <strong class="text-success fw-bolder"> 4,000 units of Nestle Milo </strong> to our ngo in covid pandemic to needy , malnourished & unprivileged kids to improve their immunity to fight with covid </p>
            </div>
        </div>

        <div class="row mt-2">

            <div class="col pt-4">
                <p class="text-secondary fs-5"> Zomato Feeding India is also our official partner they keep providing ration kits for handicap , old age & keep helping in daily feeding program , we are <strong class="text-success fw-bolder"> feeding more than 8000 families in pan india </strong> in partnership with Zomato Feeding India </p>
            </div>
            <div class="col">
                <img class=" my-4 mx-2 card shadow-lg image-fluid" src="{{ asset('images/about_us/Zomato.png') }}" width="300px" height="10px" alt="nestle logo">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col">
                <img class=" my-4 mx-2  p-2 card shadow-lg image-fluid" src="{{ asset('images/about_us/Britannia_Industries_logo.svg.png') }}" width="300px" height="10px" alt="nestle logo">
            </div>
            <div class="col pt-4">
                <p class="text-secondary fs-5">Britannia is also our official partner , Britannia keep helping us with materialistic things like they provided <strong class="text-success fw-bolder"> 2000 units of Britannia biscuits </strong> to our ngo in covid pandemic to needy , malnourished & unprivileged kids </p>
            </div>
        </div>

        <div class="row">
            <p class="text-secondary fs-2 text-center pt-4"> For all Techinal & IT Support</p>
        </div>
        <div class="d-flex justify-content-center ">
            <img class=" my-2    mx-2  p-2 image-fluid" src="{{ asset('theme/assets/img/icrewsystems_logo_highres.png') }}" width="270px" height="10px" alt="icrew logo">
        </div>
    </div>
</section> --}}




<!-- Section -->
<section class="section">
    <div class="container">
        <div class="row mb-5 mb-lg-6">
            <div class="col-12 col-md-9 col-lg-8 text-center mx-auto">
                <h2 class="h1 mb-4">
                    Our <span class="text-theme">Leadership</span>
                </h2>
                <p class="lead">
                    {{ config('app.ngo_name') }} is being led efficiently towards the path
                    of success by an able & motivated team & independant board members.
                </p>
            </div>
        </div>

        <div class="row mb-5 mb-lg-6">
            <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="card shadow border-gray-300">
                    <img src="{{ asset('images/team/darpan-moolchandani.jpg') }}" class="card-img-top rounded-top" alt="Joseph Portrait">
                    <div class="card-body">
                        <h3 class="h4 card-title mb-2">
                            Darpan Moolchandani
                        </h3>
                        <span class="card-subtitle text-gray fw-normal">Founder</span>
                        <p class="card-text my-3">
                            -- INFORMATION ABOUT DARPAN --
                        </p>
                        <ul class="list-unstyled d-flex mt-3 mb-0">
                            <li>
                                <a href="#" target="_blank" aria-label="facebook social link" class="icon-facebook me-3">
                                    <span class="fab fa-facebook-f"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" aria-label="twitter social link" class="icon-twitter me-3">
                                    <span class="fab fa-twitter"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" aria-label="slack social link" class="icon-slack me-3">
                                    <span class="fab fa-instagram"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="card shadow border-gray-300">
                    <img src="{{ asset('images/board_members/person1.jpeg') }}" class="card-img-top rounded-top" alt="Bonnie portrait">
                    <div class="card-body">
                        <h3 class="h4 card-title mb-2">---------</h3>
                        <span class="card-subtitle text-gray fw-normal">Board Member</span>
                        <p class="card-text my-3">-- Board Member info --</p>
                        <ul class="list-unstyled d-flex mt-3 mb-0">
                            <li>
                                <a href="#" target="_blank" aria-label="facebook social link" class="icon-facebook me-3">
                                    <span class="fab fa-facebook-f"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" aria-label="twitter social link" class="icon-twitter me-3">
                                    <span class="fab fa-twitter"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" aria-label="slack social link" class="icon-slack me-3">
                                    <span class="fab fa-slack-hash"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" aria-label="dribbble social link" class="icon-dribbble me-3">
                                    <span class="fab fa-dribbble"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="card shadow border-gray-300">
                    <img src="{{ asset('images/board_members/person2.jpeg') }}" class="card-img-top rounded-top" alt="Jose Avatar">
                    <div class="card-body">
                        <h3 class="h4 card-title mb-2">-----------</h3>
                        <span class="card-subtitle text-gray fw-normal">Board member</span>
                        <p class="card-text my-3">-- Board Member info -- </p>
                        <ul class="list-unstyled d-flex mt-3 mb-0">
                            <li>
                                <a href="#" target="_blank" aria-label="facebook social link" class="icon-facebook me-3">
                                    <span class="fab fa-facebook-f"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" aria-label="twitter social link" class="icon-twitter me-3">
                                    <span class="fab fa-twitter"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" aria-label="slack social link" class="icon-slack me-3">
                                    <span class="fab fa-slack-hash"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" aria-label="dribbble social link" class="icon-dribbble me-3">
                                    <span class="fab fa-dribbble"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div>


        </div>



        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="d-grid">

                    <p class="mb-3">
                        We're always open to collaborating with brands, companies for the collective good of
                        the underprivledged. Let's join hands and give privledge to the underprivledged.
                    </p>

                    <a href="{{ route('frontend.contact') }}" class="btn btn-theme btn-hover">
                        Reach out to us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of section -->
@endsection
