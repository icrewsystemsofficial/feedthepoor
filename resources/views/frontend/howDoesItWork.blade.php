@extends('layouts.frontend.app')

@section('meta')
    <title>
        How does it work | FeedThePoor - Donate money confidently and Transparently
    </title>
@endsection

@section('css')
    <style>
        .hero {
            text-align: center;
            padding: 5% 0 5% 0;
            margin: 0px 0px 70px 0px;
        }

        @media(min-width:1000px) {
            h4 span {
                font-size: 3rem;
            }
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
        }

    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <br><br>
    <script>
        AOS.init({
            duration: 1200,
        });


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
            if (stepper.classList.contains('step1')) {
                stepper.classList.remove('step1');
                stepper.classList.add('step2');
                toggleVisibility('step1-p');
                toggleVisibility('step2-p');
            } else if (stepper.classList.contains('step2')) {
                stepper.classList.remove('step2');
                stepper.classList.add('step3');
                toggleVisibility('step2-p');
                toggleVisibility('step3-p');
            } else if (stepper.classList.contains('step3')) {
                stepper.classList.remove('step3');
                stepper.classList.add('step1');
                toggleVisibility('step3-p');
                toggleVisibility('step1-p');
            }
        }, 5000);

    </script>
@endsection

@section('content')
    <section class="slice slice-xl bg-secondary" id="sub-head">
        <div class="container">
            <div class="row justify-content-center" style="justify-content: left">

                <div class="col-12">
                    <p class="lead mt-3 lh-180 animated" data-animation-in="fadeInUp" data-animation-delay="2500">
                        <span style="font-size: 2.2rem;">
                            How do we <strong>#feedThePoor</strong>?
                        </span> <br />
                        Wondering how we connect the changemakers to the needy?
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="slice-lg">
        <div class="container align-items-center">
            <div class="row py-5 align-items-center cols-xs-space cols-sm-space cols-md-space">
                <div class="col-md-12">
                    <div class="d-flex">
                        <div class="stepper-div">
                            <div class="step1" id="stepper">
                                <ul class="stepper">
                                    <li><span>Donate</span></li>
                                    <li><span>Feed</span></li>
                                    <li><span>Pictures</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card z-depth-3">
                        <div class="card-body">
                            <!-- <div class="">Example</div> -->

                            <div id="step1-p" class="animate__animated animate__fadeIn align-content-center"
                                style="display: block;">
                                <div class="card text-white border-0 overflow-hidden">
                                    <img class="card-img"
                                        src="https://cdn.discordapp.com/attachments/720604361310470146/771399745264418826/unknown.png"
                                        alt="Donation Image">
                                    <span class="mask bg-primary alpha-7"></span>
                                    <div class="card-img-overlay d-flex align-items-center">
                                        <div class="col-lg-8">
                                            <h3 class="heading h3 text-white">You make your donation</h3>
                                            <p class="card-text">You donate to our NGO partner via Razorpay payment gateway.
                                                The payment is automatically verified and accepted by our website. We
                                                immediately place the order for the food to donate the next day. You will
                                                recieve a recipt within the next 5 - 10 minutes.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="step2-p" class="animate__animated animate__fadeIn" style="display: none;">
                                <div class="card text-white border-0 overflow-hidden">
                                    <img class="card-img"
                                        src="https://cdn.discordapp.com/attachments/720604361310470146/771400865176485928/unknown.png"
                                        alt="Donation Image">
                                    <span class="mask bg-primary alpha-7"></span>
                                    <div class="card-img-overlay d-flex align-items-center">
                                        <div class="col-lg-8">
                                            <h3 class="heading h3 text-white">We distribute the food</h3>
                                            <p class="card-text">With the help of our Voulenteers, we distribute the food
                                                which was arranged by your donation to the underprivileged people in certain
                                                locations.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="step3-p" class="animate__animated animate__fadeIn" style="display: none;">
                                <div class="card text-white border-0 overflow-hidden">
                                    <img class="card-img"
                                        src="https://cdn.discordapp.com/attachments/720604361310470146/771401323677483058/unknown.png"
                                        alt="Donation Image">
                                    <span class="mask bg-primary alpha-7"></span>
                                    <div class="card-img-overlay d-flex align-items-center">
                                        <div class="col-lg-8">
                                            <h3 class="heading h3 text-white">You get happy pictures</h3>
                                            <p class="card-text">While we distribute the food, we take a quick moment to
                                                click a picture of your donation, along with your name with the person who
                                                is receiving it and mail it to you. We post the same
                                                on our NGO partner's instagram account. If you have provided instagram
                                                handle, we'll tag you.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="slice-lg">
        <div class="container" style="overflow: hidden">

            <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space" data-aos="fade-right">
                <div class="col-lg-6">
                    <div class="d-flex align-items-start">
                        <div class="icon-text">
                            <h3 class="heading" style="text-align: end">
                                You Donate
                            </h3>
                            <blockquote>We make a living by what we get, but we make a life by what we give.</blockquote>
                            <p style="text-align: right" class="h5">
                                All our initiatives are designed to provide essential food support to underserved
                                communities in the form of raw grains, freshly cooked food or packaged food products
                                depending on the need. Our aim is to ensure, hunger never comes in the way of a brighter
                                future.

                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up">
                    <div>
                        <img style="height: 250px; width: auto;"
                            src="https://images.pexels.com/photos/271168/pexels-photo-271168.jpeg?cs=srgb&dl=pexels-pixabay-271168.jpg&fm=jpg"
                            class="img-center img-fluid rounded z-depth-3 z-depth-3" alt="">
                    </div>
                </div>
            </div>


            <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space" data-aos="fade-left">
                <div class="col-lg-6" data-aos="fade-up">
                    <div>
                        <img style="height: 250px; width: auto;"
                            src="https://cdn.pixabay.com/photo/2018/04/11/10/00/soup-3310066_960_720.jpg"
                            class="img-center img-fluid rounded z-depth-3 z-depth-3" alt="">
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="d-flex align-items-start">
                        <div class="icon-text">
                            <h3 class="heading">
                                We Distribute
                            </h3>
                            <p class="h5">
                                While we distribute food, the smile we see is worth evey pennny in the world. But we need
                                your support to provide atleast what they deserve.

                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space" data-aos="fade-right">
                <div class="col-lg-6">
                    <div class="d-flex align-items-start">
                        <div class="icon-text">
                            <h3 class="heading" style="text-align: end">
                                They Eat, They Smile <strong id="emoji">😀</strong>
                            </h3>
                            <p style="text-align: right" class="h5">
                                Food is not a luxury but a necesary. But these children have to face more worse situation
                                just to compromise their hunger.

                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up">
                    <div>
                        <img style="height: 250px; width: auto;"
                            src="https://cdn.pixabay.com/photo/2014/04/23/14/47/children-330581_960_720.jpg"
                            class="img-center img-fluid rounded z-depth-3 z-depth-3" alt="">
                    </div>
                </div>

            </div>


            <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space" data-aos="fade-left">
                <div class="col-lg-6" data-aos="fade-up">
                    <div>
                        <img style="height: 250px; width: auto;"
                            src="https://testing.icrewsystems.com/feedthepoor-legacy/public/images/donationimages/0011241_img2.jpg"
                            class="img-center img-fluid rounded z-depth-3 z-depth-3" alt="">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="d-flex align-items-start">
                        <div class="icon-text">
                            <h3 class="heading">
                                We Share Love
                            </h3>
                            <p class="h5">
                                By donating ,by distributing and by receiving you ,us and them become a family who share
                                love.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="py-xl">

        <div class="container d-flex align-items-center no-padding">
            <div class="col">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-tertiary text-white">
                            <div class="card-body">
                                <h2 class="heading pt-3 pb-2 text-white">
                                    Not Enough? Just ask <br />
                                </h2>




                                <form method="POST"
                                    action="https://testing.icrewsystems.com/feedthepoor-legacy/requestsuccess">
                                    <div class="form-row">
                                        <input type="hidden" name="_token" value="vj1oGdlKTqM6wcJRfEyaWfKReB5RRj1ibO26NjkC">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationServer01">First name</label>
                                            <input type="text" class="form-control " id="validationServer01"
                                                placeholder="What do we call you?" name="first_name" required>
                                        </div>
                                    </div><br>
                                    <div class="form-row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="validationServer05">Contact Number</label>
                                            <input type="tel" value="" autocomplete="on" class="form-control "
                                                id="validationServer05" name="contact" placeholder="Contact Number">
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label for="validationServer05">E-mail Id</label>
                                            <input type="text" value="" autocomplete="on" class="form-control "
                                                id="validationServer05" name="email" placeholder="E-mail ID">
                                        </div>
                                    </div><br>

                                    <div class="form-row">
                                        <div class="col-lg-12 mb-3">
                                            <textarea name="comments" rows="8" cols="85" class="form-control"
                                                placeholder="Do you have something in mind? Let us know, we'll answer them"></textarea>
                                        </div>
                                    </div>



                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class="btn btn-warning" type="reset">Reset</button>


                                </form><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    </main>
@endsection
