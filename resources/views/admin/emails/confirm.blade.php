@component('mail::message')
# Hey {{$payment->notes->name}},

We sincerely thank you for your generosity and support.
We've successfully received your donation. Kindly find your receipt attached herewith.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
