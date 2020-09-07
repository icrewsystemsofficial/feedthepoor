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
    border-radius: 10%;

  }

  .ability{
    font-size: 1.05rem;
  }




</style>

<section class="slice slice-xl bg-secondary">
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-12">
        <p class="lead mt-3 lh-180 animated" data-animation-in="fadeInUp" data-animation-delay="2500">
        <span style="font-size: 2.2rem;">
          Be a hunger hero with
        <strong>#feedThePoor</strong>
        </span> <br />
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
                        <h1>
                            Join your hands to get end the Hunger in India.
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

                                    Join our volunteer team of friends, leaders, neighbours and working professionals across India who work towards building communities where hunger doesn't come in the way of a brighter future.
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
</section><br><br>



            <section class="py-xl">
              <!-- <span class="mask bg-primary alpha-6"></span> -->
                <div class="container d-flex align-items-center no-padding">
                    <div class="col">
                        <div class="row">
                          <div class="col-md-12">
                              <div class="card bg-tertiary text-white">
                                  <div class="card-body">
                                      <h2 class="heading pt-3 pb-2 text-white">
                                        Want to serve as a Volunteer?<br />
                                      </h2>
                                      <p class="mb-5">
                                        why are you waiting for let's join together and end the hunger.
                                      </p>



        <form method="POST" action="{{ url('/volunteerssuccess') }}">
  <div class="form-row">
    {{ csrf_field() }}
    <div class="col-md-4 mb-3">
      <label for="validationServer01">First name</label>
      <input type="text" class="form-control " id="validationServer01" placeholder="What do we call you?" name="first_name" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationServer02">Last name</label>
      <input type="text" class="form-control " id="validationServer02" placeholder="Have a nick name?" name="last_name"  required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationServer02">Date of Birth</label>
  <input type="date" class="form-control " id="validationServer02" name="DOB">
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
    <div class="col-lg-9 mb-3">
      <label for="validationServer05">Current institution</label>
      <input type="text" value="" autocomplete="on" class="form-control " id="validationServer05" name="current_institution" placeholder="Current Institutuion or Organization">
    </div>
  </div><br>
  <div class="form-row">
  <div class="col-lg-6 mb-3">
    <label for="validationServer05">Contact Number</label>
    <input type="text" value="" autocomplete="on" class="form-control " id="validationServer05" name="contact" placeholder="Contact Number">
  </div>

  <div class="col-lg-6 mb-3">
    <label for="validationServer05">Email id</label>
    <input type="text" value="" autocomplete="on" class="form-control " id="validationServer05" name="email" placeholder="email id">
  </div>
</div><br>

<div class="form-row">
  <div class="col-lg-12 mb-3">
  <textarea name="comments" rows="8" cols="120" placeholder="Mention any previous experiences"></textarea>
</div>
</div>

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
  </div><br><br>



  <button class="btn btn-primary" type="submit">Submit form</button> &nbsp;&nbsp;&nbsp;&nbsp;
  <button class="btn btn-warning" type="reset">Reset</button>


</div><br>
</div>
</div>
</div>
</div>
</div>
</div>
<br><br>

</form>
 </div>

      </div>
    </section><br><br>

@endsection
