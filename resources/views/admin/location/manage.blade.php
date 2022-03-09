@extends('layouts.admin')

@section('css')
<script src="{{ asset('js/alpine.js') }}" defer></script>
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
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deleting a location</h5>
            </div>
            <div class="modal-body m-3">
                <form action="{{ route('admin.location.destroy', $location->id) }}" id="delete_location_form" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <label class="delete-modal">
                            <strong>Are you sure you want to delete this location?</strong>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cancel</button>
                        <span onclick="document.getElementById('delete_location_form').submit()">
                            <x-loadingbutton class="btn btn-danger" type="submit">
                                <i class="fa-solid fa-trash"></i> Delete
                            </x-loadingbutton>                
                        </span>                        
                    </div>
                </form>
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
                    <select name="location_name" id="name" class="form-control">
                        @foreach($location->location_name_list as $location_name)
                            @if ($location_name == $location->location_name)
                                <option value="{{ $location_name }}" selected>{{ $location_name }}</option>
                            @else
                                <option value="{{ $location_name }}">{{ $location_name }}</option>
                            @endif
                        @endforeach
                    </select>

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
                    <select class="form-control" id="status" name="location_status">
                        {!! App\Helpers\LocationHelper::getStatusesForManage($location->location_status) !!}                        
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
@endsection
