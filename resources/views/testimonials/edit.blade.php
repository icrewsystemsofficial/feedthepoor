@extends('testimonials.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Testimonial</h2>
            </div>
            <div class="pull-right">
                <a href="/dashboard/testimonials/index" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong>There were some problems with your input.<br><br>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/testimonials/{{ $testimonial->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-ms-12">
                <div class="form-group">
                    <strong>Name: </strong>
                    <input type="text" name="name" value="{{ $testimonial->name }}" class="form-control" placeholder="Name">

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email: </strong>
                    <input type="text" name="email" value="{{ $testimonial->email }}" class="form-control" placeholder="Course">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Message: </strong>
                    <input type="text" name="message" value="{{ $testimonial->message }}" class="form-control" placeholder="Message">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form> 
@endsection       
