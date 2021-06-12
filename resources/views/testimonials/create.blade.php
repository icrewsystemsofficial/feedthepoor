@extends('layouts.dashboard.admin')

@section('main-content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Testimonial</h2>
            </div>
        </div>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input <br><br>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('testimonials.store') }}" method="POST">
        @csrf
        <div class="row mt-3">

            
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"/>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Message</span>
                    </div>
                <textarea class="form-control" name="message" aria-label="With textarea"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
    <span class="text-center">
        <a href="{{ route('testimonial') }}" class="btn btn-dark mt-2 p-2">Go Back</a>
    </span>
@endsection    