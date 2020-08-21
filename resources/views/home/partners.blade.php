@extends('layouts.layouts')

@section('content')
<style media="screen">

  .partners_para{
    font-size: 1.05rem;
    }

</style>
<section class="spotlight C-parallax bg-cover bg-size--cover" data-spotlight="fullscreen">
    <span class="mask bg-tertiary alpha-5"></span>
    <div class="spotlight-holder py-lg pt-lg-xl">
        <div class="container d-flex align-items-center no-padding">
            <div class="col">
                <div class="row cols-xs-space align-items-center text-center text-md-left justify-content-start">
                    <div class="col-7">
                        <div class="text-left mt-5">
                            <img src="https://cdn.discordapp.com/attachments/530789778912837640/691801343723307068/1585008642050.png"
                                style="width: 200px;" class="img-fluid animated" data-animation-in="jackInTheBox"
                                data-animation-delay="1000">

                            <!-- <h2 class="heading display-4 font-weight-400 text-white mt-5 animated" data-animation-in="fadeInUp" data-animation-delay="2000">
                <span class="font-weight-700">812</span> hungry mouths fed today
              </h2> -->
                            <p class="lead text-white mt-3 lh-180 c-white animated" data-animation-in="fadeInUp"
                                data-animation-delay="2500">
                                <span style="font-size: 2.2rem;"><strong>#BeAPartner</strong> and Serve.</span> <br />
                                "Feeding the hungry is greater work than raising the dead"
</p>
                        </div>
                    </div>
                </div>
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
                            With your support, we make India No Hunger.
                        </h1>
                        <p class="partners_para">
                            <!-- India is home to the largest undernourished population in the world
                            <ul>
                                <li>194.4 million people i.e. 14.5% of our population is undernourished</li>
                                <li>20.8% of children under 5 are underweight</li>
                                <li>37.9% of children under 5 years of age are stunted</li>
                                <li>51.4% women in the reproductive age (15-49 years) are anaemic</li>
                            </ul>

                            <small>source <a href="https://www.indiafoodbanking.org/hunger"
                                    target="_blank">indiafoodbanking.org</a></small> -->

                                    When you partner with us - you amplify the efforts of our network of 26,700 volunteers, stand by your brand, and create a sustainable impact on communities supported by us.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-2">
                <div class="block block-image">
                    <img style="height: auto; width: 90%;"
                        src="https://cdn.discordapp.com/attachments/530789778912837640/745470613249851512/happy.png"
                        class="img-center img-fluid rounded z-depth-3" alt="">
                </div>
            </div>
        </div>
    </div>
</section><br><br>

<style media="screen">

.partners{
  text-align: center;
  font-size: 2rem;
  font-weight: bold;
}
h1{
             font-size:25px;
             text-align: left;
             text-transform:capitalize;
         }
        .service-box{
            position: relative;
            overflow: hidden;
            margin-bottom:10px;
            perspective:1000px;
            -webkit-perspective:1000px;
        }
        .service-icon{
            width: 100%;
            height: 220px;
            padding: 20px;
            text-align: center;
            transition: all .5s ease;
        }

        .service-content{
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
            backface-visibility:hidden;
            transform-style: preserve-3d;
            -webkit-transform: translateY(110px) rotateX(-90deg);
            -moz-transform: translateY(110px) rotateX(-90deg);
            -ms-transform: translateY(110px) rotateX(-90deg);
            -o-transform: translateY(110px) rotateX(-90deg);
            transform: translateY(110px) rotateX(-90deg);
        }
        .service-box .service-icon .front-content{
            position: relative;
            top:80px;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .service-box .service-icon .front-content  {
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
            margin-bottom:10px;
        }
        .service-box .service-content p {
            font-size: 13px;
            color: #b1b1b1;
            margin:0;
        }
        .red{background-color: #e84b3a;}
        .grey{background-color: #474747;}
        .service-box:hover .service-icon{
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
               <p> A global web development company which is re-imagining the way web works.<br> <br>Located in Chennai, India.<br><br> Sponsored the entire IT infrastructure.</p>
           </div>
       </div>
   </div>
   <div class="col-lg-5 col-sm-6 offset-lg-2">
       <div class="service-box">
           <div class="service-icon">
               <div class="front-content ">
                   <img style="width: 60%" src="https://gem-hosting.com/Assets/img/logos/V4/Logo-Version-4-1500x360.png" width="10px">
               </div>
           </div>
           <div class="service-content bg-tertiary">
               <h3>Gem Hosting</h3>
               <p>Gem Hosting: UK, Sponsored Web Hosting</p>
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
                            Want to help as a Partner?<br />
                          </h2>
                          <p class="mb-5">
                            why are you waiting for let's join together and end the hunger.
                          </p>
    <div class="form">
    <form method="POST" action="{{ url('/partnerssuccess') }}">
<div class="form-row">
{{ csrf_field() }}
<div class="col-md-12 mb-3">
  <label for="validationServer01">Organisation Details</label>
  <input type="text" class="form-control" id="validationServer01" placeholder="Organisation Name" name="organisation_name" required>
</div>
<div class="col-md-12 mb-3">
  <label for="validationServer01">Organisation Address</label>
  <input type="text" class="form-control" id="validationServer01" placeholder="Organisation Address" name="organisation_address" required>
</div>
</div><br>
<div class="form-row">
<div class="col-md-3 mb-3">
  <label for="validationServer04">State</label>
  <input type="text" class="form-control " id="validationServer04" placeholder="State" name="state" required>
</div><br>
<div class="col-md-6 mb-3">
  <label for="validationServer03">City</label>
  <input type="text" class="form-control " id="validationServer03" placeholder="City" name="city" required>
</div><br>
<div class="col-md-3 mb-3">
  <label for="validationServer05">Zip</label>
  <input type="text" class="form-control " id="validationServer05" placeholder="Zip" name="zip" required>
</div>
</div><br>
<div class="form-row">
<div class="col-lg-12 mb-3">
  <label for="validationServer05">Primary Contact</label>
  <input type="text" value="" autocomplete="on" class="form-control " id="validationServer05" name="name" placeholder="Name">
</div>
</div><br>
<div class="form-row">
<div class="col-lg-6 mb-3">
<label for="validationServer05">Contact Number</label>
<input type="text" value="" autocomplete="on" class="form-control " id="validationServer05" name="contact" placeholder="Contact Number">
</div>

<div class="col-lg-6 mb-3">
<label for="validationServer05">Email id</label>
<input type="text" value="" autocomplete="on" class="form-control " id="validationServer05" name="email" placeholder="Email ID">
</div>
</div><br>

<div class="form-row">
<div class="col-lg-12 mb-3">
<label for="validationServer05">Comments down which you like us to know! </label>
<textarea type="text" value="" rows="8" cols="120" autocomplete="on" class="form-control " id="validationServer05" name="comments" placeholder="Your Comments ......"></textarea>
</div>
</div><br>
<br><br>
<button class="btn btn-primary" type="submit">Submit form</button> &nbsp;&nbsp;&nbsp;
<button class="btn btn-warning" type="reset">Reset</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<div class="slice stripe bg-primary">
      <div class="container">
        <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space text-center text-lg-left">
          <div class="col-lg-7">
            <h1 class="heading h2 text-white strong-500">
                We have a suggestion driven FAQ section, your question might have already been answered.
            </h1>
            <p class="lead text-white mb-0"></p>
          </div>
          <div class="col-lg-3 ml-lg-auto">
            <div class="text-center text-md-right">
              <a href="https://icrewsystems.com/portal/index.php/tickets" class="btn bg-secondary">
                Get in touch
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
