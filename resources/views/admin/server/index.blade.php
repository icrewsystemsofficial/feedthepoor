@extends('layouts.admin')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <h3>
            <strong>Admin Tools</strong> Server Monitor
        </h3>

        <p class="mt-n2">
            <small>
                Monitor the health of your server
            </small>
        </p>
    </div>
</div>
<iframe src="{{ route('admin.server.status') }}" style="height: 100vh; width: 100%;"></iframe>    
@endsection