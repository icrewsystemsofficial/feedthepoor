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
    .bootstrap-switch .bootstrap-switch-handle-on,
    .bootstrap-switch .bootstrap-switch-handle-off,
    .bootstrap-switch .bootstrap-switch-label {
        display: inline-block;
        width: 44%;
    }
    .select2 {
        width: 100% !important;
    }
    .hide-badge {
        display: none;
    }
    .show-badge {
        display: block;
        width: fit-content;
    }
</style>

<style>
    .badge-danger {
        background-color: #d9534f;
        color: #fff;
        border-color: transparent;
    }
    .badge-danger:hover {
        background-color: #d9534f;
        color: #fff;
        border-color: transparent;
    }
    .delete-modal {
        font-size: 1.2rem !important;
    }
</style>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        passwordVerification = (id, password, cpassword) => {
            if(id === "update_password"){
                if(password != cpassword){
                    Swal.fire(
                        'OOPS!',
                        'Passwords do not match..',
                        'error'
                    );
                    return false;
                }else{
                    return true;
                }
            }else{
                return true;                
            }       

        }
        async function updateProfile(id) {
            const password = document.getElementById('new_password').value;
            const cpassword = document.getElementById('cnew_password').value;
            const response = await passwordVerification(id, password, cpassword);
            if(response){
                Swal.fire({
                    title: 'Are you sure?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Update it!'
                    }).then((result) => {

                    Swal.showLoading();

                    if (result.isConfirmed) {


                        setTimeout(() => {
                            Swal.fire(
                                'Alright!',
                                'Profile has been Updated..',
                                'success'
                            );

                            document.getElementById(id).submit();
                        }, 1500);
                    }
                });                
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
    </script>
@endsection
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Settings</h1>

        <div class="row">
            <div class="col-md-3 col-xl-2">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
                            Password
                        </a>
                        <a  onclick="trigger_delete({{$user->id}})" class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">
                            Delete account
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" id="delete_user_form_{{$user->id}}" method="POST">@csrf @method('DELETE')</form>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Private info</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.profile.update', $user->id) }}" enctype="multipart/form-data" id="update_profile">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Name</label>
                                                <input name="name" value="{{ $user->name }}" type="text" class="form-control" id="name" placeholder="First name">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="email">Email</label>
                                                <input name="email" value="{{ $user->email }}" type="email" class="form-control" id="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <img id="avatar" alt="Charles Hall" 
                                                src="
                                                    @if($user->avatar == null)
                                                        https://ui-avatars.com/api/?name={{$user->name}}
                                                    @else
                                                        {{ asset($user->avatar) }}
                                                    @endif
                                                "
                                                class="rounded-circle img-responsive mt-2" width="128" height="128">
                                                <div class="mt-2">
                                                    <label class="form-label w-100">File input</label>
                                                    <input name="avatar" id="input_avatar" type="file">
                                                </div>
                                                <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input mx-1" type="checkbox" id="flexSwitchCheckChecked" 
                                            @if ($user->available_for_mission)
                                                checked
                                            @endif
                                        />
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Available for Mission</label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select name="user_role" id="user_role" class="form-control">
                                            <option value="" selected>Select a Role</option>
                                            @foreach ($allRoles as $role)
                                                <option 
                                                @if ($user->getRoleNames()[0] == $role->name)
                                                    selected
                                                @endif value='{{$role->name}}'>{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="pan_number">Pan Number</label>
                                        <input name="pan_number" value="{{ $user->pan_number }}" type="text" class="form-control" id="pan_number" placeholder="AAAPZ1234C">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="phone_number">Phone Number</label>
                                        <input name="phone_number" value="{{ $user->phone_number }}" type="number" class="form-control" id="phone_number" placeholder="99999 99999">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="address">Address</label>
                                        <input name="address" value="{{ $user->address }}" type="text" class="form-control" id="address" placeholder="Apartment, studio, or floor">
                                    </div>
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="location_id" class="form-label">Location</label>
                                            <select name="location_id" id="location_id" class="form-control">
                                                <option value="" selected>Select a Location</option>
                                                @foreach ($location as $loc)
                                                    <option 
                                                    @if ($user->location_id == $loc->id)
                                                        selected
                                                    @endif
                                                    value='{{$loc->id}}'>{{$loc->location_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="button" onclick="updateProfile('update_profile')" class="btn btn-primary">Save changes</button>
                                </form>

                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Password</h5>

                                <form method="POST" action="{{ route('admin.profile.password_update', $user->id) }}" id="update_password">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="inputPasswordCurrent">Current password</label>
                                        <input name="curr_password" type="password" class="form-control" id="inputPasswordCurrent">
                                        <small><a href="{{ route('password.request') }}">Forgot your password?</a></small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="inputPasswordNew">New password</label>
                                        <input name="new_password" type="password" class="form-control" id="new_password">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="inputPasswordNew2">Verify password</label>
                                        <input name="cnew_password" type="password" class="form-control" id="cnew_password">
                                    </div>
                                    <button type="button" onclick="updateProfile('update_password')" class="btn btn-primary">Save changes</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="row mb-3">
                <h3>
                    All Donations From {{ $user->name }}
                </h3>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <table id="table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>AMOUNT</th>
                                <th>CAUSE</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_donations as $per_donation)
                            <tr>
                                <td>{{ $per_donation->id }}</td>
                                <td>₹ {{ $per_donation->donation_amount }}</td>
                                <td>{{ $per_donation->cause_name }}</td>
                                <td>
                                    {!! App\Helpers\DonationsHelper::getStatus($per_donation->donation_status) !!}
                                </td>
                                <td>
                                    <a href="{{ route('admin.donations.manage', $per_donation->id) }}" class="btn btn-primary btn-sm">
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
    <script>
        const inpAvatar = document.getElementById('input_avatar');
        inpAvatar.addEventListener('change', (event) => {
            let reader = new FileReader();
            reader.addEventListener('load', () => {
                const optAvatar = document.getElementById('avatar');
                optAvatar.src = reader.result
            })
            reader.readAsDataURL(event.target.files[0]);
        })
        $('document').ready(function(){
            $('#table').DataTable();
        });
    </script>
</main>
@endsection
