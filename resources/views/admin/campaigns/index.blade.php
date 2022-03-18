@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
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
    .select2-close-mask{
        z-index: 2099;
    }
    .select2-dropdown{
        z-index: 3051;
    }
</style>
@endsection

@section('js')

<script>
    let toggleFunct = (ele) => {
            if ($(ele).prop('checked')) {
                $('.hide-date').addClass('show-date');
                $('.hide-date').attr('required', true);
            } else {
                $('.show-date').removeClass('show-date');
                $('.show-date').attr('required', false);
            }

    }
    let toggleFunct2 = (ele) => {
            if ($(ele).prop('checked')) {
                $(this).attr('value', true);
                $('.hide-cause').addClass('show-cause');
                $('.hide-cause').attr('required', true);
            } else {
                $(this).attr('value', false);
                $('.show-cause').removeClass('show-cause');
                $('.show-cause').attr('required', false);
            }

    }
</script>

@endsection

@section('content')
<div class="row">
    <div class="col-12">

        @if ($errors->any())
            <div class="row p-3">
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

        <div class="modal fade" id="newCampaignModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adding new campaign</h5>
                    </div>                    
                    <div class="modal-body m-3">
                        <form action="{{ route('admin.campaigns.store') }}" id="new_campaign_form" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="campaign_name">Campaign Name</label>
                                <input type="text" class="form-control" id="campaign_name" name="campaign_name" required placeholder="Enter name of the campaign">
                            </div>
                            <div class="form-group mb-3">
                                <label for="campaign_description">Campaign Description</label>
                                <textarea class="form-control" id="campaign_description" name="campaign_description" required placeholder="Enter description of the campaign"></textarea>
                            </div>            
                            <div class="form-group mb-3">
                                <label for="campaign_poster">Campaign poster</label>
                                <input type="file" class="form-control" id="campaign_poster" name="campaign_poster" accept="image/*">
                            </div><div class="form-group mb-3">
                                <label for="campaign_status">Expected campaign amount (in INR)</label>
                                <input type="number" class="form-control" id="campaign_goal_amount" name="campaign_goal_amount" placeholder="Enter campaign goal amount" required>
                            </div>                               
                            {{--<div class="form-group mb-3">
                                <label for="campaign_description">Does the campaign have a goal ?</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_campaign_goal_based" name="is_campaign_goal_based" onchange="toggleFunct(this);">
                                </div>                                
                            </div>       --}}                     
                            <div class="form-group mb-3">
                                <label for="campaign_start_date">Start date</label>
                                <input type="date" class="form-control" id="campaign_start_date" name="campaign_start_date" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="campaign_end_date">End date</label>
                                <input type="date" class="form-control" id="campaign_end_date" name="campaign_end_date">
                            </div>
                            <div class="form-group mb-3">
                                <label for="campaign_location">Campaign locations</label><br>
                                <select class="form-control" id="campaign_location" name="campaign_location[]" multiple required style="width: 100%;">                                                                                                        
                                    @foreach($locations as $location)                                        
                                        <option value="{{ $location }}">{{ $location }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--<div class="form-group mb-3">
                                <label for="campaign_description">Does the campaign have a cause ?</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="campaign_has_cause" name="campaign_has_cause" onchange="toggleFunct2(this);">
                                </div>                                
                            </div>--}}
                            <div class="form-group mb-3">
                                <label for="campaign_location">Campaign causes</label><br>
                                <select class="form-control" id="campaign_causes" name="campaign_causes[]" multiple style="width: 100%;">                                                                                                        
                                    @foreach($causes as $cause)                                        
                                        <option value="{{ $cause }}">{{ $cause }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="campaign_status">Campaign Status</label>
                                <select class="form-control" id="campaign_status" name="campaign_status" required>                                    
                                    {!! App\Helpers\CampaignsHelper::getAllStatuses() !!}
                                </select>
                            </div>                                                     
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <span onclick="$('#new_campaign_form')[0].submit()">
                                    <x-loadingbutton>Create</x-loadingbutton>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>
                    Campaigns
                </h3>
                <p class="mt-n2">
                    <small>
                        Events to garner support for your causes
                    </small>
                </p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newCampaignModalPrimary">
                    <i class="fa-solid fa-plus"></i> &nbsp; Add new campaign
                </button>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <table id="table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>START</th>
                                    <th>END</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($campaigns as $campaign)
                                <tr>
                                    <td>{{ $campaign->id }}</td>
                                    <td>{{ $campaign->campaign_name }}</td>
                                    <td>{!! App\Helpers\CampaignsHelper::formatDate($campaign->campaign_start_date) !!}</td>
                                    <td>{!! App\Helpers\CampaignsHelper::formatDate($campaign->campaign_end_date) !!}</td>
                                    <td>
                                        {!! App\Helpers\CampaignsHelper::getStatus($campaign->campaign_status) !!}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.campaigns.manage', $campaign->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-edit"></i> &nbsp;
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))

            <div class="row p-3">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>

        @endif        
    </div>
</div>  
<script>
    $("#newCampaignModalPrimary").css('position', 'fixed');
    $(document).ready(function() {
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
        $('#table').DataTable();
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
                url: '/filepond',
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
@endsection
