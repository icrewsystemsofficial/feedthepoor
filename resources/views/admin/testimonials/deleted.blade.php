@extends('layouts.admin')
@section('css')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script>
$(document).ready( function () {
    var table = $('#dataTable').DataTable();
    table.column(6).visible(false);
    table.order([ 6, 'desc' ],[ 2, 'desc' ]).draw();
} );
</script>
<!-- Axios JS, for client side API calls. -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  function restoretestimonial(id) {
    if(id == '') {
      swal.fire({
        icon: 'warning',
        text: 'Chosen ID invalid.'
      });
    } else {
      swal.fire({
        title: 'Loading...',
        allowEscapeKey: false,
        allowOutsideClick: false,
        onOpen: () => {
          swal.showLoading();
        }
      });
      var apiURL = "{{ url('/api/admin/testimonials/restore') }}";
      axios.post(apiURL, {
        id: id,
        user: "{{ auth()->user()->id }}"
      })
      .then(function (response) {
        swal.close();
        if(response.data.status == 200) {
          swal.fire({
            icon: 'success',
            text: response.data.message
          }).then((value) => {
            location.reload();
          });
        } else {
          swal.fire({
            icon: 'error',
            text: response.data.message
          });
        }
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  }
  function restoreall() {
    swal.fire({
      title: 'Loading...',
      allowEscapeKey: false,
      allowOutsideClick: false,
      onOpen: () => {
        swal.showLoading();
      }
    });
    var apiURL = "{{ url('/api/admin/testimonials/restore') }}";
    axios.post(apiURL, {
      id: "All",
      user: "{{ auth()->user()->id }}"
    })
    .then(function (response) {
      swal.close();
      if(response.data.status == 200) {
        swal.fire({
          icon: 'success',
          text: response.data.message
        }).then((value) => {
          location.reload();
        });
      } else {
        swal.fire({
          icon: 'error',
          text: response.data.message
        });
      }
    })
    .catch(function (error) {
      console.log(error);
    });
  }
</script>
@endsection
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="restoreall();"><i class="fas fa-check fa-sm text-white-50"></i> Restore all Deleted</a>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-md-12 mb-4">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Displaying {{ count($testimonials) }} testimonials</h6>
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
                  Name
                </th>
                <th>
                  Date
                </th>
                <th>
                  Email ID
                </th>
                <th>
                  Message
                </th>            
                <th>
                  Options
                </th>
                <th>
                  Status
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse($testimonials as $testimonial)
              <tr id="id{{ $testimonial->id }}">
                <td>
                  {{ $testimonial->id }}
                </td>
                <td>
                  {{ $testimonial->name }}
                </td>
                <td>
                  {{ $testimonial->created_at->format('Y-m-d h:i') }}
                  <br />
                  <small>({{ $testimonial->created_at->diffForHumans()  }})</small>
                </td>
                <td>
                  {{ $testimonial->email }}
                </td>
                <td>
                  {{ \Illuminate\Support\Str::limit($testimonial->message,50) }} <a class="btn btn-primary" href="{{ url('/testimonials/view/'.\Illuminate\Support\Facades\Crypt::encryptString($testimonial->id)) }}" target="_blank"> View </a>
                </td>
                <td>
                    <button class="btn btn-primary" onclick="restoretestimonial({{ $testimonial->id }});" type="button">
                    Restore
                    </button>
                </td>
                <td>
                  {{ $testimonial->status }}
                </td>
              </tr>
              @empty
                <div class="alert alert-danger">
                  Ooops. No testimonials found.
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