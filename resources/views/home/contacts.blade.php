@extends('layouts.layouts')

@section('content')

<style media="screen">
  .heading3{
    padding-left: 8%;
  }
  @media(min-width:1000px){
      h4 span{
          font-size: 3rem;
      }
      
  }
</style>

<section class="spotlight C-parallax bg-cover bg-size--cover" data-spotlight="fullscreen" style="background-image: url({{asset('images/subheader_contactpage.jpg')}})">
    <span class="mask bg-tertiary alpha-5"></span>
    <div class="spotlight-holder py-lg pt-lg-xl">
        <div class="container d-flex align-items-center no-padding">
            <div class="col">
                <div class="row cols-xs-space align-items-center text-center text-md-left justify-content-start">
                    <div class="col-4">
                        <div class="text-left mt-2">
                          <img src="https://cdn.discordapp.com/attachments/530789778912837640/691801343723307068/1585008642050.png"
                              style="width: 200px;" class="img-fluid animated" data-animation-in="jackInTheBox"
                              data-animation-delay="1000">

                            <!-- <h2 class="heading display-4 font-weight-400 text-white mt-5 animated" data-animation-in="fadeInUp" data-animation-delay="2000">
                <span class="font-weight-700">812</span> hungry mouths fed today
              </h2> -->
                            <h4 class="lead text-white mt-3 lh-180 c-white animated" data-animation-in="fadeInUp"
                                data-animation-delay="2500">
                                <span >#AnyQuestions?</span> <br />
                                <p style="font-size: 1rem"> "We are always here to answer you."</p>
                            </h4>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section><br><br><br><br>

<!-- <section>
  <div class="slice bg-primary my-sec">
    <div class="container">
      <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space text-center text-lg-left">
        <div class="col-lg-7">
          <h1 class="heading h2 text-white strong-500">
            FAQ
          </h1>
          <p class="lead text-white mb-0">Here are a few questions that our clients often have. </p>
        </div>
      </div>
    </div>

  </div>
</section> -->

<section>
    <div class="container">
      <div class="heading3">
        <h3>Here are a few questions that our clients often have. </h3>
      </div>
    </div>

</section>


<section id="wrapper">
<div class="my-container">
   <ul class="accordion my-ul">
      <li class="item">
         <h2 class="accordionTitle">What are the payment gateways available?<span class="accIcon"></span></h2>
         <div class="text">You could pay us by either Stripe, Razorpay or PAYTM.</div>
      </li>
      <li class="item">
         <h2 class="accordionTitle">What to do on failure of payment? <span class="accIcon"></span></h2>
         <div class="text">Please check your bank account for any updates on your account and retry after a little while.</div>
      </li>
      <li class="item">
         <h2 class="accordionTitle">How do I know if my transaction was successful? <span class="accIcon"></span></h2>
         <div class="text">On success of the payment, you will recieve a mail from us on your registered email-id</div>
      </li>
      <li class="item">
         <h2 class="accordionTitle">Do I need to have a bank account in order to make the<br> payment?<span class="accIcon"></span></h2>
         <div class="text">Yes, it will be necessary for you to have a bank account</div>
      </li>
      <li class="item">
         <h2 class="accordionTitle">Can I make payments to the company in installments?<span class="accIcon"></span></h2>
         <div class="text">Yes, if approved at time of project documentation, the you are permitted to make the payment in installments.<br> Else, you are required to pay the whole amount in once.</div>
      </li>
      <li class="item">
         <h2 class="accordionTitle">Can I make payments to the company in installments?<span class="accIcon"></span></h2>
         <div class="text">Yes, if approved at time of project documentation, the you are permitted to make the payment in installments.<br> Else, you are required to pay the whole amount in once.</div>
      </li>
   </ul>
</div>
</section>


    <section class="py-xl">
      <!-- <span class="mask bg-primary alpha-6"></span> -->
        <div class="container d-flex align-items-center no-padding">
            <div class="col">
                <div class="row">
                  <div class="col-md-12">
                      <div class="card bg-tertiary text-white">
                          <div class="card-body">
                              <h2 class="heading pt-3 pb-2 text-white">
                                We'd love to hear from you<br />
                              </h2><br><br>




<form method="POST" action="{{ url('/contactsuccess') }}">
<div class="form-row">
{{ csrf_field() }}
<div class="col-md-12 mb-3">
<label for="validationServer01">First name</label>
<input type="text" class="form-control " id="validationServer01" placeholder="What do we call you?" name="first_name" required>
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
<label for="validationServer05">Subject</label>
<input type="text" value="" autocomplete="on" class="form-control " id="validationServer05" name="subject" placeholder="Subject">
</div>
</div><br>


<div class="form-row">
  <div class="col-lg-12 mb-3">
  <textarea name="comments" rows="8" cols="85" class="form-control" placeholder="Comment your qoutes here..."></textarea>
  </div>
</div>



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
<section class="slice bg-primary">
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
    </section>

@endsection

@section('navbar_style')
    <style>
        .navbar{
            background: transparent !important;
            
        }
        
        
        #dmenu a{
            color: #000 !important;
            @yeild()

        }
        @media(min-width:766px){
            .navbar .dropdown-menu a{
                color: #ffffff !important;
            }
            .container a{
            color: #ffffff !important;

            }
        }
        .container>a{
            color: #ffffff !important;

        }
        .navbar.scrolled{
            background: #ffffff !important;
            
        }
        .navbar.scrolled a{
            color: #000 !important;
        }
        
    </style>
@endsection