@extends('layouts.frontend')
@section('meta')
<title>
   {{ config('app.name') }} | Donate Transparently
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection
@section('css')
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
<style>
    .about-hero-header {
        background-image:linear-gradient(rgba(28, 44, 52, 0.4), rgba(28, 44, 52, 0.4)), url(https://b.zmtcdn.com/feedingIndia/7c19381e3cea2e1113bfe0f02ae8d7671585280710.png);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 calc(100% - 8vw));
    }
    .about-hero-header .container {
        position: relative;
        top: 50%;
    }
    .about-hero-header .hero-section {
        
    }
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
    .about-method p{
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
    @media (max-width: 768px){
        .col-md-6, .methodCol {
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
    @media (max-width: 576px){
        .methodOfOp {
            padding: 0px !important;
        }
        .methodOfOp h1 span{
            font-size: 1.5rem;
        }
        .about-hero-head {
            font-size: 2rem !important;
        }
    }
    @media (min-width: 769px){
        .methodOP {
            width: 100%;
        }
    }
</style>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script defer>
    let changeMethod = (methods,targetEle) => {
        methods.forEach(method => {
            $(method).removeClass('active-method');            
        });
        targetEle.addClass('active-method');
        let target = targetEle.attr('data-target');        
        $('.opData').each((i,e) => {
            if($(e).attr('id') == target){
                $(e).removeClass('fadeOut');
                $(e).removeClass('hide');
                $(e).addClass('fadeIn');
                $(e).addClass('show');                
            }else{
                $(e).removeClass('show');
                $(e).addClass('hide');
            }
        });
    }
    let autoSwitch = (methods) => {
        let currentMethod = $('.active-method');   
        [...methods].indexOf(currentMethod[0]) == methods.length - 1 ? changeMethod(methods,$(methods[0])) : changeMethod(methods,$(methods[[...methods].indexOf(currentMethod[0]) + 1]));    
    }
    $(document).ready(() => {
        let methods = document.querySelectorAll('#methodOfOp');
        let timer = setInterval(() => {         
            autoSwitch(methods);
        }, 3000);
        methods.forEach(e => {
            $(e).on('mouseover tap',() =>{
                clearTimeout(timer);
                changeMethod(methods,$(e));
                timer = setInterval(() => {         
                    autoSwitch(methods);
                }, 3000);
            })            
        });        
    });    
</script>
@endsection


@section('content')
<section class="section section-header text-white pb-md-10 about-hero-header">
    <div class="container">
       <div class="row justify-content-between align-items-center hero-section">
            <div class="col-md-12">
                 <h1 class="about-hero-head">
                    #HungerFreeIndia
                 </h1>
            </div>            
         </div>
       </div>
    </div>
 </section>
<section class="section section-lg pt-0 mb-50">    
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="heading">
                    <h2 class="heading-title">
                        <span class="heading-title-main">
                            #whoWeAre
                        </span>
                    </h2>
                </div>
                <div class="content">
                    <p><span>#feedThePoor</span> is an initiative brought forward by Roshni Charitable Trust. We believe no-one should suffer the grief of going to sleep empty stomach. Our motive at <span>#feedThePoor</span> is to feed the underpivileged half of our nation, that is heavily affeccted by the pangs of poverty and isn't capable of earning their bread. Basically, we raise funds or collect food donated by generous hearted people and direct it to the poor. Each meal we provide, brings a smile to the face of these people, who'd otherwise have to grieve without food.</p>
                </div>
            </div>
            <div class="col-md-6 slightlyDown">
                <img src="https://cdn.discordapp.com/attachments/530789778912837640/691801343723307068/1585008642050.png" class="about-image boxShadow">
            </div>
        </div>
    </div>
</section>
<section class="section section-lg pt-0 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2 class="heading-title" style="text-align: center;">
                        <span class="heading-title-main">
                            #howWeFeed
                        </span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 methodCol" style="width: 40%">
                <img class="show feed-img opData" id="donate" src="https://cdn.discordapp.com/attachments/741259606512107602/745210919029702716/20200818_144926.jpg">
                <img class="hide feed-img opData" id="feed" src="https://cdn.discordapp.com/attachments/694578470772146237/744474193516822590/icrew_7.jpg">
                <img class="hide feed-img opData" id="feel" src="https://cdn.discordapp.com/attachments/741259606512107602/745210139396538438/20200818_144848.jpg">
            </div>
            <div class="col-md-4 methodCol" style="width: 20%;">
                <div class="row">
                    <div class="col-md-4 methodOP">
                        <div class="methodOfOp active-method" id="methodOfOp" data-target="donate">
                            <h1>
                                <span class="methodOfOp-title">
                                    Donate
                                </span>
                            </h1>
                        </div>
                    </div>
                    <div class="col-md-4 methodOP">
                        <div class="methodOfOp" id="methodOfOp" data-target="feed">
                            <h1>
                                <span class="methodOfOp-title">
                                    Feed
                                </span>
                            </h1>
                        </div>
                    </div>
                    <div class="col-md-4 methodOP">
                        <div class="methodOfOp" id="methodOfOp" data-target="feel">
                            <h1>
                                <span class="methodOfOp-title">
                                    Feel
                                </span>
                            </h1>
                        </div>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-md-12">
                        <div class="methodOfOp active-method" id="methodOfOp" data-target="donate">
                            <h1>
                                <span class="methodOfOp-title">
                                    Donate
                                </span>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="methodOfOp" id="methodOfOp" data-target="feed">
                            <h1>
                                <span class="methodOfOp-title">
                                    Feed
                                </span>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="methodOfOp" id="methodOfOp" data-target="feel">
                            <h1>
                                <span class="methodOfOp-title">
                                    Feel
                                </span>
                            </h1>
                        </div>
                    </div>
                </div>-->
            </div>
            <div class="col-md-4 methodCol" style="width: 40%;">
                <div class="about-content show about-method opData" id="donate">
                    <p>You donate to our NGO partner via Razorpay payment gateway. The payment is automatically verified and accepted by our website. We immediately place the order for the food to donate the next day. You will recieve a recipt within the next 5 - 10 minutes.</p>
                </div>
                <div class="about-content hide about-method opData" id="feed">
                    <p>With the help of our Voulenteers, we distribute the food which was arranged by your donation to the underprivileged people in certain locations.</p>
                </div>
                <div class="about-content hide about-method opData" id="feel">
                    <p>While we distribute the food, we take a quick moment to click a picture of your donation, along with your name with the person who is receiving it and mail it to you. We post the same on our NGO partner's instagram account. If you have provided instagram handle, we'll tag you.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section-lg pt-0 mb-100 aboutDonate">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-12">
                <div class="donateContent">
                    <h1 class="donateText">We’re not getting younger so together let’s fight hunger!</h1><br>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="http://127.0.0.1:8000/donate" target="_blank" class="btn btn-theme btn-zoom--hover btn-shadow--hover btn-animated btn-animated-x donate-btn">
                            <span class="btn-inner--visible">Donate Now</span>
                            <span class="btn-inner--hidden"><i class="fas fa-arrow-right"></i></span>
                        </a>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section-lg pt-0 mb-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="https://cdn.discordapp.com/attachments/741259606512107602/745210139396538438/20200818_144848.jpg">
            </div>
            <div class="col-md-6">                
                <div class="about-content">
                    <div class="heading">
                        <h2 class="heading-title">
                            <span class="heading-title-main">
                                #whereWeAre
                            </span>
                        </h2>
                    </div>
                    <p>Presently #feedThePoor is functioning in the villages of Rajasthan and several other remote villages located in the Northern states of India. With a web of over 1.5k volunteers, we are now spreading far and wide, for better accomplishment of our motive. We are being offered constant support from volunteers and donors all over India and by their support, we are able to succeed in our goal. More and more volunteers are now joining us, everyday, and becuase of that, we are now about to shift to a larger domain, and by that, we will be able to serve a larger section of the underprivileged parts of India.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection