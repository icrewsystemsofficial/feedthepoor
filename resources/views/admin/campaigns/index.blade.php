@extends('layouts.admin')

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
                        <div class="mb-3">
                            <strong><span class="required">*</span> -> Required fields</strong>
                        </div>
                        <form action="{{ route('admin.campaigns.store') }}" id="new_campaign_form" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="campaign_name">Campaign Name <span class="required">*</span></label>
                                <input type="text" class="form-control" id="campaign_name" name="campaign_name" required placeholder="Enter name of the campaign">
                            </div>
                            <div class="form-group mb-3">
                                <label for="campaign_description">Campaign Description <span class="required">*</span></label>
                                <textarea class="form-control" id="campaign_description" name="campaign_description" required placeholder="Enter description of the campaign"></textarea>
                            </div>            
                            <div class="form-group mb-3">
                                <label for="campaign_poster">Campaign poster <span class="required">*</span></label>
                                <input type="file" class="form-control" id="campaign_poster" name="campaign_poster" accept="image/*">
                            </div><div class="form-group mb-3">
                                <label for="campaign_status">Expected campaign amount (in INR) <span class="required">*</span></label>
                                <input type="number" class="form-control" id="campaign_goal_amount" name="campaign_goal_amount" placeholder="Enter campaign goal amount" required>
                            </div>                                
                            <div class="form-group mb-3">
                                <label for="campaign_start_date">Start date <span class="required">*</span></label>
                                <input type="date" class="form-control" id="campaign_start_date" name="campaign_start_date" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="campaign_end_date">End date</label>
                                <input type="date" class="form-control" id="campaign_end_date" name="campaign_end_date">
                            </div>
                            <div class="form-group mb-3">
                                <label for="campaign_location">Campaign locations <span class="required">*</span></label><br>
                                <select class="form-control" id="campaign_location" name="campaign_location[]" multiple required style="width: 100%;">                                                                                                        
                                    @foreach($locations as $location)                                        
                                        <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="campaign_location">Campaign causes</label><br>
                                <select class="form-control" id="campaign_causes" name="campaign_causes[]" multiple style="width: 100%;">                                                                                                        
                                    @foreach($causes as $cause)                                        
                                        <option value="{{ $cause->id }}">{{ $cause->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="campaign_status">Campaign Status <span class="required">*</span></label>
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
        $('#table').DataTable();
        $("input[type='search']").attr('id','search');
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
        $.fn.filepond.registerPlugin(FilePondPluginImagePreview);
        FilePond.setOptions({
            name: 'campaign_poster',
            required: true,
            server: {
                url: '/admin/campaigns/upload',
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
    $(document).on('select2:open', (e) => {
        const selectId = e.target.id

        $(".select2-search__field[aria-controls='select2-" + selectId + "-results']").each(function (
            key,
            value,
        ){
            value.focus();
        })
    });
    //
</script>
@endsection
