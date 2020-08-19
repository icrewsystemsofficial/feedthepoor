@extends('layouts.layouts')

@section('content')
<style media="screen">

  .volunteer_para{
    font-size: 1.05rem;
    }

    .volunteer_form h3{
      font-size: 2rem;
      }

  .form{
    background-color: #fbf7f7;
    padding: 10%;
    border-radius: 5%;

  }

  .ability{
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
                        <p class="volunteer_para">
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

<section>
  <div class="container">
    <div  class="volunteer_form">
      <h3>Want to serve as a Volunteer?</h3>
      <p>why are you waiting for let's join together and end the hunger.</p>
    </div>

    <div class="form">
       <form>
         <div class="col-md-4 mb-3">
           <div class="form-row">
              <input type="text" class="form-control is-valid" id="validationServer01" placeholder="First name" value="First Name" required>
              <label for="validationServer01">First name</label>
           </div>
            <div class="col-md-4 mb-3">
               <label for="validationServer02">Last name</label>
               <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Last name" value="Last Name" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationServer02">Date of Birth</label>
                <input type="date" class="form-control is-valid" id="validationServer02" name="birthday">
            </div>
          </div><br>
            <div class="form-row">
               <div class="col-md-6 mb-3">
                 <label for="validationServer03">City</label>
                 <input type="text" class="form-control is-valid" id="validationServer03" placeholder="City" required>
                </div><br>
               <div class="col-md-3 mb-3">
                 <label for="validationServer04">State</label>
                 <input type="text" class="form-control is-valid" id="validationServer04" placeholder="State" required>
               </div><br>
               <div class="col-md-3 mb-3">
                 <label for="validationServer05">Zip</label>
                 <input type="text" class="form-control is-valid" id="validationServer05" placeholder="Zip" required>
                </div>
            </div><br>
<div class="form-row">
<div class="col-lg-9 mb-3">
<label for="validationServer05">Current institution</label>
<input type="text" value="" autocomplete="on" class="form-control is-valid" id="validationServer05" placeholder="Current Institutuion or Organization">
</div>
</div><br>
<div class="form-row">
<div class="col-lg-4 mb-3">
<label for="validationServer05">Contact Number</label>
<input type="text" value="" autocomplete="on" class="form-control is-valid" id="validationServer05" placeholder="Contact Number">
</div>

<div class="col-lg-4 mb-3">
<label for="validationServer05">Email id</label>
<input type="text" value="" autocomplete="on" class="form-control is-valid" id="validationServer05" placeholder="email id">
</div>
</div><br>

<div class="ability">
<div class="form-row">
<label for="validationServer05">How often will you be able to help?</label>
<div class="col-lg-12 mb-6"><br>

<input type="radio" value=""  placeholder="I can lead initiatives">
<label for="validationServer05">I can lead initiatives</label>
</div>
<div class="col-lg-12 mb-6">
<input type="radio" value=""  placeholder="I can lead initiatives">
<label for="validationServer05">Multiple Days in a week</label>
</div>
<div class="col-lg-12 mb-6">
<input type="radio" value=""  placeholder="I can lead initiatives">
<label for="validationServer05">Once a week</label>
</div>
<div class="col-lg-12 mb-6">
<input type="radio" value=""  placeholder="I can lead initiatives">
<label for="validationServer05">Twice a month</label>
</div>

</div>
</div>
<br><br>
<button class="btn btn-primary" type="submit">Submit form</button>
</form>
</div>
</div>
</section><br><br>

<section class="slice-lg">
       <div class="container">
         <div class="row py-5 align-items-center cols-xs-space cols-sm-space cols-md-space">
           <div class="col-lg-6">
             <div class="d-flex align-items-start">
               <div class="icon-text">
                 <h3 class="heading">
                   Whoopsie!
                 </h3>
                 <p>
                   This page is still under development. Check back later.
                   <br /><br /><br />
                   <a href="{{ url('/') }}" class="btn btn-sm btn-danger">Go home</a>
                 </p>
               </div>
             </div>
           </div>

           <div class="col-md-6">
             <img src="https://cdn.dribbble.com/users/10549/screenshots/3062682/build.png" class="img-center img-fluid rounded z-depth-3"/>
           </div>

          </div>
       </div>
   </section>
@endsection
