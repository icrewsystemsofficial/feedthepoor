@extends('layouts.admin')

@section('content')
<iframe src="{{ route('admin.server.status') }}" style="height: 100vh; width: 100%;"></iframe>    
@endsection