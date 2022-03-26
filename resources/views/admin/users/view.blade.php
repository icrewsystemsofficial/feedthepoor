@extends('layouts.admin')


@section('js')
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
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">
                            Delete account
                        </a>
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
                                <form method="POST" action="{{ route('admin.profile.update', $user->id) }}" id="update_profile">
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
                                                    @if(Auth::user()->avatar == null)
                                                        https://ui-avatars.com/api/?name={{Auth::user()->name}}
                                                    @else
                                                        {{ asset(Auth::user()->avatar) }}
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
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Available for Mission</label>
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" 
                                            @if ($user->available_for_mission)
                                                checked
                                            @endif
                                        >
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
    </script>
</main>
@endsection
