@component('mail::message')
# Hey {{ $user_name }}
Your donation towards {{ $cause }} has been assigned to a mission and is on its way to fill a person's heart.

@component('mail::panel')
## Mission Details
<strong>Execution Date : </strong> {!! $mission->execution_date->formatDate(date('Y-m-d')) !!}<br>
<strong>Location : </strong> {{ App\Helpers\MissionHelper::getLocationName($mission->location_id) }}<br>
<strong>Field Manager : </strong> {{ App\Helpers\MissionHelper::getUserName($mission->field_manager_id) }}<br>
<strong>Volunteers : </strong> @foreach ($volunteers as $id) {{ App\Helpers\MissionHelper::getUserName($id) }} @endforeach    
<strong>Mission Status : </strong> {{ App\Helpers\MissionHelper::getStatusName($mission->status) }}<br>
@endcomponent

Regards,<br>
Operations Team,<br>
{{ config('app.ngo_name') }}
@endcomponent
