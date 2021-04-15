@extends('testimonials.layout')

@section('content')
<div class="pull-left">
    <h2>Testimonial CRUD Step by Step</h2>
</div>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a href="{{ route('testimonials.create') }}" class="btn-btn-succes">Create New Testimonial</a>
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
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th width="280px">Action</th>
    </tr>
    @foreach($testimonials as $testimonial)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $testimonial->name }}</td>
        <td>{{ $testimonial->email }}</td>
        <td>{{ $testimonial->message }}</td>
        <td>
            <form action="{{ route('testimonials.destroy',$testimonial->id) }}" method="POST">
                <a href="{{ route('testimonials.show',$testimonial->id) }}" class="btn btn-info">Show</a>
                <a href="{{ route('testimonials.edit',$testimonial->id) }}" class="btn btn-primary">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection