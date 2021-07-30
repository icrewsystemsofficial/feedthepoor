@extends('layouts.admin')
@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#user_table').DataTable({
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
                                Donation
                            </h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                    </li>

                                    <li class="breadcrumb-item active">
                                        Donation
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


    <div class="row mt-4 mb-5">
        <div class="col-md-12 col-12 py--1">

        
                        <div class="mb-2 mt-3">

                            <table id="user_table" class="table table-hover m-4">
                                <thead>
                                    <th>Id</th>
                                    <th>Razorpay Id</th>
                                    <th>Donor Firstname</th>
                                    <th>Donor Lastname</th>
                                    <th>Donor Email</th>
                                    <th>Donor Address</th>
                                    <th>Donation Amount</th>
                                    <th>Comments</th>
                                    <th>Invoice Id</th>
                                    <th>Status</th>
                                    <th>Created At</th>

                                </thead>
                                <tbody>
                                    @foreach ($data as $item)


                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->razorpay_id }}</td>
                                            <td>{{ $item->donor_firstname }}</td>
                                            <td>{{ $item->donor_lastname }}</td>
                                            <td>{{ $item->donor_email }}</td>
                                            <td>{{ $item->donor_address }}</td>
                                            <td>{{ $item->donation_amount }}</td>
                                            <td>{{ $item->comments }}</td>
                                            <td>{{ $item->invoice_id }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)}} </td>
                                           

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                   
            </div>
        </div>
    </div>

@endsection
