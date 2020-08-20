@component('mail::message')
# {{ $data->subject }}

{{ $data->message }}

Regards,<br>
Team feed the Poor<br />
<small>{{ config('app.name') }} Team</small>
@endcomponent
