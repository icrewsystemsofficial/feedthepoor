@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<link type="text/css" href="{{ asset('theme/css/additional.css') }}" rel="stylesheet">


<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script defer>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
<style>
    .badge-warning {
        background-color: #f0ad4e;
        color: #fff;
    }

    .badge-success {
        background-color: #5cb85c;
        color: #fff;
    }

    .badge-danger {
        background-color: #d9534f;
        color: #fff;
    }

    .badge-info {
        background-color: #5bc0de;
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Contact Details
        </h3>



        @if ($errors->any())
        <div class="row p-3">
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif


        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <table id="table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>CONTACTED ON</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($contacts as $contact)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td><a href="">{{ $contact->email }}</a></td>
                                    <td> {{  Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contact->created_at)->format('d-m-Y') }} ( {{ Carbon\Carbon::parse($contact->created_at)->diffForHumans()}})</td>

                                    @if( $contact->status == 0)
                                    <td>
                                        <a href=" " class="btn btn-success btn-sm">
                                            <i class="fa-solid fa-plus"></i> &nbsp;
                                            New
                                        </a>
                                    </td>
                                    @elseif( $contact->status == 1)
                                    <td>
                                        <a href=" " class="btn btn-theme btn-sm">
                                            <i class="fa-solid fa-user-check"></i> &nbsp;
                                            Contacted
                                        </a>
                                    </td>
                                    @elseif( $contact->status == 2)
                                    <td>
                                        <a href=" " class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-circle-exclamation"></i> &nbsp;
                                            Spam
                                        </a>
                                    </td>
                                   
                                    @endif

                                    <td>
                                        <a href="{{ route('admin.contact.view' , $contact->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-eye"></i> &nbsp;
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection