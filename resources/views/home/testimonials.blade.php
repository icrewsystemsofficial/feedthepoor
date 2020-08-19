@extends('layouts.layouts')
@section('css')
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
  />
<style>

</style>
@endsection
@section('content')
<section class="slice-lg">
       <div class="container">
         <div class="row py-5 align-items-center cols-xs-space cols-sm-space cols-md-space">
           <div class="col-md-12">
            <div class="d-flex">
              <div class="stepper-div" >
                <div class="step1" id="stepper">
                    <ul class="stepper" >
                      <li><span>Donate</span></li>
                      <li><span>Feed</span></li>
                      <li><span>Pictures</span></li>
                    </ul>
                </div>
              </div>
            </div>
           </div>
           <div class="col-md-12">
             <div class="card">
               <div class="card-body">
                 <!-- <div class="">Example</div> -->

                 <div id="step1-p" class="animate__animated animate__fadeIn" style="display: block;">
                   <h3>You make your donation</h3>
                   You donate to our NGO partner via Razorpay payment gateway. The payment is automatically verified and accepted by our website. We immediately place the order for the food to donate the next day. You will recieve a recipt within the next 5 - 10 minutes.
                 </div>

                 <div id="step2-p" class="animate__animated animate__fadeIn" style="display: none;">
                   <h3>We distribute the food </h3>
                   With the help of our Voulenteers, we distribute the food which was arranged by your donation to the underprivileged people in certain locations.
                 </div>

                 <div id="step3-p" class="animate__animated animate__fadeIn" style="display: none;">
                   <h3>You get happy pictures</h3>
                   While we distribute the food, we take a quick moment to click a picture of your donation, along with your name with the person who is receiving it and mail it to you. We post the same
                   on our NGO partner's instagram account. If you have provided instagram handle, we'll tag you.
                 </div>
               </div>
             </div>
           </div>
         </div>
        </div>
</section>
<script>
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
  if(stepper.classList.contains('step1')) {

    stepper.classList.remove('step1');
    stepper.classList.add('step2');
    toggleVisibility('step1-p');
    toggleVisibility('step2-p');
  } else if(stepper.classList.contains('step2')) {
    stepper.classList.remove('step2');
    stepper.classList.add('step3');
    toggleVisibility('step2-p');
    toggleVisibility('step3-p');
  } else if(stepper.classList.contains('step3')) {

    stepper.classList.remove('step3');
    stepper.classList.add('step1');
    toggleVisibility('step3-p');
    toggleVisibility('step1-p');
  }
}, 5000);
</script>
@endsection
