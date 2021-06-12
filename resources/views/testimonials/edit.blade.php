@extends('layouts.dashboard.admin')

@section('main-content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-2">
            <div class="text-center">
                <h2>Edit Testimonial</h2>
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
    <form action="{{ route('testimonials.update') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $testimonial->id }}"/>
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"/>
        
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="input-group input-group-lg">
                   <span class="input-group-text" id="inputGroup-sizing-lg">Edit Message Here</span>
                   <input type="text" name="message" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="{{ $testimonial->message }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success mt-5">Submit</button>
            </div>
        </div>
    </form> 
    <div class="pull-left ml-5">
        <a href="{{ route('testimonial') }}" class="btn btn-dark mt-2 p-2">Go Back</a>
    </div>
@endsection       
