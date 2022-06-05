@extends('layouts.frontend')

@section('css')
<style>
    .modal {
        display: none;
        position: fixed;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow-y: auto;
        overflow-x: hidden;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-backdrop {
        z-index: 0 !important;
    }

    .modal-content {

        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 45%;
    }

    .close {
        color: red;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>


<style>
:root{
    --percentage: {{ $donation_details['donation_percentage'] }}%;
}
.timer-wrap {
    width: 100%;
    text-align: center;
}
#timer {
    width: 100%;
    font-size: 3.5em;
    color: #fff;
    text-align: center;
}

#timer div {
    font-family: 'Roboto', sans-serif;
    display: inline-block;
    width: 120px;
    font-weight: 200;
    text-align: center;
    margin-right: 20px;
}
#timer div span {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    color: #aaa;
    display: block;
    font-size: .35em;
    font-weight: 200;
}
@media (max-width: 768px){
    #timer {
        font-size: 1em;
        width: 100%;
    }
    #timer div {
        margin-right: 10px;
        width: auto;
    }
}

</style>

@php
$amounts = array(
500,
1000,
2000,
5000,
10000,
15000,
20000,
50000
)
@endphp
<script>

    function updateTimer(date) {
        let future = Date.parse(date);
        let now = new Date();
        let diff = future - now;

        let days = Math.floor(diff / (1000 * 60 * 60 * 24));
        let hours = Math.floor(diff / (1000 * 60 * 60));
        let mins = Math.floor(diff / (1000 * 60));
        let secs = Math.floor(diff / 1000);

        let d = days;
        let h = hours - days * 24;
        let m = mins - hours * 60;
        let s = secs - mins * 60;

        let final = '<div>' + d + '<span>Days</span></div>' +
                    '<div>' + h + '<span>Hours</span></div>' +
                    '<div>' + m + '<span>Minutes</span></div>' +
                    '<div style="margin-right: 0px !important;">' + s + '<span>Seconds</span></div>';

        return final;
    }

    // Alpine JS function

    function donationPage() {

        return {

            // Defining the variables

            form: {
                page_1: true,
                page_2: false,
            },

            donationType: 'campaign',
            donationAmount: 0,
            donationAmount_formatted: 0,
            showCustomDonationBlock: false,
            showCustomDonationButton: true,
            price: 0,

            razorpayForm: {
                name: '',
                email: '',
                phone: '',
                pan: '',
                address: '',
                checkbox_80g: true,
                checkbox_updates: true,
                checkbox_terms_and_conditions: false,
            },

            campaignName: '{{ $campaign->campaign_name }}',

            amountsArray: @json($amounts),

            timerHtml: '',

            causeName: null,

            // FUNCTIONS START!

            /*
                init - initialized when alpine takes over the DOM.
            */

            init() {
                setInterval(() => {
                    this.updateTimerHtml();
                }, 1000);
            },

            /*
                updateDonationAmount - the amount is passed into the fn.

                Triggered by @click event.

                Updates the donation amount on DOM,
                calculates the yield based on that amount.
            */

            updateDonationAmount(quantity) {
                this.donationAmount = quantity;
                this.formatMoney();
                this.showDonateButton();
            },

            updateDonationAmount_custom() {

                var quantity = document.getElementById('custom_donation').value;


                this.donationAmount = quantity;
                this.formatMoney();

                this.showCustomDonationBlock = false;
                this.showCustomDonationButton = true;

                this.showDonateButton();
            },

            updateTimerHtml() {

                let date = "{{ $campaign->campaign_end_date }}";
                if (date){this.timerHtml = updateTimer(date);}

            },

            /*
                toggleCustomDonation.

                Toggles custom donation block.
            */

            toggleCustomDonation() {
                this.showCustomDonationBlock = !this.showCustomDonationBlock;
                this.showCustomDonationButton = !this.showCustomDonationButton;
            },

            formatMoney() {
                this.donationAmount_formatted = parseInt((this.donationAmount)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            },


            showDonateButton() {
                if (this.donationAmount != 0) {
                    return true;
                } else {
                    return false;
                }
            },


            toggle80GExemption() {
                this.razorpayForm.checkbox_80g = !this.razorpayForm.checkbox_80g;
                document.getElementById('pan').required = this.razorpayForm.checkbox_80g ? "required" : "";
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
</script>
@endsection

@section('content')


<section class="section-header bg-dark mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <h1 class="display-4 text-white">
                    <div class="mt-2 mb-1 h2">
                        <span class="text-theme">
                            {{ $campaign->campaign_name }}
                        </span>
                    <br>
                    <small>
                        <span class="display-6">
                            {{ $campaign->campaign_description }}
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
            <div class="col-sm-12 col-md-10 col-lg-10">
                <div class="card shadow-lg border-gray-300 p-4 p-lg-5">

                    <div class="row" x-show="form.page_2">

                        {{-- TERMS AND CONDITIONS MODAL --}}

                        <div class="modal fade z-3" id="termsAndConditionsModal" tabindex="1" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content" style="width: 100%;">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Terms and conditions</h5>
                                    </div>                    
                                    <div class="modal-body m-3"> 
                                        
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                These rules and regulations (<b>“Terms and Conditions”</b>) shall be binding on each participant (<b>“Donor”</b> and/or <b>“You”</b>) who voluntarily desire to make monetary donations towards {{ config('app.ngo_name') }} (hereinafter referred to as <b>“trust”</b>).
                                            </div>
                                            <div class="col-12 mb-4">
                                                If you do not agree to be bound or cannot comply with any of the Terms and Conditions or the Privacy Policy, please do not continue with the Donation towards the Cause/Campaign. Your act of making the Donation shall be deemed as your unconditional agreement and acceptance to the Terms and Conditions and the Privacy Policy.
                                            </div>
                                            <div class="col-12 mb-4">
                                                This document is an electronic record in terms of Information Technology Act, 2000 and rules
                                                there under as applicable and the amended provisions pertaining to electronic records in various
                                                statutes as amended by the Information Technology Act, 2000. This electronic record is generated
                                                by a computer system and does not require any physical or digital signatures.
                                            </div>
                                            <div class="col-12 mb-4">
                                                <p class="display-5">General Rules</p>
                                            </div>
                                            <div class="row mb-4 px-4">
                                                <div class="col-12 mb-4">
                                                    <b>1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>Your participation via Donation through any mentioned means may result in certain instances
                                                    of sharing of your personal information including but not limited to your phone number, name,
                                                    PAN, credit and/or debit card (hereinafter referred to as <b>"Personal Information"</b>). By
                                                    donating, you are consenting to the use of such information, as governed
                                                    by this Terms and Conditions, by the Trust or by the service providers for the purposes
                                                    mentioned hereafter. Your information, if used, will be limited to sharing with entities including
                                                    but not limited to the Bank and the Trust for the purposes of making the Donation and shall
                                                    be bound by the Terms and Conditions and Privacy Policy. The Trust will
                                                    not sell the Donor's Personal Information at any time. For the purposes of clarity, any
                                                    information which is publically available and on the public domain will not be deemed as
                                                    Personal Information. You agree and acknowledge that the Trust will not be responsible
                                                    for any actions of any third party including any service provider with regard to Personal
                                                    Information.
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <b>2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>You agree and acknowledge that ,save and except for the accounting of your contribution
                                                    towards the Trust via the mode of SMS/ email , Your Donation is eligible for tax deduction
                                                    benefits under Section 80 G of the Indian Income Tax Act, 1961 if the Donor (s) is above the
                                                    age of eighteen (18) years and a resident of India (as per the Income Tax Act, 1961).
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <b>3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>The Donor(s) additionally represents and warrants that the Donor(s) is duly authorized to make
                                                    Donations to the trust as understood under these Terms and Conditions under applicable
                                                    laws.
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <b>4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>The Trust reserves all rights to make amendments to the existing Terms and Conditions
                                                    including the manner or conduits of making Donations towards the Cause/Campaign or withdraw the
                                                    Cause/Campaign without giving prior notice. It shall be the sole responsibility of the Donor(s) to check
                                                    the Terms and Conditions on the Website from time to time.
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <b>5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>The Trust reserves the right to change the Payment Mechanism or take such necessary
                                                    steps as it may deem fit in its sole and absolute discretion. It is clarified that Donations towards
                                                    the Trust are immediate and irrevocable. Once a Donation has been made for the Trust, no refund can be made of the
                                                    Donation; nor can the end purpose be changed. Additionally, the Donors represents and
                                                    undertakes that in case of a misappropriation whilst making a Donation, the Donor shall
                                                    address and seek redressal towards this issue strictly from the Trust and/or the Bank.
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <b>6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>Donor acknowledges that in case any portion/clause of these Terms and Conditions is deemed
                                                    invalid or becomes unenforceable or prohibited by the law of the country, such portions shall
                                                    be considered divisible and shall not be part of the consideration, and the remainder of these
                                                    Terms and Conditions shall be valid and binding and of like effect as though such provision
                                                    was not included herein.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                        
                                    </div>                
                                </div>
                            </div>
                        </div>                    

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
                                    <input type="text" class="form-control" name="name" required="required" />
                                </div>

                                <div class="mt-2 mb-3">
                                    <label for="name">E-mail ID <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required="required" />
                                </div>

                                <div class="mt-2 mb-3">
                                    <label for="name">Phone <span class="text-danger">*</span></label>
                                    <input type="phone" class="form-control" name="phone" maxlength="10" required="required" />
                                </div>

                                <div class="mt-2 mb-3">
                                    <label for="name">Address <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control" placeholder="Enter your address (as per Govt. ID)" required="required"></textarea>
                                </div>

                                <div class="mt-2 mb-3" x-show="razorpayForm.checkbox_80g">
                                    <label for="name">PAN Card <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pan" id="pan" maxlength="10" />
                                    <span class=" text-muted mt-2">
                                        <small>
                                            80G excemption receipt will carry this PAN number
                                        </small>
                                    </span>
                                </div>

                                <div class="mt-2 mb-3">
                                    <div class="form-check form-switch">
                                        <div @click="toggle80GExemption">
                                            <input class="form-check-input" type="checkbox" name="checkbox_80g" id="checkbox_80g" x-bind:checked="razorpayForm.checkbox_80g">
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
                                    <div class="form-check">
                                        <input @click="toggleContinueButton()" class="form-check-input" type="checkbox" value="" id="terms_and_conditions" x-bind:checked="razorpayForm.checkbox_terms_and_conditions" required style="cursor: pointer;">
                                        <label class="form-check-label" for="terms_and_conditions">
                                            I have read and I accept the <i><a data-bs-toggle="modal" data-bs-target="#termsAndConditionsModal">terms & conditions</a></i>
                                        </label>
                                    </div>
                                </div>

                                <input type="hidden" name="amount" x-model="donationAmount" />
                                <input type="hidden" name="cause" x-model="causeName"/>
                                <input type="hidden" name="campaign" x-model="campaignName" />

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

                        {{-- Campaign Details --}}
                        <div class="col-md-12 mx-auto text-center my-3">
                            <img src="/storage/{{ $campaign->campaign_poster }}" alt="{{ $campaign->title }}" class="img-fluid mx-auto rounded" style="max-height: 500px; max-width: 100%;"/>
                        </div>
                        <div class="col-md-12 mx-auto text-center border-top border-gray-300 my-2 ">

                            <div class="mb-3 mt-4">
                                <div class="card alpha-container text-white border-0 overflow-hidden mt-2">
                                    <div id="hero-section-image-container" class="card-img-bg"></div>

                                    <span class="mask bg-dark alpha-9"></span>

                                    <div class="card-body px-5 py-3">
                                        @if ($campaign->campaign_has_cause)
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="mt-2 mb-3">
                                                        <span class="h5">
                                                            <span class="text-theme">Cause(s): </span>
                                                        </span>
                                                        <span class="h5">
                                                            @foreach (json_decode($campaign->campaign_causes) as $cause)
                                                                <span>{{ App\Models\Causes::where(['id'=>(int) $cause])->first()->name }}; </span>
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="mt-2 mb-3">
                                                    <span class="h5">
                                                        <span class="text-theme">Location(s): </span>
                                                    </span>
                                                    <span class="h5">
                                                        @foreach (json_decode($campaign->campaign_location) as $location)
                                                            <span>{{ App\Models\Location::where(['id'=>(int) $location])->first()->location_name }}; </span>
                                                        @endforeach
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($campaign->campaign_end_date)
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="mt-3 mb-2">
                                                        <span class="h6 text-theme">
                                                            Campaign ends in
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12" id="countdown">
                                                    <div class="timer-wrap">
                                                        <div id="timer" x-html="timerHtml"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>


                            </div>


                        </div>

                        {{-- END Campaign details --}}


                        <div class="text-center col-md-12 mb-4">
                            @if(Session::has('error'))
                            <p class="alert alert-danger">{{Session::get('error')}}</p>
                            @endif
                            {{--<p class="small text-muted border-3 rounded-lg p-2">
                                <i class="fas fa-info-circle"></i> We are currently supporting <strong class="underline">{{ count($donation_types) }} causes</strong>. You can choose any cause,
                                and instantly see the calculated donation amount.
                            </p>--}}
                        </div>

                        <div class="col-md-12 mb-5">
                            <center>
                                <h2 class="display-4 mb-3">
                                    A small step for man <span class="font-bold fst-italic text-theme"><br>A giant leap for mankind</span>
                                </h2>
                                <p class="display-7 mb-3">
                                    Take your small step with us today and be part of the <strong class="text-theme">{{ $campaign->campaign_name }}</strong> campaign.
                                </p>
                            </center>
                            @if ($campaign->is_campaign_goal_based)
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:{{ $donation_details['donation_percentage'] >= 100 ? 100: $donation_details['donation_percentage'] }}%; height: 10px;"></div>
                                </div>
                                <h2 class="display-5 mt-2">
                                    We have raised <span class="font-bold text-theme">
                                        <span id="donation_amount">{{ CampaignsHelper::processMoney($donation_details['donation_amount']) }}</span>
                                    </span>
                                     out of our <span class="font-bold">{{ CampaignsHelper::processMoney($campaign->campaign_goal_amount) }}</span> goal.
                                </h2>
                            @endif
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="mb-3">
                                <label for="exampleInputEmail6">
                                    Amount (in Rs) you would like to donate
                                </label>

                                <div class="flex" style="flex-wrap: wrap">

                                    @foreach ($amounts as $quantity)
                                    <button type="button" class="border-3 m-1 rounded-lg" @click="updateDonationAmount({{ $quantity }});" style="width:80px;height:40px">
                                        {{ $quantity }}
                                    </button>
                                    @endforeach

                                    <button type="button" class="border-3 border-success m-1 rounded-lg" @click="toggleCustomDonation" x-show="showCustomDonationButton" style="width:80px;height:40px">
                                        Custom?
                                    </button>
                                </div>



                                <div class="" x-show="showCustomDonationBlock" @click.away="toggleCustomDonation">


                                    <p class="text-muted mt-2">
                                        <small>
                                            Enter a valid amount (in Rs) and press "process" button.
                                        </small>
                                    </p>

                                    <input type="number" class="form-control mt-3 mb-3" id="custom_donation" value="3" />



                                    <button type="button" class="btn btn-md btn-primary text-white" @click="updateDonationAmount_custom()">
                                        Process
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="text-center mt-4 col-md-12">
                            <div class="" x-show="showDonateButton()">
                                <button type="button" class="btn btn-success btn-block btn-lg text-white btn-zoom--hover btn-shadow--hover btn-animated btn-animated-x donate-btn" @click="togglePages()">
                                    <span class="btn-inner--visible">Donate <span class="">₹<span x-text="donationAmount_formatted"></span></span></span>
                                    <span class="btn-inner--hidden"><small>Process <i class="fas fa-arrow-right"></i></small></span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
