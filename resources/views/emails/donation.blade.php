@component('mail::message')
# Hey {{ $details['name'] }}
We have received your generous donation of <strong>₹{{ number_format($details['amount'], '0', '.', ',') }}</strong> ({{ $details['amt_in_words'] }}) successfully towards
<strong>{{ isset($details['cause']) ? 'the '.$details['cause'] . ' cause' : 'the '.$details['campaign'] . ' campaign' }}.</strong>

The receipt for your donation will be available on our website using a unique identification number, which is attached along with this e-mail. This receipt will be
available to you till the end of this financial year. <br>
@if (isset($details['pan'])) This receipt will be valid for 80G tax exemptions @endif
In an effort to keep the donations transparent, we have provided the ability to track your donation using a unique identification number.

@component('mail::button', ['url' => $details['tracking_url']]) Track donation @endcomponent

@component('mail::panel')
## Donation Details
<strong>Date : </strong> {!! App\Helpers\CampaignsHelper::formatDate(date('Y-m-d')) !!}<br>
<strong>Amount : </strong> ₹{{ number_format($details['amount'], '0', '.', ',') }}<br>
<strong>Donation ID : </strong> {{ $details['id'] }}<br>
@endcomponent

@component('mail::button', ['url' => route('frontend.donations.receipt', $details['id'])]) Download Receipt @endcomponent
{{-- <p>
    <small>
        Incase you are unable to open the PDF attachment, use this link to view your PDF online.
        <a href="{{ route('frontend.donations.receipt', $details['id']) }}">{{ route('frontend.donations.receipt', $details['id']) }}</a>
    </small>
</p> --}}

Regards,<br>
Operations Team,<br>
{{ config('app.ngo_name') }}
@endcomponent
