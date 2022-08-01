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
);
@endphp
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
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
                var btn = document.getElementById('btn-'+ quantity);
                this.donationQuantity = quantity;

                btn.classList.add("border-success");
                this.calculatePrice(quantity);
                this.formatMoney();

                setTimeout(() => {
                    btn.classList.remove('border-success');
                }, 2000);
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
                document.getElementById('pan').required = this.razorpayForm.checkbox_80g ? "required" : "";
                document.getElementById('pan').value = this.razorpayForm.checkbox_80g ? document.getElementById('pan').value : "";
            },

            toggleContinueButton() {
                this.razorpayForm.checkbox_terms_and_conditions = !this.razorpayForm.checkbox_terms_and_conditions;
            },

            togglePages() {

                // This scrolls up the page
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

                var modal = document.getElementById("max_amount_reached_modal");
                var btn = document.getElementById("myBtn");
                var span = document.getElementsByClassName("close")[0];

                // 5 Lakhs INR is the max amount that's
                // accepted by Razorpay API.

                if (this.donationAmount > 500000) {
                    btn.onclick = function() {
                        modal.style.display = "block";
                    }
                    span.onclick = function() {
                        modal.style.display = "none";
                    }
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                } else {
                    this.form.page_1 = !this.form.page_1;
                    this.form.page_2 = !this.form.page_2;
                }
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

                        {{-- TERMS AND CONDITIONS MODAL --}}

                        <div class="modal fade" id="termsAndConditionsModal" tabindex="1" aria-hidden="true" style="display: none;">
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
                                                    steps as it may deem fit in its sole and absolute discretion. The Donor(s) represents and
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

                        {{-- DONATIONS POLICY --}}

                        <div class="modal fade" id="donationsPolicyModal" tabindex="1" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content" style="width: 100%;">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Donations Policy And Guidelines</h5>
                                    </div>
                                    <div class="modal-body m-3">
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                Donations and other income enable Roshni Moolchandani Charitable Trust to fight corruption. Roshni Moolchandani Charitable Trust needs to secure the funding necessary to undertake its vital work. Secure and diverse funding enables Roshni Moolchandani Charitable Trust to maintain its independence, protect its reputation and operate effectively.
                                            </div>
                                            <div class="col-12 mb-4">
                                                <p class="display-5">Policy</p>
                                                It is Roshni Moolchandani Charitable Trust's policy to accept funding from any donor and whether monetary or in kind, provided that acceptance does not:
                                                <br>
                                                - Impair Roshni Moolchandani Charitable Trust's independence to pursue its mission
                                                <br>
                                                - Endanger its integrity and reputation.
                                            </div>
                                            <div class="col-12 mb-4">
                                                <p class="display-5">Scope</p>
                                                This Policy applies to all fundraising, regardless of types of donor or amounts involved, unless otherwise stated in this document. It is to be applied to all new funding from existing donors and to all new donors in the future. It does not apply to income raised from the sale of publications or from fees for participation in conferences, events and other activities. Appropriate care to protect the reputation of Roshni Moolchandani Charitable Trust should always be taken.
                                            </div>
                                            <div class="col-12 mb-4">
                                                <p class="display-5">Guidelines</p>
                                                Funding to enable Roshni Moolchandani Charitable Trust to carry out their work should be sought from a wide range of sources. Care should be taken to ensure that project-related funding does not result in undue influence over Roshni Moolchandani Charitable Trust's programme work. Subject to maintaining Roshni Moolchandani Charitable Trust's independence and reputation, Roshni Moolchandani Charitable Trust may accept funding from all kinds of sources.
                                                <br>
                                                If there is a significant risk that receiving funds from a particular source would impair Roshni Moolchandani Charitable Trust's independence or if there is a significant risk to Roshni Moolchandani Charitable Trust’s reputation from public association with the donor, then funding from that source must not be accepted by Roshni Moolchandani Charitable Trust.
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
                                    <label for="name" id="name">Full Name (as per Govt. ID) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" required="required" autofocus/>
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
                                    <input type="text" class="form-control" name="pan" id="pan" maxlength="10" required/>
                                    <span class=" text-muted mt-2">
                                        <small>
                                            80G exemption receipt will carry this PAN number
                                        </small>
                                    </span>
                                </div>

                                <div class="mt-2 mb-3">
                                    <div class="form-check form-switch">
                                        <div @click="toggle80GExemption">
                                            <input class="form-check-input" type="checkbox" name="checkbox_80g" id="checkbox_80g" x-bind:checked="razorpayForm.checkbox_80g">
                                            <label class="form-check-label" for="checkbox_80g">
                                                I want 80G Income Tax exemption
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
                                    <a class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#donationsPolicyModal">
                                        Donations Policy
                                    </a>
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
                                <input type="hidden" name="cause" x-model="selectedCause.cause" />
                                <input type="hidden" name="campaign" x-model="campaignName" />

                                <div class="mt-2 mb-3" x-show="razorpayForm.checkbox_terms_and_conditions">
                                    <button class="btn btn-success btn-md text-white">
                                        Proceed to donate via Razorpay
                                    </button>

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
                                    <button type="button" class="border-3 m-1 rounded-lg" id="btn-{{ $quantity }}"  @click="updateDonationQuantity({{ $quantity }});" style="width:80px;height:40px">
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
                                                    <button type="button" class="btn btn-success btn-block btn-lg text-white btn-zoom--hover btn-shadow--hover btn-animated btn-animated-x donate-btn" @click="togglePages()" id="myBtn">
                                                        <span class="btn-inner--visible">Donate <span class="">₹<span x-text="donationAmount_formatted"></span></span></span>
                                                        <span class="btn-inner--hidden"><small>Process <i class="fas fa-arrow-right"></i></small></span>
                                                    </button>
                                                </div>

                                                <p class="text-sm text-bg-gray mt-2">
                                                    <span x-html="selectedCause.YieldContext"></span>
                                                </p>


                                                <!-- Button trigger modal -->
                                                <div id="max_amount_reached_modal" class="modal">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content bg-danger">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Whoops!</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="">Hello!🙏 We are unable to accept payments greater than 5,00,000 INR via Razorpay. We appreciate your kindness and generosity ❤, please get in touch with our Relationship Manager, Ms. Neha on 📞 (+091) 95831 86287 to know how to continue with this donation.</p>

                                                                <p>
                                                                    <small>
                                                                        You can refresh this page to reset.
                                                                    </small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
