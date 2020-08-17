@extends('layouts.admin')
@section('css')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script>
$(document).ready( function () {
    $('#dataTable').DataTable({
      .column(3)
      .data()
      .sort();
    });
} );
</script>
@endsection
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Send an email</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-md-12 mb-4">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Choose user</h6>
      </div>
      <div class="card-body">
        <form class="form" method="POST" action="{{ url('admin/sendmail') }}">
          @csrf

          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Enter email ID" required/>
          </div>

          <div class="form-group">
            <input type="text" name="subject" class="form-control" placeholder="Enter email subject" required/>
          </div>

          <div class="form-group">
            <textarea class="form-control" name="message" rows="10" required placeholder="Enter your message (just text, App will handle markup.)"></textarea>
          </div>

          <button type="submit" class="btn btn-md btn-primary">Send E-mail</button>
          <button type="reset" class="btn btn-md btn-warning">Reset</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
