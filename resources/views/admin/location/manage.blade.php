@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
    .delete-modal {
        font-size: 1.2rem !important;
    }
    .hide-badge {
        display: none;
    }
    .show-badge {
        display: block;
        width: fit-content;
    }
    .select2 {
        width: 100%;
    }
</style>
@endsection

@section('js')
<script>
    function trigger_delete() {
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
                        'Location is being deleted..',
                        'success'
                    );

                    document.getElementById('delete_location_form').submit();
                }, 1500);
            }
        });
    }
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Locations <span class="text-muted">></span> Manage
        </h3>
        <p class="mt-n2">
            <small>
                Edit/delete existing locations
            </small>
        </p>
    </div>
</div>
<div class="row mb-3">
    <div class="col-6">
        <div class="flex d-flex">
            <div>
                <a href="{{ route('admin.location.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-angle-left me-2"></i> Back
                </a>
            </div>

            <div class="ml-2">
                &nbsp;
            </div>



            <div class="">
                <button class="btn btn-danger" type="button" onclick="trigger_delete();">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>

                {{-- This form is submitted by JS method --}}
                <form action="{{ route('admin.location.destroy', $location->id) }}" id="delete_location_form" method="POST">@csrf @method('DELETE')</form>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="row">
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
<div class="card mt-3">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-12">
            <form action="{{ route('admin.location.update', $location->id) }}" id="update_form" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="form-group mb-2">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="location_name" name="location_name" class="form-control" value="{{ $location->location_name }}"/>
                </div>
                <div class="form-group mb-2">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="location_address">{{ $location->location_address }}</textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="location_description" value="{{ $location->location_description }}">
                </div>
                <div class="form-group mb-2">
                    <label for="pin_code" class="form-label">Pin Code</label>
                    <input type="number" class="form-control" id="pin_code" name="location_pin_code" value="{{ $location->location_pin_code }}">
                </div>
                <div class="form-group mb-2">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="location_latitude" value="{{ $location->location_latitude }}">
                </div>
                <div class="form-group mb-2">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="location_longitude" value="{{ $location->location_longitude }}">
                </div>
                <div class="form-group mb-2">
                    <a href="https://maps.google.com/maps?q={{ $location->location_latitude }},{{ $location->location_longitude }}" class="btn btn-primary" target="_blank"><i class="fa-solid fa-map-marker-alt"></i> Open in google maps</a>
                </div>
                <div class="form-group mb-2">
                    <label for="manager_id" class="form-label">Manager</label>
                    <select name="location_manager_id" id="manager_id" class="form-control">
                        @foreach($location->location_manager_list as $location_manager=>$location_manager_name)
                            @if ($location_manager == $location->location_manager_id)
                                <option value="{{ $location_manager }}" selected>{{ $location_manager_name }}</option>
                            @else
                                <option value="{{ $location_manager }}">{{ $location_manager_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="status" class="form-label">Status</label>
                    <div class="mb-2">{!! App\Helpers\LocationHelper::getStatusBadges($location->location_status) !!}</div>
                    <select class="form-control" id="location_status" name="location_status">
                        {!! App\Helpers\LocationHelper::getAllStatuses($location->location_status) !!}
                    </select>
                </div>
                <div class="form-group mb-2">
                    <span onclick="document.getElementById('update_form').submit();">
                        <x-loadingbutton>Save</x-loadingbutton>
                    </span>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(()=>{
        $('#location_status').on('change',()=>{
            let val = '#'+$('#location_status option:selected').text().split(' ')[0];
            console.log(val);
            $('.show-badge').addClass('hide-badge');
            $('.show-badge').removeClass('show-badge');
            $(val).removeClass('hide-badge');
            $(val).addClass('show-badge');
        });
        $('#manager_id').select2();
    });
</script>
@endsection
