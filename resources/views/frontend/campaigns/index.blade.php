@extends('layouts.frontend')

@section('css')
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
    animation: fromLeft .7s ease-in-out forwards;
}

#timer div {
    font-family: 'Roboto', sans-serif;
    display: inline-block;
    width: 90px;
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

.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 25px;
  background-color: #ee5166;
  background-image: linear-gradient(to right, #ee5166 0%, #f08efc var(--percentage),  #fff var(--percentage), #fff 100%);
  outline: none;
  border: 1px solid #ebc04c;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 35px;
  height: 35px;
  background: red;
  background-clip:content-box;
  border: 5px solid red;
  padding: 2px;
  border-radius: 50%;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  background: red;
}

</style>

@php
$amounts = array(
1,
2,
5,
10,
15,
20,
50
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
                    '<div>' + s + '<span>Seconds</span></div>';
        
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
            <div class="col-sm-12 col-md-10 col-lg-10   ">
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
                                    <div class="form-check" @click="toggleContinueButton()">
                                        <input class="form-check-input" type="checkbox" value="" id="terms_and_conditions" x-bind:checked="razorpayForm.checkbox_terms_and_conditions">
                                        <label class="form-check-label" for="terms_and_conditions">
                                            I have read and I accept the <a href="#">terms & conditions</a>
                                        </label>
                                    </div>
                                </div>

                                <input type="hidden" name="amount" x-model="donationAmount" />
                                <input type="hidden" name="cause" />
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
                        <div class="col-md-12 mx-auto text-center border-top border-gray-300 my-4 ">

                            <div class="mb-3 mt-4">


                                <div class="card alpha-container text-white border-0 overflow-hidden mt-2">
                                    <div id="hero-section-image-container" class="card-img-bg" style="background-image: url('{{ $campaign->campaign_poster }}');"></div>

                                    <span class="mask bg-dark alpha-9"></span>

                                    <div class="card-body px-5 py-3">
                                        <div style="min-height: 100px;">

                                            <div class="mt-2 mb-1 h1">
                                                <div style="padding-top: 50px;">
                                                    <span>{{ $campaign->campaign_name }}</span>    
                                                </div>
                                            </div>

                                            <div class="mt-5 h3">
                                                <span>{{ $campaign->campaign_description }}</span>
                                            </div>                                                                                        

                                        </div>
                                    </div>

                                    <div class="card-body px-5 py-5">
                                        @if ($campaign->campaign_has_cause)                                                                                    
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="mt-2 mb-3">
                                                        <span class="h4">
                                                            <span class="text-theme">Causes : </span>
                                                        </span>
                                                        <span class="h4">
                                                            @foreach (json_decode($campaign->campaign_causes) as $cause)
                                                                <span>{{ App\Models\Causes::where(['id'=>(int) $cause])->first()->name }}, </span>                                                            
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="mt-2 mb-3">
                                                    <span class="h4">
                                                        <span class="text-theme">Locations : </span>
                                                    </span>
                                                    <span class="h4">
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
                                                    <div class="mt-3 mb-3">
                                                        <span class="h5">
                                                            Campaign ends in
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-12 col-12" id="countdown">
                                                <div class="timer-wrap">
                                                    <div id="timer" x-html="timerHtml"></div>
                                                </div>
                                            </div>
                                        </div>
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
                                <input disabled="true" type="range" min="1" max="100" value="{{ $donation_details['donation_percentage'] }}" class="slider" id="myRange">
                                <h2 class="display-5 mt-2">
                                    <span class="font-bold fst-italic text-theme">
                                        <span id="donation_amount">₹{{ $donation_details['donation_amount'] }}</span>
                                    </span>
                                     raised of ₹{{ $campaign->campaign_goal_amount }}
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