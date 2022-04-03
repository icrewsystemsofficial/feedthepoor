@component('mail::message')
# Hey {{ $details['name'] }}
We have received your generous donation of <strong>₹{{ $details['amount'] }}</strong> ({{ $details['amt_in_words'] }}) successfully for <strong>{{ $details['cause'] }}</strong>

The receipt for your donation is attached herewith this email.<br>
@if (isset($details['pan'])) This receipt will be valid for 80G tax exemptions @endif
In an effort to keep the donations transparent, we have provided the ability to track your donation using a unique identification number.

@component('mail::panel')
## Donation Details
<strong>Date : </strong> {!! App\Helpers\CampaignsHelper::formatDate(date('Y-m-d')) !!}<br>
<strong>Amount : </strong> ₹{{ $details['amount'] }}<br>
<strong>Donation ID : </strong> {{ $details['id'] }}<br>
@endcomponent
@component('mail::button', ['url' => $details['tracking_url']])Track donation @endcomponent

Regards,<br>
Operations Team,<br>
{{ config('app.ngo_name') }}
@endcomponent
