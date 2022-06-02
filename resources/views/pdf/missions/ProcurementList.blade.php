
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
@endsection
