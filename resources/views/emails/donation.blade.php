<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <div class="m-auto w-50 text-dark p-4">
    @component('mail::message')
        <h1 class="text-dark fs-2"> Hey {{ $details['name'] }}</h1>
        <p class="text-dark fs-3 fw-bolder">We have received your generous donation of <strong>₹ {{ $details['amount'] }}</strong> ({{ $details['amt_in_words'] }}) successfully for <strong>{{ $details['cause'] }}</strong></p>
        <p class="text-secondary fs-3 fw-bolder">
            The receipt for your donation is attached herewith this email.<br>
            @if (isset($details['pan'])) This receipt will be valid for 80G tax exemptions @endif
            <br><br>
            In an effort to keep the donations transparent, we have provided the ability to track your donation using a unique identification number.        
        </p><br><br>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Donation details</h1>
                <p class="card-text">
                    <strong>Date : </strong> {!! App\Helpers\CampaignsHelper::formatDate(date('Y-m-d')) !!}<br>
                    <strong>Amount : </strong> ₹ {{ $details['amount'] }}<br>
                    <strong>Donation ID : </strong> {{ $details['id'] }}<br>
                </p>                
                @component('mail::button', ['url' => $details['tracking_url']])Track donation @endcomponent
            </div>
        </div><br>
        <p class="text-secondary fs-3 fw-bolder">
            Regards,<br>
            Operations Team,<br>    
            {{ Config::get('app.ngo_name'); }}
        </p>
    @endcomponent
    </div>


</body>

</html>