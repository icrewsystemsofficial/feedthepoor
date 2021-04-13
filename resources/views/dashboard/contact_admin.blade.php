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
            <td><a id="mybtn" name="mybtn" type="button" class="btn btn-info edit-modal" href={{ "edit/".$item['id'] }}  >Edit</a>
               
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
