@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script defer>
    $(document).ready(function() {
        $('#table').DataTable();
        $("input[type='search']").attr('id','search');
    } );

    const getUsers =async (role) => {
        const table = $('#table').DataTable();
        $("#search").val(role);
        $("#search").keyup();
        $("#search").focus();
    }
    createUser = (id) => {
        const name = document.getElementById('user_name').value;
        const name_error = document.getElementById('name-error');

        const address = document.getElementById('user_address').value;
        const address_error = document.getElementById('address-error');

        const email = document.getElementById('user_email').value;
        const email_error = document.getElementById('email-error');

        const role = document.getElementById('user_role').value;
        const role_error = document.getElementById('role-error');

        const location_id = document.getElementById('user_location_id').value;
        const location_error = document.getElementById('location-error');

        const password = document.getElementById('password');
        const password_error = document.getElementById('password-error');
        const cpassword = document.getElementById('confirm_password');
        const error = document.getElementById('cpassword-error');
        if(!name){
            name_error.classList.remove('visually-hidden');
            return false;
        }
        if(!address){
            address_error.classList.remove('visually-hidden');
            return false;
        }
        if(!email){
            email_error.classList.remove('visually-hidden');
            return false;
        }
        if(!role){
            role_error.classList.remove('visually-hidden');
            return false;
        }
        if(password.value == ""){
            password_error.classList.remove('visually-hidden');
            return false;
        }
        if(!location_id){
            location_error.classList.remove('visually-hidden');
            return false;
        }
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
            <br>
            <small class="text-muted text-sm">
                All users present in the application. You can click on a role to filter, or search for a specific user.
            </small>
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
                                <input id="user_name" type="text" class="form-control" name="user_name" placeholder="Name of the user">
                                <small id="name-error" class="visually-hidden" style="color: red">
                                    This field is required
                                </small>
                            </div>
                            <div class="form-group mb-2">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="user_address" name="user_address" placeholder="Enter full address of user"></textarea>
                                <small id="address-error" class="visually-hidden" style="color: red">
                                    This field is required
                                </small>
                            </div>
                            <div class="form-group mb-2">
                                <label for="email" class="form-label">E Mail</label>
                                <input class="form-control" name="user_email" id="user_email" placeholder="E Mail">
                                <small id="email-error" class="visually-hidden" style="color: red">
                                    This field is required
                                </small>
                            </div>
                            <div class="form-group mb-2">
                                <label for="role" class="form-label">Role</label>
                                <select name="user_role" id="user_role" class="form-control">
                                    <option value="" selected>Select a Role</option>
                                    @foreach ($allRoles as $role)
                                        <option value='{{$role->name}}'>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <small id="role-error" class="visually-hidden" style="color: red">
                                    This field is required
                                </small>
                            </div>
                            <div class="form-group mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="user_password" id="password" placeholder="Password">
                                <small id="password-error" class="visually-hidden" style="color: red">
                                    This field is required
                                </small>
                            </div>
                            <div class="form-group mb-2">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="user_confirm_password" id="confirm_password" placeholder="Confirm Password">
                                <small id="cpassword-error" class="visually-hidden" style="color: red">
                                    The passwords do not match
                                </small>
                            </div>
                            <div class="form-group mb-2">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="number" class="form-control" id="user_phone_number" name="user_phone_number" value="" placeholder="Enter Phone Number of user">
                            </div>
                            <div class="form-group mb-2">
                                <label for="location_id" class="form-label">Location</label>
                                <select name="user_location_id" id="user_location_id" class="form-control">
                                    <option value="" selected>Select a Location</option>
                                    @foreach ($location as $loc)
                                        <option value='{{$loc->id}}'>{{$loc->location_name}}</option>
                                    @endforeach
                                </select>
                                <small id="location-error" class="visually-hidden" style="color: red">
                                    This field is required
                                </small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <span onclick="createUser('new_user_form')">
                                    <x-loadingbutton type="button">Create</x-loadingbutton>
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
                        <div class="alert alert-info">
                            <small>
                                <span class="text-info">
                                    <i class="fa-solid fa-info-circle"></i> Tip
                                </span>
                                To filter users by role, you can click on any role below.
                            </small>
                        </div>

                        <div class="mb-4">
                            @foreach ($allRoles as $role)
                                {!! App\Helpers\UserHelper::generate_role_status_badges($role) !!}
                            @endforeach
                        </div>


                        <table id="table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
{{--                                    <th>ID</th>--}}
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
{{--                                    <td>{{ $user->id }}</td>--}}
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        {!! $user->phone_number ? $user->phone_number : '<span class="badge bg-secondary">Not Updated</span>' !!}
                                    </td>
                                    <td>
                                        {!!  App\Helpers\UserHelper::get_user_roles($user) !!}
                                    </td>
                                    <td class="d-flex justify-content-around">
                                        <a href="{{ route('admin.users.manage', $user->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-edit"></i> &nbsp;
                                            Manage
                                        </a>
                                        <button onclick="trigger_delete('{{$user->id}}')" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash-can"></i> &nbsp;
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
@endsection
