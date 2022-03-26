@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/4.0.0-alpha.1/js/bootstrap-switch.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/4.0.0-alpha.1/css/bootstrap-switch.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<style>
    .badge-warning {
        background-color: #f0ad4e;
        color: #fff;
    }
    .badge-success {
        background-color: #5cb85c;
        color: #fff;
    }
    .badge-danger {
        background-color: #d9534f;
        color: #fff;
    }
    .badge-info {
        background-color: #5bc0de;
        color: #fff;
    }
    .action-btns {
        width: fit-content;
    }
    input[type="date"]::-webkit-inner-spin-button,
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }
    .hide-date, .hide-goal, .hide-cause {
        display: none !important;
    }
    .show-date, .show-goal, .show-cause {
        display: block !important;
    }
    .form-check {
        padding-left: 0px !important;
    }
    .bootstrap-switch .bootstrap-switch-handle-on,
    .bootstrap-switch .bootstrap-switch-handle-off,
    .bootstrap-switch .bootstrap-switch-label {
        display: inline-block;
        width: 44%;
    }
    .select2 {
        width: 100% !important;
    }
    .hide-badge {
        display: none;
    }
    .show-badge {
        display: block;
        width: fit-content;
    }
</style>

<style>
    .badge-danger {
        background-color: #d9534f;
        color: #fff;
        border-color: transparent;
    }
    .badge-danger:hover {
        background-color: #d9534f;
        color: #fff;
        border-color: transparent;
    }
    .delete-modal {
        font-size: 1.2rem !important;
    }
</style>
@endsection

@section('js')
<script>
    function trigger_delete() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

            Swal.showLoading();

            if (result.isConfirmed) {


                setTimeout(() => {
                    Swal.fire(
                        'Alright!',
                        'Campaign is being deleted..',
                        'success'
                    );

                    document.getElementById('delete_campaign_form').submit();
                }, 1500);
            }
        });
    }
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Campaigns <span class="text-muted">></span> Manage
        </h3>
        <p class="mt-n2">
            <small>
                Edit/delete existing campaigns
            </small>
        </p>
    </div>
</div>
<div class="row mb-3">
    <div class="col-6">
        <div class="flex d-flex">
            <div>
                <a href="{{ route('admin.campaigns.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-angle-left me-2"></i> Back
                </a>
            </div>

            <div class="ml-2">
                &nbsp;
            </div>



            <div class="">
                <button class="btn btn-danger" type="button" onclick="trigger_delete();">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>

                {{-- This form is submitted by JS method --}}
                <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" id="delete_campaign_form" method="POST">@csrf @method('DELETE')</form>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="row">
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
<div class="card mt-3">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-12">
            <form action="{{ route('admin.campaigns.update', $campaign->id) }}" id="update_form" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Campaign name</label>
                    <input type="text" id="campaign_name" name="campaign_name" class="form-control" value="{{ $campaign->campaign_name }}"/>
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Campaign description</label>
                    <textarea name="campaign_description" id="campaign_description" class="form-control">{{ $campaign->campaign_description }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="campaign_poster" class="form-label">Campaign poster</label>                    
                    <input type="file" id="campaign_poster" name="campaign_poster" class="form-control mb-3"/>
                    <a href="/storage/{{ $campaign->campaign_poster }}" target="_blank" class="btn btn-primary"><i class="fa-solid fa-eye"></i> View poster</a>
                </div>
                <div class="form-group mb-3">
                    <label for="campaign_goal_amount" class="form-label">Expected campaign amount (in INR)</label>
                    <input type="number" id="campaign_goal_amount" name="campaign_goal_amount" class="form-control" value="{{ $campaign->campaign_goal_amount }}"/>
                </div>            
                {{--<div class="form-group mb-3">
                    <label for="is_campaign_based_on_goal" class="form-label">Does the campaign have a goal?</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_campaign_goal_based" name="is_campaign_goal_based" {{ $campaign->is_campaign_goal_based ? 'checked':'' }}>
                    </div>   
                </div> --}}
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Campaign start date</label>
                    <input type="date" id="campaign_start_date" name="campaign_start_date" class="form-control" value="{{ $campaign->campaign_start_date }}"/>
                </div>
                <div class="form-group mb-3>
                    <label for="name" class="form-label">Campaign end date</label>
                    <input type="date" id="campaign_end_date" name="campaign_end_date" class="form-control" value="{{ $campaign->campaign_end_date }}"/>
                </div>
                <div class="form-group mb-3">
                    <label for="campaign_location" class="form-label">Campaign location</label>
                    <select name="campaign_location[]" id="campaign_location" class="form-control" multiple>                        
                        {!! App\Helpers\CampaignsHelper::getLocationsForManage($campaign->campaign_location) !!}
                    </select>
                </div>
                {{--<div class="form-group mb-3">
                    <label for="campaign_has_cause" class="form-label">Does the campaign have a cause?</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="campaign_has_cause" name="campaign_has_cause" {{ $campaign->campaign_has_cause ? 'checked':'' }}>
                    </div>   
                </div>--}}
                <div class="form-group mb-3>
                    <label for="campaign_causes" class="form-label">Campaign causes</label><br>
                    <select name="campaign_causes[]" id="campaign_causes" class="form-control" multiple>                        
                        {!! App\Helpers\CampaignsHelper::getCausesForManage($campaign->campaign_causes) !!}
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="status" class="form-label">Campaign status&nbsp;&nbsp;</label>
                    <div class="mb-2">{!! App\Helpers\CampaignsHelper::getStatusBadges($campaign->campaign_status) !!}</div>
                    <select class="form-control" id="status" name="campaign_status">
                        {!! App\Helpers\CampaignsHelper::getAllStatuses($campaign->campaign_status) !!}
                    </select>
                </div>
                <div class="form-group mb-3">
                    <span onclick="document.getElementById('update_form').submit();">
                        <x-loadingbutton>Save</x-loadingbutton>
                    </span>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {       
        $('#status').on('change',()=>{
            let val = '#'+$('#status option:selected').text();
            $('.show-badge').addClass('hide-badge');
            $('.show-badge').removeClass('show-badge');            
            $(val).removeClass('hide-badge');
            $(val).addClass('show-badge');            
        });
        /*$('#campaign_has_cause').bootstrapSwitch({
            onText: 'Yes',
            offText: 'No',
            onColor: 'primary',
            offColor: 'danger',
        });
        $('#is_campaign_goal_based').bootstrapSwitch({
            onText: 'Yes',
            offText: 'No',
            onColor: 'primary',
            offColor: 'danger',
        });*/
        const picker = new Litepicker({ 
            element: document.getElementById('campaign_start_date'),
            resetButton: true,
        });
        const picker2 = new Litepicker({ 
            element: document.getElementById('campaign_end_date'),
            resetButton: true, 
        });
        $('#campaign_location').select2({
            multiple: true,
            placeholder: "Select location(s)",
            allowClear: true,
        });
        $('#campaign_causes').select2({
            multiple: true,
            placeholder: "Select cause(s)",
            allowClear: true
        });
        $.fn.filepond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.setOptions({
            name: 'campaign_poster',
            required: true,
            server: {
                url: '/admin/campaigns/upload',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
        let file = FilePond.create(
            document.querySelector('#campaign_poster')
        );
        $.fn.filepond.setDefaults({
            acceptedFileTypes: ['image/*'],
        });
    });
    //
</script>
<script>    
    $(document).on('select2:open', (e) => {
        const selectId = e.target.id

        $(".select2-search__field[aria-controls='select2-" + selectId + "-results']").each(function (
            key,
            value,
        ){
            value.focus();
        })
    })
</script>
@endsection