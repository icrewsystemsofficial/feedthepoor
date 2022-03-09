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
<div class="row">
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
<div class="card mt-3">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-12">
                <h1>{{ $location->location_name }}</h1>
            </div>
        </div>
    </div>
</div>
@endsection