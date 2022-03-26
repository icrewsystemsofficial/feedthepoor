@extends('layouts.admin')

@section('css')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script defer>
    $(document).ready(function() {
        $('#table1').DataTable();
    } );
    $(document).ready(function() {
        $('#table2').DataTable();
    } );
    $(document).ready(function() {
        $('#table3').DataTable();
    } );
    $(document).ready(function() {
        $('#table4').DataTable();
    } );

    createUser = (id) => {
        const password = document.getElementById('password');
        const cpassword = document.getElementById('confirm_password');
        const error = document.getElementById('password-error');
        if(password.value == cpassword.value){
            document.getElementById('new_user_form').submit()
        }else{
            cpassword.style.borderColor = 'red';
            error.classList.remove('visually-hidden');
        }
    }
    function trigger_delete(id) {
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
                        'User is being deleted..',
                        'success'
                    );

                    document.getElementById(`delete_user_form_${id}`).submit();
                }, 1500);
            }
        });
    }

    alterRole = () => {
        console.log(event.target.value);
    }
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
            Users
        </h3>

        {{-- <p class="mt-n2">
            <small>
                The places where our donation activities take place
            </small>
        </p> --}}

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
                                <label for="email" class="form-label">E Mail</label>
                                <input class="form-control" name="user_email" id="email" placeholder="E Mail">
                            </div>
                            <div class="form-group mb-2">
                                <label for="role" class="form-label">Role</label>
                                <select name="user_role" id="role" class="form-control">
                                    <option value="" selected>Select a Role</option>
                                    @foreach ($allRoles as $role)
                                        <option value='{{$role->name}}'>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="user_password" id="password" placeholder="Password">
                            </div>
                            <div class="form-group mb-2">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="user_confirm_password" id="confirm_password" placeholder="Confirm Password">
                                <small id="password-error" class="visually-hidden" style="color: red">
                                    The passwords do not match
                                </small>
                            </div>
                            <div class="form-group mb-2">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="number" class="form-control" id="phone_number" name="user_phone_number" value="" placeholder="Enter Phone Number of user">
                            </div>
                            <div class="form-group mb-2">
                                <label for="location_id" class="form-label">Location</label>
                                <select name="user_location_id" id="location_id" class="form-control">
                                    <option value="" selected>Select a Location</option>
                                    @foreach ($location as $loc)
                                        <option value='{{$loc->id}}'>{{$loc->location_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <span onclick="createUser('new_user_form')">
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
                        <div class="bd-example">
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="home" aria-selected="false">
                                    All User
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    Administrators
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#volunteers" type="button" role="tab" aria-controls="contact" aria-selected="true">
                                    Volunteers
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#donors" type="button" role="tab" aria-controls="contact" aria-selected="true">
                                    Donors
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="users" role="tabpanel" aria-labelledby="home-tab">
                                <table id="table1" class="table table-striped" style="width:100%">
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
                                                {!! $user->phone_number ? $user->phone_number : '<span class="badge bg-secondary">Not Updated</span>' !!}
                                            </td>
                                            <td>
                                            {{-- @if ($user->hasAnyRole(['superadmin', 'donor', 'volunteer'])) --}}
                                                @if ($user->getRoleNames()[0] == 'superadmin')
                                                    <span class="badge bg-info">Super Admin</span>
                                                @endif
                                                @if ($user->getRoleNames()[0] == 'administrator')
                                                    <span class="badge bg-info">Administrator</span>
                                                @endif
                                                @if ($user->getRoleNames()[0] == 'donor')
                                                    <span class="badge bg-info">Donor</span>
                                                @endif
                                                @if ($user->getRoleNames()[0] == 'volunteer')
                                                    <span class="badge bg-info">Volunteer</span>
                                                @endif  
                                            {{-- @endif --}}
                                            </td>
                                            <td>
                                                <button onclick="trigger_delete({{$user->id}})" class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-edit"></i> &nbsp;
                                                    Delete
                                                </button>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" id="delete_user_form_{{$user->id}}" method="POST">@csrf @method('DELETE')</form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="profile-tab">
                                <table id="table2" class="table table-striped" style="width:100%">
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
                                        @foreach($admins as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td><a href="">{{ $user->email }}</a></td>
                                            <td>
                                                {!! $user->phone_number ? $user->phone_number : '<span class="badge bg-secondary">Not Updated</span>' !!}
                                            </td>
                                            <td>
                                            {{-- @if ($user->hasAnyRole(['superadmin', 'donor', 'volunteer'])) --}}
                                                @if ($user->getRoleNames()[0] == 'administrator')
                                                    <span class="badge bg-info">Administrator</span>
                                                @endif
                                            {{-- @endif --}}
                                            </td>
                                            <td>
                                                <button onclick="trigger_delete({{$user->id}})" class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-edit"></i> &nbsp;
                                                    Delete
                                                </button>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" id="delete_user_form_{{$user->id}}" method="POST">@csrf @method('DELETE')</form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="volunteers" role="tabpanel" aria-labelledby="contact-tab">
                                <table id="table3" class="table table-striped" style="width:100%">
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
                                        @foreach($volunteers as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td><a href="">{{ $user->email }}</a></td>
                                            <td>
                                                {!! $user->phone_number ? $user->phone_number : '<span class="badge bg-secondary">Not Updated</span>' !!}
                                            </td>
                                            <td>
                                            {{-- @if ($user->hasAnyRole(['superadmin', 'donor', 'volunteer'])) --}}
                                                @if ($user->getRoleNames()[0] == 'volunteer')
                                                    <span class="badge bg-info">Volunteer</span>
                                                @endif  
                                            {{-- @endif --}}
                                            </td>
                                            <td>
                                                <button onclick="trigger_delete({{$user->id}})" class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-edit"></i> &nbsp;
                                                    Delete
                                                </button>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" id="delete_user_form_{{$user->id}}" method="POST">@csrf @method('DELETE')</form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="donors" role="tabpanel" aria-labelledby="contact-tab">
                                <table id="table4" class="table table-striped" style="width:100%">
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
                                        @foreach($donors as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td><a href="">{{ $user->email }}</a></td>
                                            <td>
                                                {!! $user->phone_number ? $user->phone_number : '<span class="badge bg-secondary">Not Updated</span>' !!}
                                            </td>
                                            <td>
                                            {{-- @if ($user->hasAnyRole(['superadmin', 'donor', 'volunteer'])) --}}
                                                @if ($user->getRoleNames()[0] == 'donor')
                                                    <span class="badge bg-info">Donor</span>
                                                @endif
                                            {{-- @endif --}}
                                            </td>
                                            <td>
                                                <button onclick="trigger_delete({{$user->id}})" class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-edit"></i> &nbsp;
                                                    Delete
                                                </button>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" id="delete_user_form_{{$user->id}}" method="POST">@csrf @method('DELETE')</form>
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
    </div>
</div>
@endsection