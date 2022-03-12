@extends('layouts.frontend')
@section('meta')
<title>
    {{ config('app.name') }} | Donate Transparently
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<style>
    .about-hero-header {
        background-image: linear-gradient(rgba(28, 44, 52, 0.4), rgba(28, 44, 52, 0.4)), url(https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/k-26-aom-19379-olj0127word-1-volunteer_2.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=33836cd64561a589ec978b21287c0597);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
    }

    .about-hero-header .container {
        position: relative;
        top: 50%;
    }

    .about-hero-header .hero-section {}

    .about-hero-header .hero-section .col-md-12 .about-hero-head {
        font-size: 3rem;
        font-weight: bold;
        color: #fff;
        letter-spacing: 2px;
        text-align: center;
    }

    .mb-50 {
        margin-bottom: 50px;
    }

    .mb-20 {
        margin-bottom: 20px;
    }

    .heading {
        margin-bottom: 40px;
    }

    .heading-title-main {
        font-size: 2rem;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .boxShadow {
        box-shadow: 0 12px 15px rgb(0 0 0 / 10%), 0 17px 50px rgb(0 0 0 / 10%);
    }

    .about-image {
        width: 60%;
        height: 100%;
        margin-bottom: 20px;
        display: block;
        margin: 0 auto;
    }

    .slightlyDown {
        transform: translateY(70px) !important;
    }

    .methodOfOp {
        height: 100%;
        width: 100%;
        padding: 40px;
        display: block;
        margin: 0 auto;

    }

    .methodOfOp h1 {
        text-align: center;
    }

    .methodOfOp-title {
        font-size: 2rem;
        font-weight: bold;
        letter-spacing: 1px;
        text-align: center;
        color: rgba(28, 44, 52, 1);
        margin-bottom: 20px;
    }

    .active-method {
        background-color: rgba(28, 44, 52, 1);
    }

    .active-method h1 span {
        color: #fff;
    }

    .hide {
        display: none;
        opacity: 0;
    }

    .show {
        display: block;
        opacity: 1;
    }

    .about-content {
        position: relative;
        padding: 20px;
        top: 50%;
        transform: translateY(-50%);
    }

    .feed-img {
        width: 100%;
        height: 100%;
    }

    .about-method {
        padding: 0px;
    }

    .about-method p {
        font-size: 1.3rem;
    }

    .aboutDonate {
        background-image: url(https://demo.themefisher.com/wishfund/images/bg/bg-3.jpg);
        background-size: cover;
        padding: 120px 0px !important;
        height: 80vh;
        width: 100vw;
    }

    .aboutDonate::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
    }

    .aboutDonate .container {
        position: relative;
        top: 50%;
        transform: translateY(-50%);
    }

    .donateContent {
        display: block;
        margin: 0 auto;
    }

    .donateContent .donateText {
        font-size: 2rem;
        font-weight: bold;
        letter-spacing: 1px;
        text-align: center;
        color: #fff;
        margin-bottom: 20px;
    }

    .justify-content-center {
        justify-content: center !important;
    }

    .mb-100 {
        margin-bottom: 100px;
    }

    img {
        border-radius: 20px;
        box-shadow: 0 12px 15px rgb(0 0 0 / 10%), 0 17px 50px rgb(0 0 0 / 10%);
    }

    .bgcl {
        background-color: #1c2540 !important;
    }


    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    .fadeIn {
        animation: fadeIn 0.7s ease-in-out forwards;
    }

    .fadeOut {
        animation: fadeOut 0.7s ease-in-out forwards;
    }
</style>
<style>
    @media (max-width: 768px) {

        .col-md-6,
        .methodCol {
            width: 100% !important;
        }

        .methodOP {
            padding: 0px !important;
            width: 33.33%;
        }

        .methodCol:nth-child(2) {
            margin: 20px 0px !important;
        }
    }

    @media (max-width: 576px) {
        .methodOfOp {
            padding: 0px !important;
        }

        .methodOfOp h1 span {
            font-size: 1.5rem;
        }

        .about-hero-head {
            font-size: 2rem !important;
        }
    }

    @media (min-width: 769px) {
        .methodOP {
            width: 100%;
        }
    }
</style>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script defer>
    let changeMethod = (methods, targetEle) => {
        methods.forEach(method => {
            $(method).removeClass('active-method');
        });
        targetEle.addClass('active-method');
        let target = targetEle.attr('data-target');
        $('.opData').each((i, e) => {
            if ($(e).attr('id') == target) {
                $(e).removeClass('fadeOut');
                $(e).removeClass('hide');
                $(e).addClass('fadeIn');
                $(e).addClass('show');
            } else {
                $(e).removeClass('show');
                $(e).addClass('hide');
            }
        });
    }
    let autoSwitch = (methods) => {
        let currentMethod = $('.active-method');
        [...methods].indexOf(currentMethod[0]) == methods.length - 1 ? changeMethod(methods, $(methods[0])) : changeMethod(methods, $(methods[[...methods].indexOf(currentMethod[0]) + 1]));
    }
    $(document).ready(() => {
        let methods = document.querySelectorAll('#methodOfOp');
        let timer = setInterval(() => {
            autoSwitch(methods);
        }, 3000);
        methods.forEach(e => {
            $(e).on('mouseover tap', () => {
                clearTimeout(timer);
                changeMethod(methods, $(e));
                timer = setInterval(() => {
                    autoSwitch(methods);
                }, 3000);
            })
        });
    });
</script>
@endsection

<section class="about-hero-header">
</section>

<section class="container mt-5">
    <div class="d-flex justify-content-center">
        <h1>Here we have some of our prestigious volunteers</h1>
    </div>
    <div class="mt-5">
        <img class="h-50 mx-auto d-block" src="/volunteer-images/volunteer-1.jpg" alt="volunteer-1">
    </div>
    <div class="mt-6">
        <img class="h-50 mx-auto d-block" src="/volunteer-images/volunteer-2.jpg" alt="volunteer-2">
    </div>
    <div class="mt-6">
        <img class="h-50 mx-auto d-block" src="/volunteer-images/volunteer-3.jpg" alt="volunteer-3">
    </div>
    <div class="mt-6">
        <img class="h-50 mx-auto d-block" src="/volunteer-images/volunteer-4.jpg" alt="volunteer-4">
    </div>
    <div class="mt-6">
        <img class="h-50 w-50 mx-auto d-block" src="/volunteer-images/volunteer-5.jpeg" alt="volunteer-5">
    </div>

</section>

<section class="section section-lg pt-0 mb-50 mt-6">
    <div class="container bgcl pb-7">
        <div class="row">
            <div class="col-md-6 slightlyDown">
                <img src="https://images.assetsdelivery.com/compings_v2/dizanna/dizanna1807/dizanna180700148.jpg" class="about-image boxShadow">
            </div>
            <div class="col-md-6 mt-6">
                <div class="heading">
                    <h2 class="heading-title">
                        <span class="heading-title-main text-white">
                            #joinWithUsToFeedThePoor
                        </span>
                    </h2>
                </div>
                <div class="content text-white">
                    Share your helping hands with us! volunteers do not necessarily have the time; they just have the heart. You make a living by what you get. You make a life by what you give. Volunteers are the only human beings on the face of the earth who reflect this nation's compassion, unselfish caring, patience, and just plain loving one another. Our motive is to feed the underpivileged half of our nation, that is heavily affeccted by the pangs of poverty and isn't capable of earning their bread. Let's join our hands together to make our country hunger free</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mt-3">
    <h1 class="d-flex justify-content-center">VOLUNTEER WITH US</h1>
    <h3 class="d-flex justify-content-center"># Become a hunger hero</h3>
    <div class="mt-6">
        <form method="POST" enctype="multipart/form-data" action="#">
            @csrf
            <div>
                <h3>Personal details</h3>
            </div>
            <div class="row">
                <div class="col form-floating mb-3 mt-3">
                    <input class="form-control border border-3" type="text" placeholder="Enter first name" name="firstname" required>
                    <label for="Firstname" class="ms-2">Firstname</label>
                </div>
                <div class="col  form-floating mb-3 mt-3">
                    <input class="form-control border border-3" type="text" placeholder="Enter last name" name="lastname" required>
                    <label for="Lastname" class="ms-2">Lastname</label>
                </div>
            </div>

            <div class="row">
                <div class="col form-floating mb-3 mt-3">
                    <input type="date" class="form-control" id="date" placeholder="Enter Date of birth" name="DOB" required>
                    <label for="DOB" class="ms-2 text-dark"><b> Date of birth</b></label>
                </div>
                <div class="col form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="institution" placeholder="Enter institution" name="institute">
                    <label for="institution" class="ms-2">Current institute or organization</label>
                </div>
            </div>
            <br><br>
            <div>
                <h3>Contact details</h3>
            </div>

            <div class="row">
                <div class="col form-floating mb-3 mt-3">
                    <input class="form-control border border-3" type="email" placeholder="Enter Email" name="Email" required>
                    <label for="Email" class="ms-3">Email</label>
                </div>

                <div class="col form-floating mb-3 mt-3">
                    <input class="form-control border border-3" type="text" placeholder="Enter Phone number" name="phonenumber">
                    <label for="phonenumber" class="ms-3">Phone number</label>
                </div>
            </div>
            <br><br>

            <div>
                <h3>How often will you be able to help</h3>
            </div>

            <div class="row mt-4 ms-2">
                <div class="col form-check">
                    <input type="radio" class="form-check-input" id="radio1" value="option1">Daily
                    <label class="form-check-label"></label>
                </div>
                <div class="col form-check me-6">
                    <input type="radio" class="form-check-input" id="radio2" value="option2">Multiple days in a week
                    <label class="form-check-label"></label>
                </div>
                <div class="col form-check ms-4">
                    <input type="radio" class="form-check-input" id="radio3" value="option3">Once a week
                    <label class="form-check-label"></label>
                </div>
                <div class="col form-check">
                    <input type="radio" class="form-check-input" id="radio4" value="option4">Twice a week
                    <label class="form-check-label"></label>
                </div>
            </div>
            <br><br>

            <div>
                <h3>Your Location</h3>
            </div>

            <div class="form-floating mb-3 mt-4">
                <input class="form-control border border-3" type="text" placeholder="Enter Address" name="address">
                <label for="address" class="ms-3">Address</label>
            </div>

            <div class="row">

                <div class="col form-floating mb-3 mt-4">
                    <input class="form-control border border-3" type="text" placeholder="Enter City" name="city">
                    <label for="city" class="ms-3">City</label>
                </div>

                <select class="col form-select mb-3 mt-4" id="state" name="state">
                    <option>State</option>
                    <option>Andhra Pradesh</option>
                    <option>Arunachal Pradesh</option>
                    <option>Assam</option>
                    <option>Bihar</option>
                    <option>Chattisgarh</option>
                    <option>Goa</option>
                    <option>Gujarat</option>
                    <option>Haryana</option>
                    <option>Himachal Pradesh</option>
                    <option>Jharkhand</option>
                    <option>Karnataka</option>
                    <option>Kerala</option>
                    <option>Madhya Pradesh</option>
                    <option>Maharashtra</option>
                    <option>Manipur</option>
                    <option>Meghalaya</option>
                    <option>Mizoram</option>
                    <option>Nagaland</option>
                    <option>Odisha</option>
                    <option>Punjab</option>
                    <option>Rajasthan</option>
                    <option>Sikkim</option>
                    <option>Tamil Nadu</option>
                    <option>Telangana</option>
                    <option>Tripura</option>
                    <option>Uttar Pradesh</option>
                    <option>Uttarakhand</option>
                    <option>West Bengal</option>
                </select>
                <div class="col form-floating mb-3 mt-4">
                    <input class="form-control border border-3" type="text" placeholder="Enter Pincode" name="pincode">
                    <label for="pincode" class="ms-3">Pincode</label>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4 mb-6">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </form>
    </div>
</section>