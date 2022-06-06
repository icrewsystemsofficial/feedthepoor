@extends('layouts.frontend')

@section('css')

@endsection

@section('content')


<section class="section-header bg-dark mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <h1 class="display-4 text-white">
                    <div class="mt-2 mb-1 h2">
                        <span class="text-theme">
                            Donation activities
                        </span>
                    <br>
                    <small>
                        <span class="display-6">
                            in {{ config('app.ngo_name') }}
                        </span>
                    </small>
                </h1>
            </div>
        </div>
    </div>
</section>

<section class="">
    <div class="container mt-n6 z-2 mb-5">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-10">
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
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
