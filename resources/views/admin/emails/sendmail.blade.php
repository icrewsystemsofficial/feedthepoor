@component('mail::message')
# {{ $data->subject }}

{{ $data->message }}

Regards,<br>
{{ Auth::user()->name }}<br />
<small>{{ config('app.name') }} Team</small>
@endcomponent
