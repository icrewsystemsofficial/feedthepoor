@extends('layouts.dashboard.admin')

@section('meta')
<title>
    Dashboard | FeedThePoor
</title>
@endsection

@section('css')
<style>
    /* Your Custom Styles Here*/
</style>
@endsection

@section('js')

@endsection


@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Gallery') }}</h1>

@if ($errors->any())
<div class="alert alert-danger border-left-danger" role="alert">
    <ul class="pl-4 my-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

                <form action="{{ route('gallery.register') }}" method="post" enctype="multipart/form-data"  autocomplete="off">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                        <label class="control-label col-sm2" for="files">Photo</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="files" >
                        </div>
                    </div>


                    
                    <div class="form-group">
                        <label class="control-label col-sm2" for="caption">Caption</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="caption">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="active">Active</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="active" >
                        </div>
                    </div>
                    
                        <button type="submit" class="btn btn-success" data-dismiss="modal">
                            <span id="footer_action_button" class="glyphicon glyphicon">Upload</span>
                        </button>

                </form>
@endsection
