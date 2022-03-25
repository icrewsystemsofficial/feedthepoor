@php

@endphp
<!DOCTYPE html>
<html>
<body>    
    <div class="cont" style="padding: 40px; background: #fffef7; border-radius: 12px;">
        <img src="{{ asset('images/branding/roshni-foundation.png') }}" style="display: block; margin: 0 auto; height: 120px;">
        
        <hr style="background-color: #ebc04c; height: 2px; border: none; margin: 50px;">
        Dear <strong>{{ $details['name'] }}</strong>,<br><br>
        We have received your generous donation of <strong>₹ {{ $details['amount'] }}</strong> ({{ $details['amt_in_words'] }}) successfully for <strong>{{ $details['cause'] }}</strong>
        <br><br>
        The receipt for your donation is attached herewith this email.<br>
        @if ($details['pan']) 
            This receipt will be valid for 80G tax exemptions
        @endif
        <br><br>
        In an effort to keep the donations transparent, we have provided the ability to track your donation using a unique identification number.
        <br><br>
        <div class="panel" style="border-radius: 10px; background-color: #1c2540;padding: 30px;width: fit-content;">
            <div class="row" style="display: flex; flex-wrap: wrap;">
                <p style="color: #ebc04c"><strong>
                    DATE : &nbsp;
                </strong></p>
                <p style="color: #fff">{!! App\Helpers\CampaignsHelper::formatDate(date('Y-m-d')) !!}</p>
            </div>
            <div class="row" style="display: flex; flex-wrap: wrap;">
                <p style="color: #ebc04c"><strong>
                    AMOUNT : &nbsp;
                </strong></p>
                <p style="color: #fff">₹ {{ $details['amount'] }}</p>
            </div>
            <div class="row" style="display: flex; flex-wrap: wrap;">
                <p style="color: #ebc04c"><strong>
                    DONATION ID : &nbsp;
                </strong></p>
                <p style="color: #fff">{{ $details['id'] }}</p>
            </div>
        </div><br><br>
        <a target="_blank" href="{{ $details['tracking_url'] }}" style="background: #ebc04c;border-radius: 12px; border: 1px solid #ebc04c; color: #1f2937; box-shadow: #ebc04c 0px 0px 85px -4px; font-weight: 600; line-height: 24px; padding: 8px; text-alignt: center; text-decoration: none;">
            Track Donation
        </a><br><br>
        Regards,<br>
        Operations Team,<br>    
        {{ Config::get('app.ngo_name'); }}
    </div>
</body>
</html> 