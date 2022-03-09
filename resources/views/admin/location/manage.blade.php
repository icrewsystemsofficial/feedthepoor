@extends('layouts.admin')

@section('css')
<script src="{{ asset('js/alpine.js') }}" defer></script>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Locations <span style="color: #777;">></span> Manage
        </h3>
    </div>
</div>
<div class="row mb-3">
    <div class="col-6" style="width: fit-content;">
        <a href="{{ route('admin.location.index') }}" class="btn btn-primary">Back</a>
    </div>
    <div class="col-6" style="width: fit-content;">
        <form action="{{ route('admin.location.destroy', $location->id) }}" method="POST">
            @csrf
            @method('DELETE')            
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
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
                    <input type="text" class="form-control" id="name" name="location_name" value="{{ $location->location_name }}">
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
                    <label for="manager_id" class="form-label">Manager ID</label>
                    <input type="text" class="form-control" id="manager_id" name="location_manager_id" value="{{ $location->location_manager_id }}">
                </div>
                <div class="form-group mb-2">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="location_status">
                        <option value="0" {{ $location->location_status == 0 ? 'selected' : '' }}>Not Ready</option>
                        <option value="1" {{ $location->location_status == 1 ? 'selected' : '' }}>Ready</option>
                        <option value="2" {{ $location->location_status == 2 ? 'selected' : '' }}>Inactive</option>
                        <option value="3" {{ $location->location_status == 3 ? 'selected' : '' }}>Stopped</option>
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