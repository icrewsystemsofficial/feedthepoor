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
  <h1 class="h3 mb-0 text-gray-800">All Donations Data</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-md-12 mb-4">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Following is the list of donation details stored on the database.</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="dataTable">
            <thead>
              <tr>
                <th>
                  ID
                </th>
                <th>
                  Payments ID
                </th>
                <th>
                  Donor Name
                </th>
                <th>
                  Donor Email
                </th>
                <th>
                  Donor Instagram
                </th>

              </tr>
            </thead>
            <tbody>
              @forelse($donations as $donation)
                <tr>
                  <td>
                    {{ $donation->id }}
                  </td>
                  <td>
                    {{ $donation->payments_id }}
                  </td>
                  <td>
                    {{  $donation->donor_name  }}
                  </td>
                  <td>
                    {{  $donation->donor_email  }}
                  </td>
                  <td>
                    {{  $donation->donor_instagram }}
                  </td>

                </tr>
              @empty
                <div class="alert alert-danger">
                  Ooops. No payments found from API. Please check Razorpay dashboard.
                </div>
              @endforelse
            </tbody>
          </table>

          <?php
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
