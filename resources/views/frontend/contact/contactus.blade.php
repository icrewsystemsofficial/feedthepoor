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

$donation_types = (object) array(

0 => (object) array(
'name' => 'donation_food',
'icon' => 'fas fa-utensils',
'per_unit_cost' => 50,
'yield_context' => 'About %YIELD% underprivledged people will be fed with fresh cooked food',
),


1 => (object) array(
'name' => 'donation_prosthetic_leg',
'icon' => 'fas fa-wheelchair',
'per_unit_cost' => 2000,
'yield_context' => 'About %YIELD% handicapped people will get prosthetic leg, and will be able to walk again.',
),

2 => (object) array(
'name' => 'donation_sweater',
'icon' => 'fas fa-tshirt',
'per_unit_cost' => 400,
'yield_context' => 'About %YIELD% people will get a brand new sweater, and will be warm.',
),

3 => (object) array(
'name' => 'donation_shoes',
'icon' => 'fas fa-shoe-prints',
'per_unit_cost' => 250,
'yield_context' => 'About %YIELD% people will get a brand new shoe. They will not have to walk with bare foot.',
),

4 => (object) array(
'name' => 'donation_stationary_kit',
'icon' => 'fas fa-pen-square',
'per_unit_cost' => 50,
'yield_context' => 'About %YIELD% children will get a brand new stationary kit, which will help them study.',
),

5 => (object) array(
'name' => 'donation_dry_ration',
'icon' => 'fas fa-box',
'per_unit_cost' => 50,
'yield_context' => 'About %YIELD% house-holds will receive fresh ration to cook and eat meals.',
),

6 => (object) array(
'name' => 'donation_birthday_celebration',
'icon' => 'fas fa-birthday-cake',
'per_unit_cost' => 50,
'yield_context' => 'Your birthday will be celebrated cheerfully with about %YIELD% children. Cakes and sweets will be distrubuted.',
),

7 => (object) array(
'name' => 'donation_prosthetic_arm',
'icon' => 'fas fa-wheelchair',
'per_unit_cost' => 2000,
'yield_context' => 'About %YIELD% handicapped people will get prosthetic leg, and will be able to walk again.',
),


);


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

                if (yield == 0 || yield < 0) {

                    if (this.donationAmount == 0) {
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
                if (this.donationAmount == 0) {
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
            */

            changeIcon() {
                var icon = this.donationTypesArray[this.selectedCause.cause]['icon'];
                this.selectedCause.icon = icon + ' fa-5x';
            },

            formatMoney() {
                this.donationAmount_formatted = (this.donationAmount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            },


            showDonateButton() {
                if (this.donationAmount != 0 && this.errors.insuffucientDonationAmount == false) {
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

<style>
    #form {
        animation: fadeInAnimation ease 2s;
        animation-iteration-count: 1;
        animation-fill-mode: forwards;
    }

    @keyframes fadeInAnimation {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }
</style>
@endsection

@section('js')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('content')


<section class="section-header bg-dark mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <h1 class="display-4 text-white fs-1">
                    Contact us
                </h1>
                <p class="text-warning fs-2 fw-bolder">For all enquiries, email us using form below</p>
            </div>
        </div>
    </div>
</section>

<section class="" x-data="donationPage()" x-init="init()">
    <div class="container mt-n6 z-2 mb-5">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8">
                <div class="card shadow-lg border-gray-300 p-4 p-lg-5">

                    <p class="text-center text-dark fs-3 fw-bolder">How can we help you ?</p>

                    @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="far fa-thumbs-up"></i></span>
                        <span class="alert-inner--text"><strong>Well done!</strong> {{ session()->get('message') }}.</span>
                    </div>

                    @endif

                    <form action="{{route('frontend.savecontact')}}" method="POST" id="form">
                        @csrf

                        @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                        <p class="alert alert-danger"> {{$error}} </p>
                        @endforeach
                        @endif

                        <div class="mb-3">
                            <label for="name" class="d-flex">
                                <i class="fa-solid fa-user pe-2 fs-4"></i>
                                Name : </label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter your name...">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="d-flex">
                                <i class="fa-solid fa-envelope pe-2 fs-4"></i>
                                Email : </label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Enter your email...">
                        </div>

                        <div class="mb-3">
                            <label for="number" class="d-flex">
                                <i class="fa-solid fa-phone pe-2 fs-4"></i>
                                Phone number : </label>
                            <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}" placeholder="Enter your phone number...">
                        </div>

                        <div class="mb-3">

                            <label for="message" class="d-flex">
                                <i class="fa-solid fa-comment pe-2 fs-4" id="font"></i>
                                Message : </label>
                            <textarea class="form-control" name="message" value="{{old('message') }}" placeholder="Enter your message..." id="message" rows="4">
                            </textarea>

                            

                        </div>

                        <div class="mb-3 mt-3">
                            {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                        </div>



                        <div class="m-auto w-25 mt-3">
                            <input type="submit" class="btn btn-outline-dark text-center" type="button">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection