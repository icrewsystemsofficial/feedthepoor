@extends('layouts.frontend.app')

@section('meta')
    <title>
        Volunteers | FeedThePoor - Donate money confidently and Transparently
    </title>
@endsection

@section('css')
    <style media="screen">
        .vol a,
        .vol a:hover,
        .vol a:focus,
        .vol a:active {
            text-decoration: none;
            outline: none;
        }

        .vol ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .vol .site-heading h2 {
            display: block;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .vol .site-heading h2 span {
            color: #192b3f;
        }

        .vol .site-heading h4 {
            display: inline-block;
            padding-bottom: 20px;
            position: relative;
            text-transform: capitalize;
            z-index: 1;
        }

        .vol .site-heading h4::before {
            background: #3b70d9 none repeat scroll 0 0;
            bottom: 0;
            content: "";
            height: 2px;
            left: 50%;
            margin-left: -25px;
            position: absolute;
            width: 50px;
        }

        .vol .site-heading h2 span {
            color: #3b70d9;
        }

        .vol .site-heading {
            margin-bottom: 60px;
            overflow: hidden;
            margin-top: -5px;
        }

        .vol .team-area .single-item {
            margin-bottom: 30px;
        }

        .vol .team-area .item .thumb {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .vol .team-area .item .thumb::after {
            background: #192b3f none repeat scroll 0 0;
            content: "";
            height: 100%;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            transition: all 0.35s ease-in-out;
            -webkit-transition: all 0.35s ease-in-out;
            -moz-transition: all 0.35s ease-in-out;
            -ms-transition: all 0.35s ease-in-out;
            -o-transition: all 0.35s ease-in-out;
            width: 100%;
        }

        .vol .team-area .team-items .item:hover .thumb::after {
            opacity: 0.7;
        }

        .vol .team-area .item .thumb .overlay {
            top: -100%;
            left: 0;
            padding: 20px;
            position: absolute;
            text-align: center;
            -webkit-transition: all 0.35s ease-in-out;
            -moz-transition: all 0.35s ease-in-out;
            -ms-transition: all 0.35s ease-in-out;
            -o-transition: all 0.35s ease-in-out;
            transition: all 0.35s ease-in-out;
            width: 100%;
            z-index: 1;
        }

        .vol .team-area .item:hover .thumb .overlay {
            top: 50%;
            transform: translate(-50%, -50%);
            left: 50%;
        }

        .vol .team-area .item .thumb .overlay p {
            color: #ffffff;
        }

        .vol .team-area .item .thumb .overlay h4 {
            color: #ffffff;
            display: inline-block;
            position: relative;
            text-transform: uppercase;
        }

        .vol .team-area .item .thumb img {
            -webkit-transition: all 0.35s ease-in-out;
            -moz-transition: all 0.35s ease-in-out;
            -ms-transition: all 0.35s ease-in-out;
            -o-transition: all 0.35s ease-in-out;
            transition: all 0.35s ease-in-out;
        }

        .vol .team-area .item:hover .thumb img {
            opacity: .6;
        }

        .vol .team-area .item .thumb .social li {
            display: inline-block;
        }

        .vol .team-area .item .thumb .social li a {
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            color: #ffffff;
            display: inline-block;
            height: 40px;
            line-height: 40px;
            margin: 0 2px;
            text-align: center;
            width: 40px;
        }

        .vol .team-area .info {
            background: #ffffff none repeat scroll 0 0;
            -moz-box-shadow: 0 0 10px #cccccc;
            -webkit-box-shadow: 0 0 10px #cccccc;
            -o-box-shadow: 0 0 10px #cccccc;
            box-shadow: 0 0 10px #cccccc;
            padding: 40px 20px 20px;
            position: relative;
            text-align: center;
            z-index: 9;
        }

        .vol .team-area .info .message {
            height: 50px;
            line-height: 40px;
            margin-left: -25px;
            margin-top: -25px;
            position: absolute;
            text-align: center;
            top: 0;
            width: 50px;
        }

        .vol .team-area .info .message a {
            background: #fff none repeat scroll 0 0;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            -moz-box-shadow: 0 0 10px #cccccc;
            -webkit-box-shadow: 0 0 10px #cccccc;
            -o-box-shadow: 0 0 10px #cccccc;
            box-shadow: 0 0 10px #cccccc;
            box-sizing: border-box;
            color: #192b3f;
            display: inline-block;
            font-size: 20px;
            height: 50px;
            line-height: 50px;
            width: 50px;
        }

        .vol .team-area .info .message a i {
            font-weight: 500;
        }

        .vol .team-area .info h4 {
            font-weight: 600;
            margin-bottom: 5px;
            text-transform: capitalize;
        }

        .vol .team-area .info span {
            color: #3b70d9;
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            text-transform: uppercase;
        }

        .vol .team-area .social li.twitter a {
            background-color: #3b5998;
        }

        .vol .team-area .social li.pinterest a {
            background-color: #3f729b;
        }

        .vol .team-area .social li.facebook a {
            background-color: #3b5998;
        }

        .vol .team-area .social li.google-plus a {
            background-color: #df4a32;
        }

        .vol .team-area .social li.vimeo a {
            background-color: #1ab7ea;
        }

        .vol .team-area .social li.instagram a {
            background-color: #0e76a8;
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

    </script>
@endsection

@section('content')
    <main class="main">
        <section class="slice slice-xl bg-secondary">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-12">
                        <p class="lead mt-3 lh-180 animated" data-animation-in="fadeInUp" data-animation-delay="2500">
                            <span style="font-size: 2.2rem;"> Be a hunger hero with
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
                                <!-- Empty Div Class -->
                                <h1>
                                    Join your hands to get end the Hunger in India.
                                </h1>
                                <p class="volunteer_para">
                                    Join our volunteer team of friends, leaders, neighbours and working professionals across
                                    India who work towards building communities where hunger doesn't come in the way of a
                                    brighter future.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 offset-lg-2">
                        <div class="block block-image">
                            <img style="height: auto; width: 90%;"
                                src="https://cdn.discordapp.com/attachments/694578470772146237/744474193516822590/icrew_7.jpg"
                                class="img-center img-fluid rounded z-depth-3" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section><br>

        <div class="vol">
            <style type="text/css">

            </style>
            <section id="team" class="team-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="site-heading text-center">
                                <h2>Our <span>Volunteers</span></h2>
                                <h4>Meet our awesome volunteers</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row team-items">
                    </div>
                </div>
            </section>
        </div>

        <br>

        <section class="py-xl">
            <!-- <span class="mask bg-primary alpha-6"></span> -->
            <div class="container d-flex align-items-center p-20">
                <div class="col">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-tertiary text-white">
                                <div class="card-body">
                                    <h2 class="heading pt-3 pb-2 text-white">
                                        Want to serve as a Volunteer?<br>
                                    </h2>
                                    <p class="mb-5">
                                        why are you waiting for let's join together and end the hunger.
                                    </p>

                                    <form method="POST"
                                        action="https://testing.icrewsystems.com/feedthepoor-legacy/volunteerssuccess">
                                        <div class="form-row">
                                            <input type="hidden" name="_token"
                                                value="vj1oGdlKTqM6wcJRfEyaWfKReB5RRj1ibO26NjkC">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationServer01">First name</label>
                                                <input type="text" class="form-control " id="validationServer01"
                                                    placeholder="What do we call you?" name="first_name" required="">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationServer02">Last name</label>
                                                <input type="text" class="form-control " id="validationServer02"
                                                    placeholder="Have a nick name?" name="last_name" required="">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationServer02">Date of Birth</label>
                                                <input type="date" class="form-control " id="validationServer02" name="DOB">
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
                                            <div class="col-lg-9 mb-3">
                                                <label for="validationServer05">Current institution</label>
                                                <input type="text" value="" autocomplete="on" class="form-control "
                                                    id="validationServer05" name="current_institution"
                                                    placeholder="Current Institutuion or Organization">
                                            </div>
                                        </div><br>
                                        <div class="form-row">
                                            <div class="col-lg-6 mb-3">
                                                <label for="validationServer05">Contact Number</label>
                                                <input type="text" value="" autocomplete="on" class="form-control "
                                                    id="validationServer05" name="contact" placeholder="Contact Number">
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label for="validationServer05">Email id</label>
                                                <input type="text" value="" autocomplete="on" class="form-control "
                                                    id="validationServer05" name="email" placeholder="email id">
                                            </div>
                                        </div><br>


                                        <div class="form-row">
                                            <div class="col-lg-12 mb-3">
                                                <textarea name="comments" rows="8" cols="85" class="form-control"
                                                    placeholder="Mention any previous experiences"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="ability">
                                    <div class="form-row ml-5">
                                        <label for="validationServer05">How often will you be able to help?</label>
                                        <div class="col-lg-12 mb-6 ml-5"><br>

                                            <input type="radio" value="can lead initiatives">
                                            <label for="validationServer05">I can lead initiatives</label>
                                        </div>
                                        <div class="col-lg-12 mb-6 ml-5">
                                            <input type="radio" id="multiple days" value="multiples days in a week">
                                            <label for="validationServer05">Multiple Days in a week</label>
                                        </div>
                                        <div class="col-lg-12 mb-6 ml-5">
                                            <input type="radio" value="once a week">
                                            <label for="validationServer05">Once a week</label>
                                        </div>
                                        <div class="col-lg-12 mb-6 ml-5">
                                            <input type="radio" value="twice a month">
                                            <label for="validationServer05">Twice a month</label>
                                        </div><br><br>


                                        <button class="btn btn-primary" type="submit">Submit form</button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <button class="btn btn-warning" type="reset">Reset</button>

                                    </div><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>





        </section><br><br>

    </main>
@endsection
