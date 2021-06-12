@extends('layouts.dashboard.admin') 


@section('main-content')


<div class="row">
    <div class="col-lg-12 margin-tb mt-2 mb-2">
        <div class="text-center">
            <a href="{{ route('testimonials.create') }}" class="btn btn-success">Create New Testimonial</a>
        </div>
    </div>
</div>

@if($message=Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Status</th>
        <th width="280px">Action</th>

    </tr>
    @foreach($testimonials as $testimonial)
    @php
        $user = App\User::find($testimonial->user_id);
    @endphp
    <tr>
        <td>{{ (($user->name)??'NOT').' '.(($user->last_name)??'SET') }}</td>
        <td>{{ ($user->email)??'NOT SET'}}</td>
        <td>{{ $testimonial->message }}</td>
        <td>
            <form action="{{ route('testimonials.admin.status') }}" method="POST">
                
                <input type="hidden" name="id" value="{{ $testimonial->id }}">

                @csrf

                @if ($testimonial->status_id == 0)
                    <button type="submit" class="btn btn-success">Enable</button>
                @else
                    <button type="submit" class="btn btn-danger">Disable</button>
                @endif
            </form>
        </td>
                
        <td>
            <form action="{{ route('testimonials.destroy',$testimonial->id) }}" method="POST">
                <a href="{{ route('testimonials.edit',$testimonial->id) }}" class="btn btn-info">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection