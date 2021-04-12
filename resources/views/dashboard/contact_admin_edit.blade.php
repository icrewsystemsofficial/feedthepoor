@extends('layouts.dashboard.admin')

@section('meta')
<title>
    Dashboard | FeedThePoor
</title>
@endsection

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<style>
    /* Your Custom Styles Here*/
</style>
@endsection

@section('js')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#contacts').DataTable();
    });

</script>
@endsection


@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Contacts') }}</h1>

@if ($errors->any())
<div class="alert alert-danger border-left-danger" role="alert">
    <ul class="pl-4 my-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
                
                <form action="{{ route('contactadmin.update') }}" method="post" enctype="multipart/form-data"  autocomplete="off">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" class="form-control" name="id" value="{{ $data->id }}" >



                    <div class="form-group">
                        <label class="control-label col-sm2" for="name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="email">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email"   value="{{ $data->email }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="enquiry">Enquiry</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="enquiry" value="{{ $data->message }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="reply">Reply</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="reply" placeholder="Your Reply" value="{{ $data->reply }}" rows="5"
                                required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="files">Files</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="files" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="status">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status">
                                <option value="Confirmed"  selected>Confirmed</option>
                                <option value="Processing">Processing</option>
                                <option value="Processed">Processed</option>
                                <option value="Delayed">Delayed</option>
                                <option value="Ignore">Ignore</option>
                                <option value="Assistance Required">Assistance Required</option>
                            </select>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-success" data-dismiss="modal">
                            <span id="footer_action_button" class="glyphicon glyphicon">Update</span>
                        </button>
                       
                </form>
@endsection
