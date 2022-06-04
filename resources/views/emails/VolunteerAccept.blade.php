@component('mail::message')
# Hey {{ $user_name }}
You have been selected to be a <b>volunteer</b> for the following mission:

@component('mail::panel')
## Mission Details
<strong>Execution Date : </strong> {!! date('D M Y', strtotime($mission->execution_date)) !!}<br>
<strong>Location : </strong> {{ App\Helpers\MissionHelper::getLocationName($mission->location_id) }}<br>
<strong>Field Manager : </strong> {{ App\Helpers\MissionHelper::getUserName($mission->field_manager_id) }}<br>
<strong>Volunteers : </strong> @foreach ($mission->assigned_volunteers as $id) {{ App\Helpers\MissionHelper::getUserName($id) }} @endforeach    
@endcomponent

@component('mail::button', ['url' => route('admin.missions.reply.index', ['mission_id' => $mission->id, 'user_id' => $user_id])])Click to accept/reject @endcomponent