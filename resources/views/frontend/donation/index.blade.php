@extends('layouts.frontend')

@section('css')
@php
$donation_quantities = array(
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
            donationQuantity: 1,
            donationAmount_formatted: 0,
            showCustomDonationBlock: false,
            showCustomDonationButton: true,
            campaignName: null,
            price: 0,


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
                address: '',
                checkbox_80g: true,
                checkbox_updates: true,
                checkbox_terms_and_conditions: false,
            },

            causesArray: @json($donation_types),
            //donationType: @json($donation_types),
            donationTypesArray: @json($donation_types), // Converting php array to json. Thanks to Laravel

            // FUNCTIONS START!

            /*
                init - initialized when alpine takes over the DOM.
            */

            init() {
                this.selectedCause.cause = document.getElementById('selectedCause').value;
                this.price = this.causesArray[this.selectedCause.cause]['per_unit_cost'];
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
                // this.calculateYield(this.donationAmount);
                this.calculatePrice(this.donationQuantity);
            },

            /*
                updateDonationAmount - the amount is passed into the fn.

                Triggered by @click event.

                Updates the donation amount on DOM,
                calculates the yield based on that amount.
            */

            // TODO DEPRECATE THIS!
            updateDonationAmount(amount) {

                this.donationAmount = amount * this.price;
                this.donationQuantity = amount;
                // this.calculateYield(amount, this.selectedCause.PerUnitCost);
                this.formatMoney();
            },

            updateDonationQuantity(quantity) {
                this.donationQuantity = quantity;
                this.calculatePrice(quantity);
                this.formatMoney();
            },

            updateDonationQuantity_custom() {

                var quantity = document.getElementById('custom_donation').value;


                this.donationQuantity = quantity;
                this.calculatePrice(quantity);
                this.formatMoney();

                this.showCustomDonationBlock = false;
                this.showCustomDonationButton = true;
            },

            updateDonationAmount_custom() {
                // this.calculateYield(this.donationAmount, this.selectedCause.PerUnitCost);
                this.showCustomDonationBlock = false;
            },


            calculatePrice(quantity) {
                var per_unit_cost = this.causesArray[this.selectedCause.cause]['per_unit_cost'];

                this.donationAmount = per_unit_cost * quantity;
                this.formatMoney();

                if (quantity == 0 || quantity < 0) {
                    if (this.donationAmount == 0) {
                        this.errors.insuffucientDonationAmount = false;
                        this.selectedCause.YieldContext = '<span class="text-danger font-medium">Please choose a quantity to process</span>';
                    } else {
                        this.errors.insuffucientDonationAmount = true;
                        this.selectedCause.YieldContext = '<span class="text-danger fw-bolder">Try choosing a different cause or higher donation amount</span>';
                    }
                } else {
                    this.errors.insuffucientDonationAmount = false;
                    // this.selectedCause.Yield = yield;
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
                    this.selectedCause.YieldContext = '<span class="text-danger">Please select quantity and click donate</span>';
                } else {
                    var yield_context = this.causesArray[this.selectedCause.cause]['yield_context'];
                    var yield = '<span class="fw-bolder text-success">' + this.selectedCause.Yield + '</span>';

                    // In the DB, the context will be saved with a %YIELD% string.
                    // we're replacing it using js.

                    // yield_context = yield_context.replace("%YIELD%", yield); # DEPRECATED.
                    yield_context = yield_context.replace("%CALCULATED_AMOUNT%", this.donationAmount);
                    yield_context = yield_context.replace("%CAUSE%", this.selectedCause.cause);
                    yield_context = yield_context.replace("%USER_INPUT_QUANTITY%", this.donationQuantity);

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
                                <input type="hidden" name="cause" x-model="selectedCause.cause" />
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

                        {{-- Error template --}}
                        <div class="col-md-12 mx-auto" x-show="errors.insuffucientDonationAmount" x-transition:enter="animate__zoomIn" x-transition:enter-start="animate__zoomIn" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                            <div class="alert alert-danger text-danger" role="alert">
                                <span class="h4 fw-bolder text-danger">
                                    Ooops!
                                </span>
                                <br>
                                The procurement / per unit cost for "<span x-text="selectedCause.cause" class="fw-bold"></span>" is higher than the chosen donation amount.
                                You can either choose a higher donation amount or try a different cause
                            </div>
                        </div>

                        {{-- END Error template --}}


                        <div class="text-center col-md-12 mb-4">
                            @if(Session::has('error'))
                            <p class="alert alert-danger">{{Session::get('error')}}</p>
                            @endif
                            <p class="small text-muted border-3 rounded-lg p-2">
                                <i class="fas fa-info-circle"></i> We are currently supporting <strong class="underline">{{ count($donation_types) }} causes</strong>. You can choose any cause,
                                and instantly see the calculated donation amount.
                            </p>
                        </div>

                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="my-1 ml-1" for="inlineFormCustomSelectPref">
                                    Which cause would you like to donate for?
                                </label>
                                <select class="form-select" id="selectedCause" x-model="selectedCause.cause" aria-label="Please select a cause" @change="updateDonationCause">
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
                                        {{ ucfirst($donation_type->name) }} - (₹{{ number_format($donation_type->per_unit_cost, 0, '.', ',') }} per donation/unit)
                                    </option>
                                    @php
                                    $first_iteration = false;
                                    @endphp
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 text-center">
                            <div class="mb-3">
                                <label for="exampleInputEmail6">
                                    How many quantity would you like to donate?
                                </label>




                                <div class="flex" style="flex-wrap: wrap">

                                    @foreach ($donation_quantities as $quantity)
                                    <button type="button" class="border-3 m-1 rounded-lg" @click="updateDonationQuantity({{ $quantity }});" style="width:80px;height:40px">
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
                                            Enter a valid quantity and press "process" button.
                                        </small>
                                    </p>

                                    <input type="number" class="form-control mt-3 mb-3" id="custom_donation" value="3" />



                                    <button type="button" class="btn btn-md btn-primary text-white" @click="updateDonationQuantity_custom()">
                                        Process
                                    </button>
                                </div>

                            </div>
                        </div>

                        {{-- START Causes name & icon card --}}



                        <div class="col-md-12 mx-auto text-center border-top border-gray-300 my-4 ">

                            <div class="mb-3 mt-4">


                                <div class="card alpha-container text-white border-0 overflow-hidden mt-2">
                                    <div id="hero-section-image-container" class="card-img-bg" style="background-image: url('https://images.milaap.org/milaap/image/upload/v1590737431/production/images/uploader_images/IMG-20200426-WA0015_1590737429.jpg?format=jpg&mode=max&width=1170');"></div>

                                    <span class="mask bg-dark alpha-9"></span>

                                    <div class="card-body px-5 py-5">
                                        <div style="min-height: 100px;">
                                            <div class="mt-2 mb-1 lh-180">
                                                <div style="padding-top: 50px;">
                                                    <i x-bind:class="selectedCause.icon" x-transition:enter.duration.500ms x-transition:leave.duration.400ms></i>
                                                </div>
                                            </div>

                                            <div class="mt-5 h3">
                                                <span x-text="selectedCause.cause"></span>
                                            </div>

                                            <div class="text-center mt-4">
                                                <div class="" x-show="showDonateButton()">
                                                    <button type="button" class="btn btn-success btn-block btn-lg text-white btn-zoom--hover btn-shadow--hover btn-animated btn-animated-x donate-btn" @click="togglePages()">
                                                        <span class="btn-inner--visible">Donate <span class="">₹<span x-text="donationAmount_formatted"></span></span></span>
                                                        <span class="btn-inner--hidden"><small>Process <i class="fas fa-arrow-right"></i></small></span>
                                                    </button>
                                                </div>

                                                <p class="text-sm text-bg-gray mt-2">
                                                    <span x-html="selectedCause.YieldContext"></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>

                        {{-- END Causes name & icon card --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection