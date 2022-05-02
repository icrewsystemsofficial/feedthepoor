@extends('layouts.frontend')

@section('meta')
<title>
    {{ config('app.name') }} | Donate Transparently
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('css')
<style>
    .hero-header {
        min-height: 50vh;
        max-height: 100vh;
        background: url('{{ asset('images/branding/partners/banner.jpg') }}') center center no-repeat;
        background-size: cover;
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
    }
    .hero-header::before{
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
    }
</style>
@endsection

@section('content')

<section class="section section-header text-white hero-header">
    <div class="container" style="position: relative;z-index: 2;">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-md-7 col-lg-6 text-center text-md-left">
                <h1 class="display-3 mb-4">
                    Join hands with us to make a difference
                </h1>
                <p class="lead mb-4 text-muted">
                    Offer your expertise to help us put a smile on a face.
                </p>
                <a href="#partners" class="btn btn-tertiary me-3 animate-up-2">
                    Read More <span class="ms-2"><span class="fas fa-arrow-down"></span></span>
                </a>
            </div>
            <div class="col-12 col-md-5 d-none d-md-block text-center">
                <img src="{{ asset('images/branding/roshni-foundation.png') }}" alt="">
            </div>
       </div>
    </div>
</section>


<section class="section text-black pb-md-6" id="partners">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center display-3">
                    Partnership has its benefits
                </h2>
                <p class="text-center text-muted mb-6 display-5">
                    You help us to make a difference and we give you a chance to be a part of it
                </p>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-12 col-md-6 col-lg-6 text-md-left">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-md-6 col-lg-6">
                        <img src="{{ asset('images/branding/partners/success1.jpg') }}" alt="" srcset="" style="width: 100%; float: left; ">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <img src="{{ asset('images/branding/partners/success2.jpg') }}" alt="" srcset="" style="width: 100%; float: right; margin-top: 5% !important;">
                        <img src="{{ asset('images/branding/partners/success3.jpg') }}" alt="" srcset="" style="width: 100%; float: right; margin-top: 5% !important;">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 text-md-left px-md-5 mt-3">
                <div class="row justify-content-between align-items-center mb-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <h2 class="text-left display-3 mb-4">
                            Help us help the needy
                        </h2>
                        <p class="text-left text-muted display-5">
                            Raise awareness by starting chapters within your organisations
                        </p>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-12 col-md-6 col-lg-6 p-2">
                        <h2 class="text-left display-5">
                            Source materials
                        </h2>
                        <p class="text-left text-muted">
                            Help us get the items and materials needed to improve someone's day
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 p-2" style="height: 100%;">
                        <h2 class="text-left display-5">
                            Hand out packets of joy
                        </h2>
                        <p class="text-left text-muted">
                            Help us distribute bundles of joy to everyone all around the country
                        </p>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-12 col-md-6 col-lg-6 p-2">
                        <h2 class="text-left display-5">
                            Spread the word
                        </h2>
                        <p class="text-left text-muted">
                            Help us spread the word about the cause and help people to get involved
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 p-2">
                        <h2 class="text-left display-5">
                            Connect with others
                        </h2>
                        <p class="text-left text-muted">
                            Helps us connect with people who are already doing good work
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section text-black pb-md-8">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-6">
                <h1 class="text-center mt-auto">
                    <span class="display-1">15M+</span><br> People helped
                </h1>
                <p class="text-center text-muted">
                    {{ config('app.ngo_name') }} <br>connects those in need with those who can help them.
                </p>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <img src="{{ asset('images/branding/partners/feeding.jpg') }}" alt="" srcset="" style="width: 90%; float: left; margin-left: 5%;">
            </div>            
        </div>
    </div>
</section>

<section class="section bg-gray pt-0 pb-md-8 text-white" style="padding-bottom: 0px !important;">
    <div class="container text-center">
        <div class="row justify-content-center p-6">
            <div class="col-12 col-md-10 col-lg-8">
                <h2 class="display-3 mb-5">
                    We can't help everyone <span class="font-bold fst-italic text-theme"><br>but everyone can help someone</span>
                </h2>
                <p class="display-5 mb-5">
                    Your support would mean more dreams fulfilled and a better future, together.
                </p>
                <a href="{{ route('frontend.contact') }}" class="btn btn-theme btn-zoom--hover btn-shadow--hover btn-animated btn-animated-x donate-btn">
                    Reach out to us<span class="ms-2"><span class="fas fa-arrow-right"></span></span>
                </a>
            </div>
        </div>
    </div>
</section>
    
<section class="section text-black pb-md-8">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center display-3">
                    Our Partners
                </h2>
                <p class="text-center text-muted mb-6 display-5">
                    We are proud to drive towards change with the following organizations.
                </p>
            </div>
        </div>

    <div class="container mb-8">
        <div class="row justify-content-center align-items-center">            
            <div class="col-12 col-md-6 col-lg-6 p-6 d-flex align-items-center" style="height: 330px; width: 330px; box-shadow: 0 2px 5px rgb(0 0 0 / 0.2); border-radius: 20px;">
                <img class="d-block my-auto mx-auto" src="{{ asset('images/branding/partners/logos/nestle.png') }}" alt="" srcset="" style="width: 100%; height: 100%;">
            </div>
            <div class="col-12 col-md-6 col-lg-6 px-md-4 mt-md-0 mt-5">
                <h2 class="display-4 mb-4">
                    Official Partner
                </h2>
                <p class="display-7 mb-4">
                    <span class="font-bold fst-italic text-theme">Nestle</span> keep helping us with materialistic things like they provided 4,000 units of Nestle Milo to our ngo in covid pandemic to needy , malnourished & unprivileged kids to improve their immunity to fight with covid                    
                </p>
                <a class="btn btn-primary" href="https://www.nestle.in?_ref={{ config('app.url') }}" class="text-theme">
                    <span class="font-bold fst-italic text-theme">Visit Nestle<span class="ms-2"></span><span class="fas fa-arrow-right"></span></span>
                </a>
            </div>
        </div>
    </div>

    <div class="container d-none d-md-block mb-8">
        <div class="row justify-content-center align-items-center">            
            <div class="col-12 col-md-6 col-lg-6 align-self-center px-md-4 mt-md-0 mt-5">
                <h2 class="display-4 mb-4">
                    Official Partner
                </h2>            
                <p class="display-7 mb-4">
                    <span class="font-bold fst-italic text-theme">Britannia</span> keep helping us with materialistic things like they provided 2000 units of Britannia biscuits to our ngo in covid pandemic to needy , malnourished & unprivileged kids
                </p>
                <a class="btn btn-primary" href="https://www.britannia.co.in?_ref={{ config('app.url') }}" class="text-theme">
                    <span class="font-bold fst-italic text-theme">Visit Britannia<span class="ms-2"></span><span class="fas fa-arrow-right"></span></span>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center" style="height: 330px; width: 330px; box-shadow: 0 2px 5px rgb(0 0 0 / 0.2); border-radius: 20px;">
                <img class="d-block my-auto mx-auto" src="{{ asset('images/branding/partners/logos/britannia.png') }}" alt="" srcset="" style="width: 70%;">
            </div>            
        </div>
    </div>

    <div class="container d-block d-md-none mb-8">
        <div class="row justify-content-center align-items-center">            
            <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center" style="height: 330px; width: 330px; box-shadow: 0 2px 5px rgb(0 0 0 / 0.2); border-radius: 20px;">
                <img class="d-block m-auto" src="{{ asset('images/branding/partners/logos/britannia.png') }}" alt="" srcset="" style="width: 70%;">
            </div>            
            <div class="col-12 col-md-6 col-lg-6 align-self-center px-md-4 mt-md-0 mt-5">
                <h2 class="display-4 mb-4">
                    Official Partner
                </h2>            
                <p class="display-7 mb-4">
                    <span class="font-bold fst-italic text-theme">Britannia</span> keep helping us with materialistic things like they provided 2000 units of Britannia biscuits to our ngo in covid pandemic to needy , malnourished & unprivileged kids
                </p>
                <a class="btn btn-primary" href="https://www.britannia.co.in?_ref={{ config('app.url') }}" class="text-theme">
                    <span class="font-bold fst-italic text-theme">Visit Britannia<span class="ms-2"></span><span class="fas fa-arrow-right"></span></span>
                </a>
            </div>                    
        </div>
    </div>

    <div class="container mb-8">
        <div class="row justify-content-center align-items-center">            
            <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center" style="height: 330px; width: 330px; box-shadow: 0 2px 5px rgb(0 0 0 / 0.2); border-radius: 20px;">
                <img class="d-block m-auto" src="{{ asset('images/branding/partners/logos/zomato.png') }}" alt="" srcset="" style="width: 70%;">
            </div>
            <div class="col-12 col-md-6 col-lg-6 align-self-center px-md-4 mt-md-0 mt-5">
                <h2 class="display-4 mb-4">
                    Official Partner
                </h2>
                <p class="display-7 mb-4">
                    <span class="font-bold fst-italic text-theme">Feeding India by Zomato</span> keep providing ration kits for handicap , old age & keep helping in daily feeding program  , we are feeding more than 8000 families in pan india in partnership with Zomato Feeding India
                </p>
                <a class="btn btn-primary" href="https://www.feedingindia.org?_ref={{ config('app.url') }}" class="text-theme">
                    <span class="font-bold fst-italic text-theme">Visit Feeding India<span class="ms-2"></span><span class="fas fa-arrow-right"></span></span>
                </a>
            </div>
        </div>
    </div>

    <div class="container d-none d-md-block">
        <div class="row justify-content-center align-items-center">            
            <div class="col-12 col-md-6 col-lg-6 align-self-center px-md-4 mt-md-0 mt-5">
                <h2 class="display-4 mb-4">
                    Technology Partner
                </h2>            
                <p class="display-7 mb-4">
                    <span class="font-bold fst-italic text-theme">Icrewsystems</span> help us with the technology behind our digital platform making it more user friendly and making donations easy, secure and transparent
                </p>
                <a class="btn btn-primary" href="https://www.icrewsystems.com?_ref={{ config('app.url') }}" class="text-theme">
                    <span class="font-bold fst-italic text-theme">Visit Icrewsystems<span class="ms-2"></span><span class="fas fa-arrow-right"></span></span>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center" style="height: 330px; width: 330px; box-shadow: 0 2px 5px rgb(0 0 0 / 0.2); border-radius: 20px;">
                <img class="d-block m-auto" src="{{ asset('images/branding/partners/logos/icrew.png') }}" alt="" srcset="" style="width: 70%;">
            </div>            
        </div>
    </div>

    <div class="container d-block d-md-none">
        <div class="row justify-content-center align-items-center">            
            <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center" style="height: 330px; width: 330px; box-shadow: 0 2px 5px rgb(0 0 0 / 0.2); border-radius: 20px;">
                <img class="d-block m-auto" src="{{ asset('images/branding/partners/logos/icrew.png') }}" alt="" srcset="" style="width: 70%;">
            </div>            
            <div class="col-12 col-md-6 col-lg-6 align-self-center px-md-4 mt-md-0 mt-5">
                <h2 class="display-4 mb-4">
                    Technology Partner
                </h2>            
                <p class="display-7 mb-4">
                    <span class="font-bold fst-italic text-theme">Icrewsystems</span> help us with the technology behind our digital platform making it more user friendly and making donations easy, secure and transparent
                </p>
                <a class="btn btn-primary" href="https://www.icrewsystems.com?_ref={{ config('app.url') }}" class="text-theme">
                    <span class="font-bold fst-italic text-theme">Visit Icrewsystems<span class="ms-2"></span><span class="fas fa-arrow-right"></span></span>
                </a>
            </div>                    
        </div>
    </div>

    </div>
</section>

@endsection