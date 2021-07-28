@section('meta')
<title>
        Partners | FeedThePoor - Donate money confidently and Transparently
    </title>
@endsection
@section('title')
@endsection
@section('css')
<style media="screen">
        .partners_para {
            font-size: 1.05rem;
        }
        .partners-cover {
            /*background-image: url("https://media.discordapp.net/attachments/530789778912837640/725054207295619123/bg2-min.png");*/
            background-image: url("https://cdn.discordapp.com/attachments/694578470772146237/744471075697721454/icrew_feeding_india_3.jpg");
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .partners {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
        }
        h1 {
            font-size: 25px;
            text-align: left;
            text-transform: capitalize;
        }
        .service-box {
            position: relative;
            overflow: hidden;
            margin-bottom: 10px;
            perspective: 1000px;
            -webkit-perspective: 1000px;
        }
        .service-icon {
            width: 100%;
            height: 220px;
            padding: 20px;
            text-align: center;
            transition: all .5s ease;
        }
        .service-content {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            opacity: 0;
            width: 100%;
            height: 220px;
            padding: 20px;
            text-align: center;
            transition: all .5s ease;
            background-color: #474747;
            backface-visibility: hidden;
            transform-style: preserve-3d;
            -webkit-transform: translateY(110px) rotateX(-90deg);
            -moz-transform: translateY(110px) rotateX(-90deg);
            -ms-transform: translateY(110px) rotateX(-90deg);
            -o-transform: translateY(110px) rotateX(-90deg);
            transform: translateY(110px) rotateX(-90deg);
        }
        .service-box .service-icon .front-content {
            position: relative;
            top: 80px;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
        }
        .service-box .service-icon .front-content {
            font-size: 28px;
            color: #fff;
            font-weight: normal;
        }
        .service-box .service-icon .front-content img {
            width: auto;
            height: auto;
        }
        .service-box .service-icon .front-content h3 {
            font-size: 15px;
            color: #fff;
            text-align: center;
            margin-bottom: 15px;
        }
        .service-box .service-content h3 {
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 10px;
        }
        .service-box .service-content p {
            font-size: 13px;
            color: #b1b1b1;
            margin: 0;
        }
        .red {
            background-color: #e84b3a;
        }
        .grey {
            background-color: #474747;
        }
        .service-box:hover .service-icon {
            opacity: 0;
            -webkit-transform: translateY(-110px) rotateX(90deg);
            -moz-transform: translateY(-110px) rotateX(90deg);
            -ms-transform: translateY(-110px) rotateX(90deg);
            -o-transform: translateY(-110px) rotateX(90deg);
            transform: translateY(-110px) rotateX(90deg);
        }
        .service-box:hover .service-content {
            opacity: 1;
            -webkit-transform: rotateX(0);
            -moz-transform: rotateX(0);
            -ms-transform: rotateX(0);
            -o-transform: rotateX(0);
            transform: rotateX(0);
        }
    </style>
@endsection
@section('content')
<main class="main">

<section class="slice slice-xl">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-12">
                <p class="lead mt-3 lh-180 animated" data-animation-in="fadeInUp" data-animation-delay="2500">
                    <span style="font-size: 2.2rem;">
                        <strong>#feedThePoor</strong>
                        is possible, because of them.
                    </span> <br>
                    The pioneers, who trusted in our vision and provided a platform to inspire the masses.
                </p>
            </div>
        </div>
    </div>
</section>
<section class="py-5 bg-lighter border-top border-bottom" id="scrollToSection">
    <div class="container">
        <div class="d-flex align-items-center justify-content-center">
            <a href="#" class="btn btn-danger btn-icon-only btn-zoom--hover rounded-circle">
                <span class="btn-inner--icon">
                    <svg class="svg-inline--fa fa-heart fa-w-18" aria-hidden="true" data-prefix="fas"
                        data-icon="heart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                        data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M414.9 24C361.8 24 312 65.7 288 89.3 264 65.7 214.2 24 161.1 24 70.3 24 16 76.9 16 165.5c0 72.6 66.8 133.3 69.2 135.4l187 180.8c8.8 8.5 22.8 8.5 31.6 0l186.7-180.2c2.7-2.7 69.5-63.5 69.5-136C560 76.9 505.7 24 414.9 24z">
                        </path>
                    </svg><!-- <i class="fas fa-heart"></i> -->
                </span>
            </a>
            <span class="heading h4 ml-3 mb-0">We exist, because of their love</span>
        </div>
    </div>
</section>


<style media="screen">
</style>

<section class="slice-lg">
    <div class="container">
        <h1 class="partners">Our Partners</h1><br><br>

        <div class="row">
            <div class="col-lg-5 col-sm1-6 ">
                <div class="service-box">
                    <div class="service-icon yellow">
                        <div class="front-content">
                            <img style="width: 60%" src="https://icrewsystems.com/logo.png">
                        </div>
                    </div>
                    <div class="service-content bg-tertiary">
                        <h3>icrewsystems</h3>
                        <p> A global web development company which is re-imagining the way web works.<br>
                            <br>Located in Chennai, India.<br><br> Sponsored the entire IT infrastructure.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-6 offset-lg-2">
                <div class="service-box">
                    <div class="service-icon">
                        <div class="front-content ">
                            <img style="width: 60%"
                                src="https://gem-hosting.com/Assets/img/logos/V4/Logo-Version-4-1500x360.png"
                                width="10px">
                        </div>
                    </div>
                    <div class="service-content bg-tertiary">
                        <h3>Gem Hosting</h3>
                        <p>A web hosting company. <br><br>Located in London, United Kingdom. <br><br> Sponsored Web
                            Hosting</p>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <section class="py-xl">
        <!-- <span class="mask bg-primary alpha-6"></span> -->
        <div class="container d-flex align-items-center no-padding">
            <div class="col">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-tertiary text-white">
                            <div class="card-body">
                                <h2 class="heading pt-3 pb-2 text-white">
                                    Want to help as a Partner?<br>
                                </h2>
                                <p class="mb-5">
                                    why are you waiting for let's join together and end the hunger.
                                </p>
                                <div class="form">
                                    <form method="POST"
                                        action="https://testing.icrewsystems.com/feedthepoor-legacy/partnerssuccess">
                                        <div class="form-row">
                                            <input type="hidden" name="_token"
                                                value="vj1oGdlKTqM6wcJRfEyaWfKReB5RRj1ibO26NjkC">
                                            <div class="col-md-12 mb-3">
                                                <label for="validationServer01">Organisation Details</label>
                                                <input type="text" class="form-control" id="validationServer01"
                                                    placeholder="Organisation Name" name="organisation_name"
                                                    required="">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="validationServer01">Organisation Address</label>
                                                <input type="text" class="form-control" id="validationServer01"
                                                    placeholder="Organisation Address" name="organisation_address"
                                                    required="">
                                            </div>
                                        </div><br>
                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="validationServer04">State</label>
                                                <input type="text" class="form-control " id="validationServer04"
                                                    placeholder="State" name="state" required="">
                                            </div><br>
                                            <div class="col-md-6 mb-3">
                                                <label for="validationServer03">City</label>
                                                <input type="text" class="form-control " id="validationServer03"
                                                    placeholder="City" name="city" required="">
                                            </div><br>
                                            <div class="col-md-3 mb-3">
                                                <label for="validationServer05">Zip</label>
                                                <input type="text" class="form-control " id="validationServer05"
                                                    placeholder="Zip" name="zip" required="">
                                            </div>
                                        </div><br>
                                        <div class="form-row">
                                            <div class="col-lg-12 mb-3">
                                                <label for="validationServer05">Primary Contact</label>
                                                <input type="text" value="" autocomplete="on" class="form-control "
                                                    id="validationServer05" name="name" placeholder="Name">
                                            </div>
                                        </div><br>
                                        <div class="form-row">
                                            <div class="col-lg-6 mb-3">
                                                <label for="validationServer05">Contact Number</label>
                                                <input type="text" value="" autocomplete="on" class="form-control "
                                                    id="validationServer05" name="contact"
                                                    placeholder="Contact Number">
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label for="validationServer05">Email id</label>
                                                <input type="text" value="" autocomplete="on" class="form-control "
                                                    id="validationServer05" name="email" placeholder="Email ID">
                                            </div>
                                        </div><br>

                                        <div class="form-row">
                                            <div class="col-lg-12 mb-3">
                                                <label for="validationServer05">Comments down which you like us to
                                                    know! </label>
                                                <textarea type="text" value="" rows="8" cols="120" autocomplete="on"
                                                    class="form-control " id="validationServer05" name="comments"
                                                    placeholder="Your Comments ......"></textarea>
                                            </div>
                                        </div><br>
                                        <br><br>
                                        <button class="btn btn-primary" type="submit">Submit form</button>
                                        &nbsp;&nbsp;&nbsp;
                                        <button class="btn btn-warning" type="reset">Reset</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


</section>
</main>
@endsection
@section('js')
<script>
        var notify = {
            timeout: "5000",
            animatedIn: "bounceInRight",
            animatedOut: "bounceOutRight",
            position: "bottom-right"
        }
    </script>
@endsection