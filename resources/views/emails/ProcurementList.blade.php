@component('mail::message')
# Hey {{ $field_manager }}
Attached with this email is the procurement list for today's mission.

Regards,<br>
Operations Team,<br>
{{ config('app.ngo_name') }}
@endcomponent
