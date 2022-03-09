@extends('layouts.admin')

@section('css')
<script src="{{ asset('js/alpine.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
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
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAME</th>
                                <th>MANAGER</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection