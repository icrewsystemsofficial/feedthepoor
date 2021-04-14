@component('mail::message')
# Hey {{$data->name}},
Thanks for contacting us!
We've received your message.

@component('mail::panel')
    {{$data->message}}
@endcomponent

Our team will get in touch with you within the next 24-48 hours.

Regards,<br>
Team {{ config('app.name') }}
@endcomponent
