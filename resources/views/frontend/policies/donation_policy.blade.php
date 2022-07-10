@extends('layouts.frontend')
@section('meta')
<title>
    {{ config('app.name') }} | Donate Transparently
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection
@section('css')
<style>
    .navbar-main {
        background-color: #1F2937 !important;
    }
</style>
@endsection
@section('js')
@endsection
<section class="section section-lg pt-6">
  <div class="container">
    <div class="row justify-content-center mb-5 mb-lg-6">
      <div class="col-12 col-lg-8">
        <div class="card border-0 p-2 p-md-3 p-lg-5">
          <div class="card-header bg-white border-0 text-center">
            <h2>Policies</h2>
            <p>Donation Policy last updated on 11th day of July, 2022</p>
          </div>
          <div class="card-body px-0 pt-0">
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
        </div>
      </div>
    </div>
  </div>
</section>
