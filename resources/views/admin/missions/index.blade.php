@extends('layouts.admin')

@section('js')

<script>
    function selectProcurementList() {
        return {


            selectedItems: [],
            init() {

            },

            toggleSelect(id) {

                if(!this.selectedItems.includes(id)) {
                    this.selectedItems.push(id);
                    console.log('Adding ' + id);
                } else {
                    this.selectedItems.splice(id);
                    console.log('Removing ' + id);
                }

                console.log(this.selectedItems);
            }
        }
    }

    $.fn.filepond.registerPlugin(FilePondPluginFileValidateType);
    $.fn.filepond.registerPlugin(FilePondPluginImagePreview);
    FilePond.setOptions({
        name: 'mission_images',
        required: true,
        server: {
            url: '/admin/campaigns/upload',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
    let file = FilePond.create(
        document.querySelector('#mission_images')
    );
    $.fn.filepond.setDefaults({
        acceptedFileTypes: ['image/*'],
    });
</script>


<script>
    $(document).ready(function() {
        $('#table').DataTable();
        let itemsTable = $('#items_table').DataTable();
        itemsTable.columns(3).search('Select mission location').draw();
        $('#location_id').select2({
            // dropdownParent: $("#defaultModalPrimary .modal-body"),
            dropdownAutoWidth : false,
            placeholder: 'Select mission location',
        });
        $('#location_id').on('change', function() {
            itemsTable.columns(3).search(this.value).draw();
        });
        $('.volunteers_select').select2({
            placeholder: 'Select available volunteers to assign to this mission'
        });
    } );
</script>
@endsection

@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>Missions</strong> Dashboard</h1>

    <div class="row">
        <div class="col-12">
            <p class="mt-n2">
                <small>
                   All field work for {{ config('app.ngo_name') }} is carried out in the form of Missions.
                   Missions are automatically generated at 8 PM everyday.
                </small>
            </p>

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


            <div class="alert alert-info" role="alert">

                <h3>
                    <i class="fa-solid fa-exclamation-triangle me-1"></i> Attention
                </h3>

                {{ $total_procurement_items }} items in procurement list ready for dispatch, but not assigned to mission.
                <br><br>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
                    <i class="fa-solid fa-plus"></i> &nbsp; Create new mission
                </button>
            </div>


            {{--<div class="modal fade" id="mediaModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">
                                Upload mission media
                            </h3>
                        </div>
                        <div class="modal-body m-3">
                            <form id="media_upload_form" method="POST" action="{{ route('admin.missions.mission_images') }}">
                                <input type="hidden" name="mission_id" id="mission_images_id" value="">
                                <input type="file" name="mission_images" id="mission_images" accept="image/*" multiple>
                            </form>
                        </div>
                    </div>
                </div>
            </div>--}}


            <div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">
                                Creating a new mission
                            </h3>
                        </div>
                        <div class="modal-body m-3">
                            <form action="{{ route('admin.missions.create') }}" id="new_mission_form" method="GET" autocomplete="off">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="mission_name">Select location for mission</label>
                                    <select class="form-control select2" name="location_id" id="location_id" required>
                                        <option value="">Select location</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->location_name }}">{{ $location->location_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="mission_name">Procurement items</label>
                                    <table id="items_table" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Cause/Campaign</th>
                                                <th>Quantity</th>
                                                <th>Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($procurement_items as $item)
                                                <tr>
                                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                                    <td style="max-width: 180px;white-space:normal;">
                                                        <strong>
                                                            {{ $item->procurement_item }}
                                                        </strong>
                                                    </td>
                                                    <td>{{ $item->procurement_quantity }}</td>
                                                    <td>{!! App\Helpers\MissionHelper::getLocationName($item->location_id) !!}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <span onclick="document.getElementById('new_mission_form').submit()">
                                        <x-loadingbutton type="submit">Create</x-loadingbutton>
                                    </span>
                                </div>
                            </form>
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

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <table id="table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>EXECUTION DATE</th>
                                        <th>LOC & FM</th>
                                        <th>ASSIGNED VOLUNTEERS</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($active_missions as $mission)
                                        <tr>
                                            <td>{{ $mission->id }}</td>
                                            <td>
                                                {{ $mission->execution_date->format('d/m/Y') }}
                                                <br>
                                                <small>
                                                    {{ $mission->execution_date->diffForHumans() }}
                                                </small>
                                            </td>
                                            <td>
                                                <a target="_blank" href="{{ route('admin.location.manage', $mission->location->id) }}">{{ $mission->location->location_name }}</a>
                                                <br>
                                                <small>
                                                    Field Manager: <a href="{{ route('admin.users.manage', $mission->field_manager->id) }}" target="_blank">
                                                        {{ $mission->field_manager->name }}
                                                    </a>
                                                </small>
                                            </td>
                                            <td>{{ $mission->assigned_volunteers }}</td>
                                            <td>
                                                {!! MissionHelper::getStatus_html($mission->mission_status) !!}
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary">
                                                    Manage
                                                </button>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#mediaModalPrimary" onclick="$('#mission_images_id').val({{ $mission->id }})">
                                                    Upload
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

