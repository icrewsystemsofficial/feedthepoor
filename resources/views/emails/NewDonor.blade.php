@component('mail::message')
# Hey {{ $user->name }}

Regards,<br>
Operations Team,<br>
{{ config('app.ngo_name') }}
@endcomponent
