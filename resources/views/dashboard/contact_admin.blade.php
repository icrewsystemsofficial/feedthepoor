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

    $(document).on('click', '.edit-modal', function () {
        var modal_data = $(this).data('info').split(',');
        $('#fid').val(modal_data[0]);
        $('#fname').val(modal_data[1]);
        $('#femail').val(modal_data[2]);
        $('#fenquiry').val(modal_data[3]);
        $('#freply').val(modal_data[4]);
        $('#ffiles').val(modal_data[5]);
        $('#fstatus').val(modal_data[6]);
    });

 $(document).on('click', '#footer_action_button', function () {
        $.ajax({
            type: 'post',
            url: 'update',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'name': $('#fname').val(),
                'email': $('#femail').val(),
                'enquire': $('#fenquiry').val(),
                'reply': $('#freply').val(),
                'files': $('#ffiles').val(),
                'status': $('#fstatus').val()
            },
            success: function (data) {
                console.log("sucess");
              
            }
        });
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
<!--@if(Session::has('message'))
    <div class="alert alert-success" role="alert"></div>
    {{ Session::get('message') }}
@endif-->
<table class="table" id="contacts">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Enquiry</th>
            <th class="text-center">Reply</th>
            <th class="text-center">Files</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>

        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr class="item{{ $item->id }}">
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->message }}</td>
            <td>{{ $item->reply }}</td>
            <td>{{ $item->files }}</td>
            <td>{{ $item->status }}</td>
            <td><button id="mybtn" name="mybtn" type="button" class="btn btn-info edit-modal" data-target="#editdata"
                    data-info="{{$item->id}},{{$item->name}},{{$item->email}},{{$item->message}},{{$item->reply}},{{$item->files}},{{$item->status}}"
                    data-toggle="modal">
                    <span class="glyphicon glyphicon-edit"></span> Edit
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div id="editdata" class="modal fade" role="dialog" aria-labelledby="editdata" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                
                <form  enctype="multipart/form-data"  autocomplete="off">
                    {{csrf_field()}}                  
      <div class="form-group">
                        <label class="control-label col-sm2" for="id">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fid" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fname" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="email">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="femail" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="enquiry">Enquiry</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fenquiry" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="reply">Reply</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="freply" placeholder="Your Reply" rows="5"
                                required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="files">Files</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="ffiles">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="status">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="fstatus">
                                <option value="Confirmed"  selected>Confirmed</option>
                                <option value="Processing">Processing</option>
                                <option value="Processed">Processed</option>
                                <option value="Delayed">Delayed</option>
                                <option value="Ignore">Ignore</option>
                                <option value="Assistance Required">Assistance Required</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" data-dismiss="modal">
                            <span id="footer_action_button" class="glyphicon glyphicon">Update</span>
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove">Close</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection
