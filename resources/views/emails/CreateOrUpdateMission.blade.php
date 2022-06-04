@component('mail::message')
# Hey {{ $user_name }}
{{ $message }}

@component('mail::panel')
## Mission Details
<strong>Execution Date : </strong> {!! date('D M Y', strtotime($mission->execution_date)) !!}<br>
<strong>Location : </strong> {{ App\Helpers\MissionHelper::getLocationName($mission->location_id) }}<br>
<strong>Field Manager : </strong> {{ App\Helpers\MissionHelper::getUserName($mission->field_manager_id) }}<br>
<strong>Volunteers : </strong> @foreach ($mission->assigned_volunteers as $id) {{ App\Helpers\MissionHelper::getUserName($id) }} @endforeach    
<strong>Mission Status : </strong> {{ App\Helpers\MissionHelper::getStatusName($mission->status) }}<br>
@endcomponent

Regards,<br>
Operations Team,<br>
{{ config('app.ngo_name') }}
@endcomponent
