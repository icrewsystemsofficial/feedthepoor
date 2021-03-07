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
<div class="align-items-center justify-content-between mb-4 hero">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="h4 text-primary">
                        <strong>NGO Partners</strong>
                        <br>
                        <span class="text-muted h5">
                            <small>Displaying all NGO partners across the country, sorted by region</small>
                        </span>
                     </h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->
<div class="row">
   <!-- Earnings (Monthly) Card Example -->
   <div class="col-md-12 mb-4">

    COMNIG SOON!


    <br><br>

    This should show statistics of the NGO.
    Like, how many users present in the NGO, How much of donations have taken place in the NGO etc.
  </div>
</div>
@endsection('content')
