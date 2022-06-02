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
                        <a  onclick="trigger_delete({{$user->id}})" class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">
                            Delete Application
                        </a>
                        <form action="{{ route('admin.users.destroy_volunteer', $user->id) }}" id="delete_user_form_{{$user->id}}" method="POST">@csrf @method('DELETE')</form>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Request#{{$user->id}}</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.users.volunteer_accept', $user->id) }}" id="update_profile">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Name</label>
                                            <input readonly name="name" value="{{ $user->name }}" type="text" class="form-control" id="name" placeholder="First name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input readonly name="email" value="{{ $user->email }}" type="email" class="form-control" id="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="age">Pan Number</label>
                                        <input readonly name="age" value="{{ $user->age }}" type="text" class="form-control" id="age" >
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="phone_number">Phone Number</label>
                                        <input readonly name="phone_number" value="{{ $user->number }}" type="number" class="form-control" id="phone_number" placeholder="99999 99999">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="organization">Organization</label>
                                        <input readonly name="organization" value="{{ $user->organization }}" type="text" class="form-control" id="organization">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="state">State</label>
                                        <input readonly name="state" value="{{ $user->state }}" type="text" class="form-control" id="state">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="City">city</label>
                                        <input readonly name="city" value="{{ $user->city }}" type="text" class="form-control" id="city">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="address">Address</label>
                                        <input readonly name="address" value="{{ $user->address }}" type="text" class="form-control" id="address" placeholder="Apartment, studio, or floor">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="pincode">Pincode</label>
                                        <input readonly name="pincode" value="{{ $user->pincode }}" type="number" class="form-control" id="pincode" placeholder="99999 99999">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="experience">Experience</label>
                                        <input readonly name="experience" value="{{ $user->experience }}" type="text" class="form-control" id="experience">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="education">Education</label>
                                        <input readonly name="education" value="{{ $user->education }}" type="text" class="form-control" id="education" >
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="reason">Reason</label>
                                        <input readonly name="reason" value="{{ $user->reason }}" type="text" class="form-control" id="reason" >
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="facebook">Facebook</label>
                                        <input readonly name="facebook" value="{{ $user->facebook }}" type="text" class="form-control" id="facebook" >
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="instagram">Instagram</label>
                                        <input readonly name="instagram" value="{{ $user->instagram }}" type="text" class="form-control" id="instagram" >
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="twitter">Twitter</label>
                                        <input readonly name="twitter" value="{{ $user->twitter }}" type="text" class="form-control" id="twitter" >
                                    </div>
                                    <button type="submit" class="btn btn-primary">Accept Request</button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
    </script>
</main>
@endsection
