@extends('layouts.admin')
@section('css')
    <!--link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css"-->
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#user_table').DataTable({
                // //Sort the activities based on the ID.
                // "order": [[ 1, "asc" ]]
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endsection
@section('main-content')

    <div class="content-header row">
        <div class="content-header col-md-12 col-12 py--1">
            <div class="card">
                <div class="card-body">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-3">
                                User Management
                            </h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                    </li>

                                    <li class="breadcrumb-item active">
                                        User Management
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row mt-4 mb-5">
        <div class="col-md-12 col-12 py--1">

            <div class="card">
                @if (count($data) > 0)
                    <div class="card-body">

                        <div class="alert alert-info">
                            <div class="alert-body">
                                <strong>
                                    Information
                                </strong>
                                All logged user modules.
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger border-left-danger" role="alert">
                                <ul class="pl-4 my-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-primary float-right" href="{{ route('user.create.view') }}">Create
                                    User</a>
                            </div>
                        </div>
                        <div class="mb-2 mt-3">

                            <table id="user_table" class="table table-hover">
                                <thead>
                                    <th>Id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created At</th>
                                    <th>Action</th>

                                </thead>
                                <tbody>
                                    @foreach ($data as $item)


                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->last_name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->roles->pluck('name')->implode(' ') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)}} </td>
                                            <td><a id="mybtn" name="mybtn" type="button" class="btn btn-info edit-modal"
                                                    href="{{ 'edit/' . $item['id'] }}"><i class="fas fa-pen"></i> Edit</a>

                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deletemodal"><i class="fas fa-trash-alt"></i>
                                                    Delete</button>

                                                <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog"
                                                    aria-labelledby="deletemodal" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deletemodal">Are you sure?</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this user?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a class="btn btn-danger"
                                                                    href="{{ 'delete/' . $item['id'] }}"><i
                                                                        class="fas fa-trash-alt"></i> Yes, I'm sure</a>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <div class="alert-body">
                                <strong>WHOOPS!</strong> No User
                            </div>
                        </div>
                @endif
            </div>
        </div>
    </div>

@endsection
