@extends('layouts.layouts')

@section('content')

<section class="slice bg-primary my-sec">
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
<section class="slice bg-primary">
      <div class="container">
        <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space text-center text-lg-left">
          <div class="col-lg-7">
            <h1 class="heading h2 text-white strong-500">
              Your question isn't listed here?
            </h1>
            <p class="lead text-white mb-0">Worry not. We've got your back. Write your question to us here and one of our executives shall get in touch with you at the soonest possible.</p>
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
