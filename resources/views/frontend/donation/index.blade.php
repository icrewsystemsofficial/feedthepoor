@extends('layouts.frontend')

@section('content')
<section class="section-header bg-gradient-white pb-lg-12">
    <div class="container">
       <div class="row justify-content-center">
          <div class="col-12 col-md-8 text-center">
                <h1 class="display-2">
                    Donation
                </h1>
          </div>
       </div>
    </div>
 </section>

 <script>
     function donationPage() {
         return {
            donationType: null,
            donationAmount: 0,
            showCustomDonationBlock: false,

            updateDonationType() {
                alert(this.donationType);
            },

            updateDonationAmount(amount) {
                this.donationAmount = amount;
                this.showCustomDonationBlock = false;
            },

            updateDonationAmount_custom() {
                this.showCustomDonationBlock = false;
            },

            calculateYield(amount, type) {

            },

            toggleCustomDonation() {
                this.showCustomDonationBlock = !this.showCustomDonationBlock;
            }
         }
     }
 </script>

 <section class="section section-lg pt--2 bg-dark" x-data="donationPage()">
    <div class="container mt-lg-n12 z-2">
       <div class="row justify-content-center">
          <div class="col">
             <div class="card shadow-lg border-gray-300 p-4 p-lg-5">

                <div class="row">
                    <div class="col-8 mx-auto">

                        <div class="mb-3">
                            <label class="my-1 me-2" for="inlineFormCustomSelectPref">
                                Type of Donation
                            </label>
                            <select class="form-select" x-model="donationType" aria-label="Default select example" @change="updateDonationType">
                                <option selected="selected" disabled>Choose one</option>
                                <option value="donation_food">Food Donation</option>
                                <option value="donation_prosthetic_leg">Prosthetic Leg</option>
                                <option value="donation_sweater">Sweater</option>
                                <option value="donation_wheel_chair">Wheel Chair</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6" style="border-right: 1px solid #3a3a3a;">
                                    <label for="exampleInputEmail6">
                                        How much would you like to donate?
                                    </label>

                                    <div class="flex">

                                        @php

                                            $amounts = array(
                                                100,
                                                500,
                                                1000,
                                                5000,
                                            );

                                        @endphp

                                        @foreach ($amounts as $amount)
                                            <button type="button" class="btn btn-md btn-success text-white" @click="updateDonationAmount({{ $amount }});">
                                                ₹{{ $amount }}
                                            </button>
                                        @endforeach

                                        <br><br>

                                        <button type="button" class="btn btn-md btn-primary text-white" @click="toggleCustomDonation">
                                            Custom Amount
                                        </button>

                                        <div x-show="showCustomDonationBlock">
                                            <input type="number" class="form-control mt-3 mb-3" x-model="donationAmount" x-on:change="updateDonationAmount_custom">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mt-3 mb-3 h3" style="padding-left: 50px;">
                                        Donating ₹<span x-text="donationAmount"></span>

                                        <p class="text-sm text-bg-gray">
                                            About 20 people get fed
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Tab Nav -->
                <div class="nav-wrapper position-relative mb-2">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-bs-toggle="tab"
                                href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-bs-toggle="tab"
                                href="#tabs-text-2" role="tab" aria-controls="tabs-text-2"
                                aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-3-tab" data-bs-toggle="tab"
                                href="#tabs-text-3" role="tab" aria-controls="tabs-text-3"
                                aria-selected="false">Messages</a>
                        </li>
                    </ul>
                </div>
                <!-- End of Tab Nav -->
                <!-- Tab Content -->
                <div class="card border-0">
                    <div class="card-body p-0">
                        <div class="tab-content" id="tabcontent1">
                            <div class="tab-pane fade show active" id="tabs-text-1" role="tabpanel"
                                aria-labelledby="tabs-text-1-tab">
                                <p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed.
                                    Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident
                                    chillwave deep v laborum. Aliquip veniam delectus,
                                    Marfa eiusmod Pinterest in do umami readymade swag.</p>
                                <p>Day handsome addition horrible sensible goodness two contempt. Evening for married
                                    his account removal. Estimable me disposing of be moonlight cordially curiosity.</p>
                            </div>
                            <div class="tab-pane fade" id="tabs-text-2" role="tabpanel"
                                aria-labelledby="tabs-text-2-tab">
                                <p>Photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit
                                    seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v
                                    laborum. Aliquip veniam delectus, Marfa eiusmod
                                    Pinterest in do umami readymade swag.</p>
                                <p>Day handsome addition horrible sensible goodness two contempt. Evening for married
                                    his account removal. Estimable me disposing of be moonlight cordially curiosity.</p>
                            </div>
                            <div class="tab-pane fade" id="tabs-text-3" role="tabpanel"
                                aria-labelledby="tabs-text-3-tab">
                                <p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed.
                                    Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident
                                    chillwave deep v laborum. Aliquip veniam delectus,
                                    Marfa eiusmod Pinterest in do umami readymade swag.</p>
                                <p>Day handsome addition horrible sensible goodness two contempt. Evening for married
                                    his account removal. Estimable me disposing of be moonlight cordially curiosity.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Tab Content -->

                <form action="">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="exampleInputEmail6">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail6">
                                <small id="emailHelp" class="form-text text-gray">We'll never share your email with anyone
                                    else.</small>
                            </div>
                        </div>
                    </div>

                </form>

                <p class="lead">Spaces is an incredibly beautiful, fully responsive, and mobile-first projects on the web – it is the perfect starting point for any creative and professional sites. Get started with Spaces's components and options for laying out your Spaces project, including SVG components, powerful scripts, fully detailed documentation, and yet developer friendly code.</p>


                <div class="text-center border-top border-bottom border-gray-300 my-5 my-lg-6 py-5 py-lg-6">
                   <h4 class="h4 mb-4 mb-lg-5"><span class="me-1"><i class="far fa-newspaper"></i></span> Was this article helpful?</h4>
                   <button type="button" class="btn btn-success mb-2 mx-1 animate-up-2 text-white"><span class="me-2"><i class="far fa-thumbs-up"></i></span>Yes, thanks!</button> <button type="button" class="btn btn-danger mb-2 mx-1 animate-down-2"><span class="me-2"><i class="far fa-thumbs-down"></i></span>Not really</button>
                </div>
                <div class="row">
                   <div class="col-12 col-md-4 mb-4 mb-lg-0">
                      <div class="mb-4">
                         <h3 class="h5 font-weight-medium">Related Articles</h3>
                      </div>
                      <ul class="list-unstyled">
                         <li class="pb-3"><a class="link-muted" href="./support-topic.html">Troubleshoot connection issues</a></li>
                         <li class="pb-3"><a class="link-muted" href="./support-topic.html">Getting started for workspace creators</a></li>
                         <li class="pb-3"><a class="link-muted" href="./support-topic.html">Edit your profile</a></li>
                      </ul>
                   </div>
                   <div class="col-12 col-md-4 mb-4 mb-lg-0">
                      <div class="mb-4">
                         <h3 class="h5 font-weight-medium">Latest News</h3>
                      </div>
                      <ul class="list-unstyled">
                         <li class="pb-3"><a class="link-muted" href="./support-topic.html">Troubleshoot connection issues</a></li>
                         <li class="pb-3"><a class="link-muted" href="./support-topic.html">Getting started for workspace creators</a></li>
                         <li class="pb-3"><a class="link-muted" href="./support-topic.html">Edit your profile</a></li>
                      </ul>
                   </div>
                   <div class="col-12 col-md-4 mb-4 mb-lg-0">
                      <div class="mb-4">
                         <h3 class="h5 font-weight-medium">Support</h3>
                      </div>
                      <p>Technical support for each product is given directly by the creators of Themesberg.</p>
                      <a class="btn btn-sm btn-outline-primary" href="./support.html">Support Center <span class="fas fa-long-arrow-alt-right ms-2"></span></a>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>

@endsection
