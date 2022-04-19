@extends('layouts.admin')


@section('css')
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
    .badge-muted {
        background-color: #3b3b3b;
        color: #fff;
    }
    </style>
@endsection

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
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table').DataTable();
        $('.select2').select2({
            // dropdownParent: $("#defaultModalPrimary .modal-body"),
            dropdownAutoWidth : false,
            placeholder: 'Select field manager'
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

                2 items in procurement list ready for dispatch, but not assigned to mission.
                <br><br>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
                    <i class="fa-solid fa-plus"></i> &nbsp; Create new mission
                </button>
            </div>



            <div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">
                                Creating a new mission
                            </h3>
                        </div>
                        <div class="modal-body m-3">

                            {{-- <form action="{{ route('admin.donations.store') }}" id="new_donation_form" method="POST" autocomplete="off">
                                @csrf



                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Mission Execution Date</label>
                                    <input type="date" class="form-control" />
                                </div>

                                <div class="form-group mb-3">
                                    <label for="field_manager_id" class="form-label">Field Manager</label>
                                    <select name="field_manager_id" class="form-control select2" style="width: 100%;">
                                        @foreach ($active_volunteers as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="procurement_items">Procurement Item(s)</label>


                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <span onclick="document.getElementById('new_donation_form').submit()">
                                        <x-loadingbutton type="submit">Create</x-loadingbutton>
                                    </span>
                                </div>

                        </form> --}}
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

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.missions.store') }}" id="mission_create_form" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="execution_date" class="form-label">Mission Execution Date</label>
                            <input type="date" name="execution_date" class="form-control" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="field_manager_id" class="form-label">Field Manager</label>
                            <select name="field_manager_id" class="form-control select2" style="width: 100%;">
                                @foreach ($active_volunteers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <div class="px-3">
                                <div class="table-responsive card p-3">
                                    <div class="alert alert-info">
                                        Procurement Item(s) that are marked "READY FOR DISPATCH"
                                    </div>
                                    <table class="table table-borderless">
                                        <thead>
                                            <th>ID</th>
                                            <th>ITEM</th>
                                            <th>QTY</th>
                                            <th>ACTIONS</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($procurement_items as $list)
                                                <tr>
                                                    <td>
                                                        {{ $list->id }}
                                                    </td>
                                                    <td>
                                                        {{ $list->procurement_item }}
                                                    </td>
                                                    <td>
                                                        {{ $list->procurement_quantity }}
                                                    </td>
                                                    <td>
                                                        <label class="switch mb-2">
                                                            <input
                                                                type="checkbox"
                                                                name="procurement_item_{{ $list->id }}"
                                                                {{-- id="id_{{ Str::snake($list->procurement_item) }}" --}}
                                                                checked="checked"
                                                            />
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                        <div class="form-group mb-3">
                            <label for="assigned_volunteers">
                                Volunteers
                            </label>
                            <select name="assigned_volunteers[]" id="" multiple class="volunteers_select form-control">
                                @foreach ($active_volunteers as $volunteer)
                                    <option value="{{ $volunteer->id }}">
                                        {{ $volunteer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <span onclick="document.getElementById('mission_create_form').submit()">
                                <x-loadingbutton type="submit">Create</x-loadingbutton>
                            </span>
                        </div>

                </form>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <table id="table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th># ID</th>
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

