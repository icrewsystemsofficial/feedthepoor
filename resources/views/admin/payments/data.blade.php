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
  <h1 class="h3 mb-0 text-gray-800">Data from Database</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-md-12 mb-4">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Retrived payments</h6>
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
                  Amount
                </th>
                <th>
                  When
                </th>
                <th>
                  Date
                </th>
                <th>
                  Email ID
                </th>
                <th>
                  Contact No
                </th>
                <th>
                  Captured?
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse($payments as $payment)
                <tr>
                  <td>
                    {{ $payment->id }}
                  </td>
                  <td>
                    {{ ($payment->amount / 100) }} {{ $payment->currency }}
                  </td>
                  <td>
                    {{ \Carbon\Carbon::createFromTimeStamp($payment->created_at)->diffForHumans()  }}
                  </td>
                  <td>
                    {{ \Carbon\Carbon::createFromTimeStamp($payment->created_at)->format('d/M/Y')  }}
                  </td>
                  <td>
                    {{ $payment->email }}
                  </td>
                  <td>
                    {{ $payment->contact }}
                  </td>
                  <td>
                    {{ $donation->captured }}
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
