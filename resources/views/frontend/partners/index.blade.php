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
        background-image: linear-gradient(rgba(28, 44, 52, 0.4), rgba(28, 44, 52, 0.4)), url("/volunteer-images/volunteerbackimg.jpg");
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

    
.hero {
    position: relative; 
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero::before {    
      content: "";
      background-image: url('https://images.pexels.com/photos/3184422/pexels-photo-3184422.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
      background-size: cover;
      position: absolute;
      top: 0px;
      right: 0px;
      bottom: 0px;
      left: 0px;
      /* opacity: 0.8; */
}

h1 {
  position: relative;
  color: #8e6c59;  
  font-size: 12rem;
  line-height: 0.9;
  text-align: right;
}

/* ------------------------NAVBAR---------------------------- */
#mainNavbar {
    font-size: 1.5rem;
    font-weight: 100;    
}

#mainNavbar .nav-link {
    color: white;
}

#mainNavbar .nav-link:hover {
    color: #b29c8f;
}

#mainNavbar .navbar-brand {
    color: #b29c8f;
    font-size: 1.5rem;
}


.navbar.scrolled {
    background: #141e30;
    transition: background 500ms;
}

@media (max-width: 1200px) {
    #headingGroup h1 {
        font-weight: 100;
        font-size: 3rem;
    }
    .blurb h2 {
        font-size: 2rem;
    }
}

/* --------------------MAIN BOX------------------------ */


* {
	box-sizing: border-box;
}
body {
	font-family: sans-serif;
	line-height: 1.6;
	margin: 0;
	min-height: 100vh;
    margin:0;
  padding:0;
  background: linear-gradient(#141e30, #243b55);
}
ul {
  margin: 0;
  padding: 0;
  list-style: none;
}


.a {
	text-decoration: none;
  color: #34495e;
  padding: 10px 15px;
	text-transform: uppercase;
	text-align: center;
	display: block;
  color: #34495e;
	font-size: .99em;
}

.main-nav a:hover {
	color: #718daa;
}

@media (min-width: 1025px) {
	.header {
		flex-direction: row;
		justify-content: space-between;
	}

} */

html {
  height: 100%;
}
.square {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  padding: 65px;
  transform: translate(-50%, -50%);
  background: rgba(0,0,0,.5);
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
  border-radius: 10px;
}
.square form a{
    position: relative;
    display: inline-flexbox;
    padding: 20px 20px;
    color: #f8edeb;
    font-size: 16px;
    text-decoration: none;
    text-transform: uppercase;
    /* overflow: hidden; */
    /* transition: .5s; */
    margin-top: 40px;
    letter-spacing: 4px
}

.square a:hover {
  background: #f8edeb;
  color: #494e5b;
  border-radius: 5px;
  box-shadow: 0 0 5px #f8edeb,
              0 0 25px #f8edeb,
              0 0 50px #f8edeb,
              0 0 100px #f8edeb;
}

.square a span {
  position: absolute;
  display: block;
  /* justify-content: center; */
}
.square a span:nth-child(1) {
  top: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, transparent, #f8edeb);
  animation: btn-anim1 1s linear infinite;
}

@keyframes btn-anim1 {
  0% {
    left: -100%;
  }
  50%,100% {
    left: 100%;
  }
}

 .square a span:nth-child(2) {
  top: -100%;
  right: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(180deg, transparent, #f8edeb);
  animation: btn-anim2 1s linear infinite;
  animation-delay: .25s
} 

@keyframes btn-anim2 {
  0% {
    top: -100%;
  }
  50%,100% {
    top: 100%;
  }
}

.square a span:nth-child(3) {
  bottom: 0;
  right: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(270deg, transparent, #f8edeb);
  animation: btn-anim3 1s linear infinite;
  animation-delay: .5s
}

@keyframes btn-anim3 {
  0% {
    right: -100%;
  }
  50%,100% {
    right: 100%;
  }
}

.square a span:nth-child(4) {
  bottom: -100%;
  left: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(360deg, transparent, #f8edeb);
  animation: btn-anim4 1s linear infinite;
  animation-delay: .75s
}

@keyframes btn-anim4 {
  0% {
    bottom: -100%;
  }
  50%,100% {
    bottom: 100%;
  }
}

.fontchange {
  color: #b29c8f;

}

.paragraph {
  text-align: justify;
}

.line {
  padding: 5% 0 5% 0%; 
  font-family: 'Hurricane', cursive; 
  font-weight: 100;
  font-size: 100em;
    color: #b29c8f;

}


/* ----------------------------SLIDE BAR----------------------- */


h2{
  text-align:center;
  padding: 20px;
  color: #b29c8f;
}

.slick-prev, .slick-next {
  position: absolute;
  top: 135%;
  font-size: 1.8rem;
}

.slick-prev {
  left: 0;
}

.slick-next {
  right: 0;
}

.slick-slider {
  position: relative;
  display: block;
  box-sizing: border-box;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
      user-select: none;
  -webkit-touch-callout: none;
  -khtml-user-select: none;
  -ms-touch-action: pan-y;
      touch-action: pan-y;
  -webkit-tap-highlight-color: transparent;
}

.slick-list {
  position: relative;
  display: block;
  overflow: hidden;
  margin: 0;
  padding: 0;
}

.slick-list:focus {
  outline: none;
}

.slick-list.dragging {
  cursor: pointer;
  cursor: hand;
}

.slick-slider .slick-track,
.slick-slider .slick-list {
    -webkit-transform: translate3d(0, 0, 0);
       -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
         -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
}

.slick-track {
    position: relative;
    top: 0;
    left: 0;
    display: block;
}

.slick-track:before,
.slick-track:after {
    display: table;
    content: '';
}

.slick-track:after {
    clear: both;
}

.slick-loading .slick-track {
    visibility: hidden;
}

.slick-slide {
    display: none;
    float: left;
    height: 100%;
    min-height: 1px;
}

[dir='rtl'] .slick-slide {
    float: right;
}

.slick-slide img {
    display: block;
}

.slick-slide.slick-loading img {
    display: none;
}

.slick-slide.dragging img {
    pointer-events: none;
}
.slick-initialized .slick-slide {
    display: block;
}
.slick-loading .slick-slide {
    visibility: hidden;
}
.slick-vertical .slick-slide {
    display: block;
    height: auto;
    border: 1px solid transparent;
}

.slick-arrow.slick-hidden {
    display: none;
}

.slide {
    transition: filter .4s;
    margin: 0px 40px;
}

.fas {
    color: #b29c8f;
}
.slick-prev {
    left: 0;
}
.slick-prev, .slick-next {
    position: absolute;
    top: 35%;
    font-size: 1.8rem;
}

.section {
  max-width: 1200px;
  margin: 0 auto;
}

.outline {
  padding-bottom: 5%;
}

/* ------------------------------FORM--------------------------- */

* {
  box-sizing: border-box;
}


.formbox {
  padding: 16px;
  background-color: #b29c8f;
  border-radius: 2%;
  opacity: 9;
 
} 

.formfont {
font-family: sans-serif;
font-weight: 10;
font-size: x-large;

}

input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f8edeb;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

.submit {
  background-color: #243b55;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
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


<section>


    <div style="padding: 0%;" class="hero container">
        <h1 class="top-left"></h1>
    </div>

    <div class="square">
        <form>
            <a href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Be our partners
            </a>
        </form>
    </div>
    <br>

    <section>
        <h2>Re-imagining how the web works</h2>
    </section>

    </div>

    <section style="padding: 3% 13% 2% 5%;">
        <div class="row align-items-center content">
            <div class="col-md-6 text-center">
                <div class="row justify-content-center">
                    <div class="col-10 col-lg-8 blurb mb-5 mb-md-0 fontchange">
                        <h2>Transform your business digitally and unlock it's full potential</h2>
                        <img src="imgs/lolli_icon.png" alt="" class="d-none d-lg-inline">
                        <p class="lead paragraph">From desinging to deploying, we offer comprehensive range of full
                            stack
                            development tailored to our client’s business.
                            With the help of advanced techologies, we help you to expand your horizons in your field of
                            work.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img src="https://images.pexels.com/photos/7688164/pexels-photo-7688164.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                    alt="" class="img-fluid">
            </div>
        </div>
    </section>
    <br><br>


    <!-- <h2>Our Clients</h2>
    <section class="trigger section gutter-horizontal bg-gray gutter-vertical--m gutter-horizontal outline">
        <div class="customer-logos slider">
            <div class="slide-in-right slide"><img
                    src="https://th.bing.com/th/id/OIP.e0WkjofvUMmsYRMDtud4NgHaCH?pid=ImgDet&rs=1"
                    alt="Kinderhotel Aschauerhof" height="150" width="150"></a></div>
            <div class="slide-in-right slide"><img
                    src="https://t3.ftcdn.net/jpg/00/97/16/98/500_F_97169893_o9dpYDfiYgxcI8OiAK377MrAdVwjomiS.jpg"
                    height="150" width="150"></a></div>
            <div class="slide-in-right slide"><img
                    src="https://images.yourstory.com/cs/images/companies/logo-1586419567684.jpg?fm=png&auto=format&w=400&h=400&fit=fill&fill=solid"
                    height="150" width="150"></a></div>
    </section> -->

    <div class="container">
        <form action="">
            <div class="container formbox">
                <h1 class="formfont">Join hands to make a difference</h1>
                <p class="formfont">Please fill in this form to create an account.</p>
                <hr>

                <label class="formfont" for="org"><b>Organization Details</b></label>
                <input type="text" placeholder="Registered entity name" name="Details" required>

                <input type="text" placeholder="Registered Address" name="Details" required>

                <label class="formfont" for="contact"><b>Primary contact</b></label>
                <input type="text" placeholder="Full name" name="name" required>
                <input type="text" placeholder="Email id" name="email" required>
                <hr>
                <button type="submit" class="submit">Submit</button>
            </div>

        </form>
    </div>
    <br><br>


    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script type="text/javascript" src="frontend.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</section>