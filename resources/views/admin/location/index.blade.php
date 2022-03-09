@extends('layouts.admin')

@section('css')
<script src="{{ asset('js/alpine.js') }}" defer></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script defer>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
</script>
<style>
    .badge-warning {
        background-color: #f0ad4e;
        width: 50%;
    }
    .badge-success {
        background-color: #5cb85c;
        width: 50%;
    }
    .badge-danger {
        background-color: #d9534f;
        width: 50%;
    }
    .badge-info {
        background-color: #5bc0de;
        width: 50%;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Locations
        </h3>
@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
@endif
    <div class="card mt-3">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-12">
                    <table id="table" class="table table-striped" style="width:100%">
                        <tr>
                            <th>NO</th>
                            <th>NAME</th>
                            <th>MANAGER ID</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                        @foreach($locations as $location)
                        <tr>
                            <td>{{ $location->id }}</td>
                            <td>{{ $location->location_name }}</td>
                            <td><a href="">{{ $location->location_manager_id }}</a></td>
                            <td>
                                @php
                                    $status = $location->location_status;
                                    switch($status){
                                        case 0:
                                            $status = '<span class="badge badge-info">Not Ready</span>';
                                            break;
                                        case 1:
                                            $status = '<span class="badge badge-success">Ready</span>';
                                            break;
                                        case 2:
                                            $status = '<span class="badge badge-warning">Inactive</span>';
                                            break;
                                        case 3:
                                            $status = '<span class="badge badge-danger">Stopped</span>';
                                            break;
                                    }
                                    echo $status;
                                @endphp
                                
                            </td>
                            <td>
                                <a href="{{ route('admin.location.manage', $location->id) }}" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection