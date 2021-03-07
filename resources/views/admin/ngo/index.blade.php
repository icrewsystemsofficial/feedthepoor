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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="dataTable">
            <thead>
              <tr>
                <th>
                  Name
                </th>
                <th>
                  City
                </th>
                <th>
                  State
                </th>
                <th>
                  Country
                </th>
                <th>
                  Pincode
                </th>
                <th>
                    Options
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse($ngos as $ngo)
                <tr>
                    <td>
                        {{ $ngo->ngo_name }}
                    </td>

                    <td>
                        {{ $ngo->city }}
                    </td>

                    <td>
                        {{ $ngo->state }}
                    </td>

                    <td>
                        {{ $ngo->country }}
                    </td>

                    <td>
                        {{ $ngo->pincode}}
                    </td>

                    <td>
                        <a href="{{ route('ngo.view', $ngo->id) }}" class="btn btn-primary btn-sm">
                            View
                        </a>
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
@endsection('content')
