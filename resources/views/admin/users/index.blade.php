@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            users
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
            <i class="fa-solid fa-plus"></i> &nbsp; Add new user
        </button>

        <div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adding new user</h5>
                    </div>
                    <div class="modal-body m-3">

                        <form action="{{ route('admin.users.create') }}" id="new_user_form" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="user_name" placeholder="Name of the user">
                            </div>
                            <div class="form-group mb-2">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="user_address" placeholder="Enter full address of user"></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="user_description" id="description" placeholder="user's Description"></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label for="pin_code" class="form-label">Pin Code</label>
                                <input type="number" class="form-control" id="pin_code" name="user_pin_code" value="" placeholder="Enter PIN code of user">
                            </div>
                            <div class="form-group mb-2">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="user_latitude" value="" placeholder="Enter latitude of user">
                            </div>
                            <div class="form-group mb-2">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="user_longitude" value="" placeholder="Enter longitude of user">
                            </div>
                            <div class="form-group mb-2">
                                <label for="manager_id" class="form-label">Manager</label>
                                <select name="user_manager_id" id="manager_id" class="form-control">
                                    <option value="" selected>Select a manager</option>
                                    
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="user_status">
                                    <option vallue="" selected>Select a status</option>
                                    
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <span onclick="document.getElementById('new_user_form').submit()">
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
                                    <th>E Mail</th>
                                    <th>Phone number</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td><a href="">{{ $user->email }}</a></td>
                                    <td>
                                        {!! $user->phone_number ? $user->phone_number : '<span class="badge badge-secondary">Not Updated</span>' !!}
                                    </td>
                                    <td>{{ $user->getRoleNames()[0] }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.destroy', $user->id) }}" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-edit"></i> &nbsp;
                                            Delete
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
