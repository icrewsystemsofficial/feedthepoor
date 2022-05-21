
@extends('pdf.receipts.layout')
@section('content')
<div class="container">
    <table width="100%">
      <tr>
        <td width="75px">
            <img src="{{ asset('images/branding/roshni-foundation.png') }}" alt="" srcset="" style="width: 90px; height: auto; padding-top: 20px;">
        </td>
        <td width="300px">
            <p style="padding-left: 10px; ">
                {{ config('app.ngo_name') }}
            </p>
            <div style="padding-left: 10px; font-size: 26px; margin-top: -15px; font-weight: bold;letter-spacing: -1px;">
                Donation Receipt
            </div>
        </td>
        <td></td>
      </tr>
    </table>
    <br><br>
    <p style="line-height: 18px; margin-top: -25px;">
        <strong>Dear {{ $data['payment']['name'] }}</strong>, <br><br>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Thank you for your generous donation towards {{ $data['payment']['cause'] }}. Please take comfort in knowing that this good deed,
        will be putting smiles in the faces of the less fortunate. Continue to support us, share the news with
        your friends and family, we need all the support we can get.
        <br><br>
        Warm regards, <br><br>
        <i>Darpan Moolchandani, <br>
            <span style="font-size: 12px;">
                Founder, <br>
                {{ config('app.ngo_name') }}
            </span>

        </i>
    </p>
    <table width="100%" style="border-collapse: collapse;">
      <tr>
        <td widdth="50%" style="background:#eee;padding:20px;">
          <strong>Date:</strong> {{ $data['payment']['date'] }}<br>
          <strong>Cause:</strong> {{ $data['payment']['cause'] }}<br>
          <strong>Tracking URL:</strong> <a href="{{ $data['payment']['tracking_url'] }}">{{ $data['payment']['tracking_url'] }}</a><br>
        </td>
      </tr>
    </table><br>



     <table width="100%" style="border-collapse: collapse;border-bottom:1px solid #eee;">
       <tr>
         <td width="40%" class="column-header">
            <strong>
                Donation Receipt
            </strong> <br>
            @if ($data['payment']['pan'])
                Eligible for 80G Tax Exemption
            @endif
         </td>
         <td width="20%" class="column-header"></td>
         <td width="20%" class="column-header"></td>
       </tr>
       <tr>
        <td class="row">
            <span style="color:#777;font-size:11px;">
               DONOR NAME & ADDRESS
           </span>
           <br>
           {{ $data['payment']['name'] }}, <br>
           {{ $data['user']->address ?? 'ADDRESS NOT PROVIDED' }}
       </td>
        <td class="row">
           <span style="color:#777;font-size:11px;">
               RECEIPT #
           </span>
           <br>
              {{ $data['payment']['receipt_no'] }}
        </td>
        <td class="row">
            <span style="color:#777;font-size:11px;">
                AMOUNT RECEIVED
            </span>
            <br>
            Rs. {{ $data['payment']['donation_amount'] }}

            <br><br>

            <span style="color:#777;font-size:11px;">
                PAYMENT MODE
            </span>
            <br>
            ONLINE

         </td>
      </tr>
       <tr>
        <td class="row">
            <span style="color:#777;font-size:11px;">
            PAN
        </span>
        <br>
        {{ $data['payment']['pan'] ?? 'NOT PROVIDED' }}
        </td>
        <td class="row">
           <span style="color:#777;font-size:11px;">
               PAYMENT #
           </span>
           <br>
           {{ $data['payment']['razorpay_id'] }}
        </td>
        <td class="row">
            <span style="color:#777;font-size:11px;">
                TRANSACTION DATE
            </span>
            <br>
            {{ $data['payment']['date'] }}
         </td>
      </tr>

    </table><br>

    <p style="text-align: center; font-size: 12px;">
        This is a computer generated receipt and does not require any stamp or signature.
    </p>

    <div style="padding-top: 50px; border-radius: 10px; background-color: #eaeaea; padding: 15px;">

        <span style="font-size: 20px; color: #292929;">
            {{ config('app.ngo_name') }}.
            <br>
        </span>
        <span style="font-size:15px; color: #292929;">
            India's most trusted NGO with 100% transparency.
        </span>
        <br><br>

        (Regd. as. {{ config('app.ngo_name') }},
        PAN: {{config('app.PAN')}} <br>
        ADDRESS: {{ config('app.address') }}
        <br><br>
        <i>For support, visit {{ config('app.url') }}/support or call +91 999999999</i>

        <br><br>
        Our IT Infrastructure is proudly built & maintained by <a href="https://icrewsystems.com/en?_ref={{ config('app.url') }}">icrewsystems</a> for free-of-charge.

        <br><br>
        Follow us on instagram <small>@roshni_foundation1</small> to see daily updates about our day-to-day operations
    </div>
    <br><br>
  </div><!-- container -->

@endsection
