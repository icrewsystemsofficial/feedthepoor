@extends('layouts.admin')


@section('js')
<script>
$(function () {
        $("#chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $("#dvPassport").show();
            } else {
                $("#dvPassport").hide();
            }
        });
    });
</script>
@endsection

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Donation') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">


        <div class="col-11">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Donation</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('donation.save') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">User information</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Name<span class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="last_name">Last name</label>
                                        <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="name">Email Id<span class="small text-danger">*</span></label>
                            <input type="text" id="email" class="form-control" name="email" placeholder="email">
                        </div>
                    </div>
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="last_name">Date Of Birth</label>
                            <input type="date" id="dob" class="form-control" name="dob" >
                        </div>
                    </div>
             </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="address">Address<span class="small text-danger">*</span></label>
                                        <input type="text" id="address" class="form-control" name="address"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="address">Landmark<span class="small text-danger">*</span></label>
                                        <input type="text" id="address" class="form-control" name="landmark"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="name">Pincode</label>
                            <input type="text" id="pincode" class="form-control" name="pincode" placeholder="600 001">
                        </div>
                    </div>
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="last_name">City<span class="small text-danger">*</span></label>
                            <input type="text" id="city" class="form-control" name="city" placeholder="city" >
                        </div>
                    </div>
             </div>
             <div class="row">
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="name">State<span class="small text-danger">*</span></label>
                            <input type="text" id="state" class="form-control" name="state" placeholder="state">
                        </div>
                    </div>
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="last_name">Country<span class="small text-danger">*</span></label>
                            <input type="text" id="Country" class="form-control" name="country" placeholder="country" >
                        </div>
                    </div>
             </div>
             {{-- <div class="row">
                              <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">CIty<span class="small text-danger">*</span></label>
                                        <select name="city"  id="city" class="form-control">
                                        @foreach ($city as $cities)
                                                <option value="{{ $cities->name }}">
                                                    {{ $cities->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="phone">Phone Number</label>
                                        <input type="text" id="phone" class="form-control" name="phone" placeholder="+91 987456321" >
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">Gender</label>
                                        <select name="gender"  id="gender" class="form-control">
                                           <option value="male">Male</option>
                                           <option value="female">Female</option>
                                           <option value="others">Others</option>
                                        </select> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Current password</label>
                                        <input type="password" id="current_password" class="form-control" name="current_password" placeholder="Current password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">New password</label>
                                        <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Confirm password</label>
                                        <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                                    </div>
                                </div>
                            </div> --}}
                            <h6 class="heading-small text-muted mb-4">Donation</h6>
                            <div class="col-lg-6 text-left">
                            <div class="form-group focused">

                    <label class="form-control-label text-left">Donation Amount</label>
                    <input maxlength="200" type="text" name="amount" required="required" class="form-control" placeholder="1000">
                </div>
             </div><br>
            
                <label for="chkPassport" class="form-control-label text-left" >
                    <input type="checkbox" id="chkPassport" />
                    80g reduvtion
                </label>
                
                <div class="form-group" id="dvPassport" name="panid" style="display: none">
                    <label class="form-control-label  text-left">Pan Card Number</label>
                    <input type="text" id="txtPassportNumber" name="panid" class="form-control" placeholder="1000">
                </div> 

                <div class="form-group">
                    <label class="form-control-label text-left">Comments to the volunteer</label>
                    <textarea maxlength="200" type="text" required="required" class="form-control" name="comments" placeholder="1000"></textarea>
                </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
