@component('mail::message')
# Hey {{ $user_name }}
You have been selected to be a <b>field manager</b> for the following mission:

@component('mail::panel')
## Mission Details
<strong>Execution Date : </strong> {!! $mission->execution_date->formatDate(date('Y-m-d')) !!}<br>
<strong>Location : </strong> {{ App\Helpers\MissionHelper::getLocationName($mission->location_id) }}<br>
<strong>Field Manager : </strong> {{ App\Helpers\MissionHelper::getUserName($mission->field_manager_id) }}<br>
<strong>Volunteers : </strong> @foreach ($volunteers as $id) {{ App\Helpers\MissionHelper::getUserName($id) }} @endforeach    
<strong>Mission Status : </strong> {{ App\Helpers\MissionHelper::getStatusName($mission->status) }}<br>
@endcomponent
@component('mail::button', ['url' => route('admin.missions.reply', ['mission_id' => $mission->id, 'user_id' => $user_id])])Click to accept/reject @endcomponent