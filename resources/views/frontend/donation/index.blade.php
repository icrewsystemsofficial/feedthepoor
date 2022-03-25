@extends('layouts.frontend')

@section('css')
@php

/*
    THE PHP DATA!
    This data should be sent from Controller / Service Provider

    - Leonard,
    05 March 2022.
*/


$amounts = array(
    50,
    100,
    500,
    1000,
    5000,
    7000,
    10000,
);

$donation_types = App\Models\Causes ::all();


// Argh, this is an uneccesary move ig. Will be fixed when sending data from controller.

$donation_types_cleaned = array();
foreach($donation_types as $donation_type) {
    $donation_types_cleaned[$donation_type->name] = $donation_type;
}


@endphp

<script>

    // Alpine JS function

     function donationPage() {



         return {

            // Defining the variables

            form: {
                page_1: true,
                page_2: false,
            },

            donationType: null,
            donationAmount: 0,
            donationAmount_formatted: 0,
            showCustomDonationBlock: false,
            showCustomDonationButton: true,


            selectedCause: {
                cause: null,
                icon: '',
                PerUnitCost: 0,
                Yield: 0,
                YieldContext: 'Please choose a cause to know what your donation will yield',
            },

            errors: {
                insuffucientDonationAmount: false,
            },

            razorpayForm: {
                name: '',
                email: '',
                phone: '',
                pan: '',
                checkbox_80g: true,
                checkbox_updates: true,
                checkbox_terms_and_conditions: false,
            },

            donationTypesArray: @json($donation_types_cleaned),


            // FUNCTIONS START!

            /*
                init - initialized when alpine takes over the DOM.
            */

            init() {
                this.selectedCause.cause = document.getElementById('selectedCause').value;
                console.log(this.selectedCause.cause);
                this.updateDonationCause();
            },


            /*
                updateDonationCause - updates the cause.

                Triggered by @change event on the selector.

                Triggers to change the yield context, icon and then automatically
                calculates the yield based on the mounted donationAmount.
            */
            updateDonationCause() {
                this.changeYieldContext();
                this.changeIcon();
                this.calculateYield(this.donationAmount);
            },

            /*
                updateDonationAmount - the amount is passed into the fn.

                Triggered by @click event.

                Updates the donation amount on DOM,
                calculates the yield based on that amount.
            */
            updateDonationAmount(amount) {
                this.donationAmount = amount;
                this.calculateYield(amount, this.selectedCause.PerUnitCost);
                this.formatMoney();
            },


            updateDonationAmount_cus() {

                var amount = document.getElementById('custom_donation').value;

                // Rounding off to the nearest 100.
                amount = Math.round(amount / 100) * 100;


                this.updateDonationAmount(amount);
                this.showCustomDonationBlock = false;
                this.showCustomDonationButton = true;
            },

            updateDonationAmount_custom() {
                this.calculateYield(this.donationAmount, this.selectedCause.PerUnitCost);
                this.showCustomDonationBlock = false;
            },


            /*
                calculateYield - amount as parameter.

                is a protected fn, called from other fns.
                calculates the yield based on the donationTypesArray
                which is a js array, which is generated from a php json_encoded
                object.
            */

            calculateYield(amount) {
                var per_unit_cost = this.donationTypesArray[this.selectedCause.cause]['per_unit_cost'];
                var yield = Math.floor(amount / per_unit_cost);

                // Now, if the yield is less than 1, we should alert the user
                // that their donation will not be sufficient.

                if(yield == 0 || yield < 0) {

                    if(this.donationAmount == 0) {
                        this.errors.insuffucientDonationAmount = false;
                        this.selectedCause.YieldContext = '<span class="text-danger">Please select donation amount</span>';
                    } else {
                        this.errors.insuffucientDonationAmount = true;
                        this.selectedCause.YieldContext = '<span class="text-danger fw-bolder">Try choosing a different cause or higher donation amount</span>';
                    }
                } else {
                    this.errors.insuffucientDonationAmount = false;
                    this.selectedCause.Yield = yield;
                    this.changeYieldContext();
                }
            },


            /*
                Change Yield Context.

                When a specific cause is selected, the context of the yield
                is also updated from the js array.
            */

            changeYieldContext() {
                if(this.donationAmount == 0) {
                    this.selectedCause.YieldContext = '<span class="text-danger">Please select donation amount</span>';
                } else {
                    var yield_context = this.donationTypesArray[this.selectedCause.cause]['yield_context'];
                    var yield = '<span class="fw-bolder text-success">' + this.selectedCause.Yield + '</span>';

                    // In the DB, the context will be saved with a %YIELD% string.
                    // we're replacing it using js.

                    yield_context = yield_context.replace("%YIELD%", yield);
                    this.selectedCause.YieldContext = '<span class="mt-2 fw-bold leading-1">' + yield_context + "</span>";
                }
            },



            /*
                toggleCustomDonation.

                Toggles custom donation block.
            */

            toggleCustomDonation() {
                this.showCustomDonationBlock = !this.showCustomDonationBlock;
                this.showCustomDonationButton = !this.showCustomDonationButton;
            },


            /*
                changeIcon

                Changes the icon of the cause.

                
                Icons in the DB are just stored as part of the class identifier without the prefix

                Anirudh
                March 25, 2022
            */

            changeIcon() {
                var icon = this.donationTypesArray[this.selectedCause.cause]['icon'];
                this.selectedCause.icon = 'fas fa-' + icon + ' fa-5x';
            },

            formatMoney() {
                this.donationAmount_formatted = (this.donationAmount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            },


            showDonateButton() {
                if(this.donationAmount != 0 && this.errors.insuffucientDonationAmount == false) {
                    return true;
                } else {
                    return false;
                }
            },


            toggle80GExemption() {
                this.razorpayForm.checkbox_80g = !this.razorpayForm.checkbox_80g;
            },

            toggleContinueButton() {
                this.razorpayForm.checkbox_terms_and_conditions = !this.razorpayForm.checkbox_terms_and_conditions;
            },

            togglePages() {
                this.form.page_1 = !this.form.page_1;
                this.form.page_2 = !this.form.page_2;
            },

            
            goback() {
                this.form.page_1 = !this.form.page_1;
                this.form.page_2 = !this.form.page_2;
            },




         }
     }


     function razorpay() {
         return {
            public: 'rzp_test_SmU75lqcibiulc',
            secret: 'BSe2Who1QIS4heUJBapZImfr',
            api_url: 'https://api.razorpay.com/v1/',


         }
     }
 </script>
@endsection

@section('content')


<section class="section-header bg-dark mb-4">
    <div class="container">
       <div class="row justify-content-center">
          <div class="col-12 col-md-8 text-center">
                <h1 class="display-4 text-white">
                    Thank you for choosing to donate 🙏
                    <br>
                    <small>
                        <span class="display-6">
                            We're thrilled to help people through your <span class="text-theme">kindness and generosity</span>
                        </span>
                    </small>
                </h1>
          </div>
       </div>
    </div>
 </section>

 <section class="" x-data="donationPage()" x-init="init()">
    <div class="container mt-n6 z-2 mb-5">
       <div class="row justify-content-center">
          <div class="col-sm-12 col-md-10 col-lg-8">
             <div class="card shadow-lg border-gray-300 p-4 p-lg-5">

                <div class="row" x-show="form.page_2">
                    <div class="col-md-12 mx-auto">

                        <div class="mt-2 mb-3">
                            <span class="h5">
                                Processing donation for <span class="text-success">₹<span x-text="donationAmount_formatted"></span></span>
                            </span>
                        </div>

                        <form action="{{ route('api.v1.razorpay.create_order') }}" method="GET">
                            @csrf
                            <div class="mt-2 mb-3">
                                <label for="name">Full Name (as per Govt. ID) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required="required"/>
                            </div>

                            <div class="mt-2 mb-3">
                                <label for="name">E-mail ID <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" required="required"/>
                            </div>

                            <div class="mt-2 mb-3">
                                <label for="name">Phone</label>
                                <input type="phone" class="form-control" name="phone" maxlength="10"/>
                            </div>

                            <div class="mt-2 mb-3" x-show="razorpayForm.checkbox_80g">
                                <label for="name">PAN Card</label>
                                <input type="text" class="form-control" name="pan" maxlength="10" />
                                <span class=" text-muted mt-2">
                                    <small>
                                        80G excemption receipt will carry this PAN number
                                    </small>
                                </span>
                            </div>

                            <div class="mt-2 mb-3">
                                <div class="form-check form-switch">
                                    <div @click="toggle80GExemption">
                                        <input class="form-check-input" type="checkbox" name="checkbox_80g" id="checkbox_80g" x-bind:checked="razorpayForm.checkbox_80g" >
                                        <label class="form-check-label" for="checkbox_80g">
                                            I want 80G Income Tax Excemption
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="checkbox_updates" id="checkbox_updates" x-bind:checked="razorpayForm.checkbox_updates">
                                    <label class="form-check-label" for="checkbox_updates">
                                        Send me updates about future campaigns <br>
                                        <small>
                                            (we won't spam, we promise <i class="fas fa-heart"></i>)
                                        </small>
                                    </label>
                                </div>
                            </div>

                            <div class="mt-2 mb-3">
                                <div class="form-check" @click="toggleContinueButton()">
                                    <input class="form-check-input" type="checkbox" value="" id="terms_and_conditions" x-bind:checked="razorpayForm.checkbox_terms_and_conditions">
                                    <label class="form-check-label" for="terms_and_conditions">
                                        I have read and I accept the <a href="#">terms & conditions</a>
                                    </label>
                                </div>
                            </div>

                            <input type="hidden" name="amount" x-model="donationAmount" />
                            <input type="hidden" name="cause" x-model="selectedCause.cause" />

                            <div class="mt-2 mb-3" x-show="razorpayForm.checkbox_terms_and_conditions">
                                <x-frontend-loading-button class="btn btn-success btn-md text-white">
                                    Proceed to donate via Razorpay
                                </x-frontend-loading-button>

                            </div>
                        </form>




                    </div>
                    
                    <button type="button" class="w-auto btn btn-warning btn-block btn-lg text-white btn-zoom--hover btn-shadow--hover btn-animated btn-animated-x donate-btn" @click="goback()">
                        <span class="btn-inner--visible">Go Back</span>
                        <span class="btn-inner--hidden"><small><i class="fas fa-arrow-left"></i></small></span>
                    </button>
                </div>

                <div class="row" x-show="form.page_1">

                    <div class="col-md-12 mx-auto" x-show="errors.insuffucientDonationAmount"
                        x-transition:enter="animate__zoomIn"
                        x-transition:enter-start="animate__zoomIn"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                    >
                        <div class="alert alert-danger text-danger" role="alert">
                            <span class="h4 fw-bolder text-danger">
                                Ooops!
                            </span>
                            <br>
                            The procurement / per unit cost for "<span x-text="selectedCause.cause" class="fw-bold"></span>" is higher than the chosen donation amount.
                            You can either choose a higher donation amount or try a different cause
                        </div>
                    </div>

                    <div class="col-md-12 mx-auto text-center border-bottom border-gray-300 my-4 ">
                        <div class="mb-3">
                            <i x-bind:class="selectedCause.icon"
                                x-transition:enter.duration.500ms
                                x-transition:leave.duration.400ms
                            ></i>
                        </div>
                        <div class="h1">
                            <span x-text="selectedCause.cause"></span>
                        </div>
                        <div class="h1">
                            <div class="" x-show="showDonateButton()">
                                <button type="button" class="btn btn-success btn-block btn-lg text-white btn-zoom--hover btn-shadow--hover btn-animated btn-animated-x donate-btn" @click="togglePages()">
                                    <span class="btn-inner--visible">Donate <span class="">₹<span x-text="donationAmount_formatted"></span></span></span>
                                    <span class="btn-inner--hidden"><small>Process <i class="fas fa-arrow-right"></i></small></span>
                                </button>
                            </div>






                            <p class="text-sm text-bg-gray">
                                <span x-html="selectedCause.YieldContext"></span>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail6">
                                How much would you like to donate?
                            </label>

                            <div class="flex" style="flex-wrap: wrap">



                                @foreach ($amounts as $amount)
                                    <button type="button" class="btn btn-sm btn-theme text-white" @click="updateDonationAmount({{ $amount }});">
                                        ₹{{ number_format($amount, '0', ".",",") }}
                                    </button>
                                @endforeach


                                <div class="text-center">
                                    <br>
                                    <span class="h4">
                                        OR
                                    </span>
                                    <br>
                                    <br>

                                    <a class="text-primary fw-bold" @click="toggleCustomDonation" x-show="showCustomDonationButton" style="text-decoration: underline;">
                                        Enter a custom amount?
                                    </a>

                                    <div class="" x-show="showCustomDonationBlock">

                                        <input type="number" class="form-control mt-3 mb-3" id="custom_donation" />

                                        <p class="text-muted">
                                            <small>
                                                The amount you enter will be automatically rounded off to the
                                            nearest 100.
                                            </small>
                                        </p>

                                        <button type="button" class="btn btn-md btn-primary text-white" @click="updateDonationAmount_cus()">
                                            Process
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 text-center">

                        <div class="mb-3">
                            <label class="my-1 me-2" for="inlineFormCustomSelectPref">
                                What cause would you like to donate for?
                            </label>
                            <select class="form-select" id="selectedCause" x-model="selectedCause.cause" aria-label="Default select example" @change="updateDonationCause">
                                {{--
                                    We're passing the string, exploding it based on "donation_", then replacing the other "_" (dashses)
                                    and then capitalizing the first letter of the string.

                                    Phew!

                                    Leonard,
                                    March 04, 2022.

                                    As of today the database entries for causes does not contain the string "donation_"
                                    So capitalization of first letter alone is sufficient

                                    Anirudh 
                                    March 25, 2022
                                --}}


                                @php
                                    $first_iteration = true;
                                @endphp

                                @foreach ($donation_types as $donation_type)
                                    <option value="{{ $donation_type->name }}" {{ $first_iteration == true ? 'selected':'' }}>
                                        {{ ucfirst($donation_type->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

             </div>
          </div>
       </div>
    </div>
 </section>

@endsection
