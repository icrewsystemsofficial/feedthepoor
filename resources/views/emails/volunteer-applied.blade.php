@component('mail::message')
# Hey {{ $details['name'] }},

We have received your volunteer application request. Our Team is going through your application request and validating it

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
