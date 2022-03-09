@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script defer>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
</script>
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
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Locations
        </h3>

        <p class="mt-n2">
            <small>
                The places where our donation activities take place
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
            <i class="fa-solid fa-plus"></i> &nbsp; Add new Location
        </button>

        <div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adding new location</h5>
                    </div>
                    <div class="modal-body m-3">

                        <form action="{{ route('admin.location.store') }}" id="new_location_form" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="location_name" placeholder="Name of the location">
                            </div>
                            <div class="form-group mb-2">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="location_address" placeholder="Enter full address of location"></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="location_description" id="description" placeholder="Location's Description"></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label for="pin_code" class="form-label">Pin Code</label>
                                <input type="number" class="form-control" id="pin_code" name="location_pin_code" value="" placeholder="Enter PIN code of location">
                            </div>
                            <div class="form-group mb-2">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="location_latitude" value="" placeholder="Enter latitude of location">
                            </div>
                            <div class="form-group mb-2">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="location_longitude" value="" placeholder="Enter longitude of location">
                            </div>
                            <div class="form-group mb-2">
                                <label for="manager_id" class="form-label">Manager</label>
                                <select name="location_manager_id" id="manager_id" class="form-control">
                                    <option value="" selected>Select a manager</option>
                                    {!! App\Helpers\LocationHelper::getAllManagers() !!}
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="location_status">
                                    <option vallue="" selected>Select a status</option>
                                    {!! App\Helpers\LocationHelper::getAllStatuses() !!}
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <span onclick="document.getElementById('new_location_form').submit()">
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
                                    <th>NAME</th>
                                    <th>MANAGER</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($locations as $location)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $location->location_name }}</td>
                                    <td><a href="">{{ $location->user->name }}</a> (TODO)</td>
                                    <td>
                                        {!! App\Helpers\LocationHelper::getStatus($location->location_status) !!}
                                        {{-- {{ App\Helpers\LocationHelper::getStatus($location->location_status) }} --}}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.location.manage', $location->id) }}" class="btn btn-primary btn-sm">
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
    </div>
</div>
@endsection
