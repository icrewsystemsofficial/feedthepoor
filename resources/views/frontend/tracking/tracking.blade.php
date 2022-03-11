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
                <h1 class="display-4 text-white fs-1 d-flex justify-content-center">
                    Donation Tracking
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-hourglass-split text-center" viewBox="0 0 16 16">
                        <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
                    </svg>

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


                    <div>
                        <p class="text-dark fs-5 fw-bolder">Donator Name : {{$track_names[0]}}</p>
                        <p class="text-dark fs-5 fw-bolder"> Tracking ID : F5452578262721 </p>
                    </div>

                    <div class="progress-wrapper ">
                        <div class="m-auto" style="width: 210px;">
                            <p class="text-white text-center bg-danger  fw-bolder text-center fs-2 border border-light rounded"> Pending
                                <span class="spinner-grow text-white" role="status" style="width: 7px; height:7px;">
                                </span> <span class="spinner-grow text-white" role="status" style="width: 7px; height:7px;">
                                </span> <span class="spinner-grow text-white" role="status" style="width: 7px; height:7px;"></span>
                            </p>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 15%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="row mt-4 ms-4 position-relative">

                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                            <div class="ps-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                </svg>
                            </div>
                            <div class="mt-1" x-data="{}">
                                <a @click="$dispatch('img-modal', {  imgModalSrc: '{{asset('tracking-images/donation.png')}}', imgModalDesc: 'The Donation was received by the Mr.User on this date' })" class="cursor-pointer">
                                    <img src="{{asset('tracking-images/donation.png')}}" alt="" width="50px" height="50px" class="image-link ms-1 rounded">
                                </a>
                            </div>
                            <p class="pt-3"> <b>Donation Received</b> </p>
                            <small>17th Jan 2022</small>
                        </div>


                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                            <div class="ps-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                </svg>
                            </div>
                            <div class="mt-1" x-data="{}">
                                <a @click="$dispatch('img-modal', {  imgModalSrc: '{{asset('tracking-images/receipt.png')}}', imgModalDesc: 'The Receipt was generated to the donator with the ID' })" class="cursor-pointer">
                                    <img src="{{asset('tracking-images/receipt.png')}}" alt="" width="50px" height="50px" class="image-link ms-1 rounded">
                                </a>
                            </div>
                            <p class="pt-3"> <b>Receipt Generated</b> </p>
                            <small>18th Jan 2022</small>
                        </div>

                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-check-circle-fill " viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                            <div class="ps-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                </svg>
                            </div>
                            <div class="mt-1" x-data="{}">
                                <a @click="$dispatch('img-modal', {  imgModalSrc: '{{asset('tracking-images/procurement.png')}}', imgModalDesc: 'The procurement order was placed in this date' })" class="cursor-pointer">
                                    <img src="{{asset('tracking-images/procurement.png')}}" alt="" width="50px" height="50px" class="image-link ms-1 rounded">
                                </a>
                            </div>
                            <p class="pt-3 "> <b>Procurement Placed</b> </p>
                            <small>19th Jan 2022</small>
                        </div>

                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-check-circle-fill " viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                            <div class="ps-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                </svg>
                            </div>
                            <div class="mt-1" x-data="{}">
                                <a @click="$dispatch('img-modal', {  imgModalSrc: '{{asset('tracking-images/mission.png')}}', imgModalDesc: 'The mission id is generated for the given procurement order' })" class="cursor-pointer">
                                    <img src="{{asset('tracking-images/mission.png')}}" alt="" width="50px" height="50px" class="image-link ms-1 rounded">
                                </a>
                            </div>
                            <p class="pt-3"> <b>Mission ID Generated</b> </p>
                            <small>20th Jan 2022</small>
                        </div>

                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                            <div class="ps-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                </svg>
                            </div>
                            <div class="mt-1" x-data="{}">
                                <a @click="$dispatch('img-modal', {  imgModalSrc: '{{asset('tracking-images/volunteers.png')}}', imgModalDesc: 'The volunteers are generated for the given mission' })" class="cursor-pointer">
                                    <img src="{{asset('tracking-images/volunteers.png')}}" alt="" width="50px" height="50px" class="image-link ms-1 rounded">
                                </a>
                            </div>
                            <p class="pt-3"> <b>Volunteers Generated</b> </p>
                            <small>21st Jan 2022</small>
                        </div>
                    </div>

                    <br>

                    <div class="d-flex justify-content-end bottom-0 end-0 position-absolute pe-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill " viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </svg> 
                        <h6 class="ps-2 text-secondary fs-6"> Click on each image to know more info </h6>
                    </div>



                    <div x-data="{ imgModal : false, imgModalSrc : '', imgModalDesc : '' }">
                        <template @img-modal.window="imgModal = true; imgModalSrc = $event.detail.imgModalSrc; imgModalDesc = $event.detail.imgModalDesc;" x-if="imgModal">
                            <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" x-on:click.away="imgModalSrc = ''" class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-black bg-opacity-75">
                                <div @click.away="imgModal = ''" class="flex flex-col max-w-3xl max-h-full overflow-auto">
                                    <div class="z-50">
                                        <button @click="imgModal = ''" class="float-right pt-2 pr-2 outline-none focus:outline-none">
                                            <svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-2">
                                        <img :alt="imgModalSrc" class="object-contain h-1/2-screen" :src="imgModalSrc">
                                        <p x-text="imgModalDesc" class="text-center text-white"></p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection