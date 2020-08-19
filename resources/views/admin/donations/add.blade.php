@extends('layouts.layouts')

@section('content')
<section class="py-xl">
<div class="container d-flex align-items-center no-padding">
    <div class="col">
        <div class="row">
          <div class="col-md-12">
              <div class="card bg-tertiary text-white">
                  <div class="card-body">
                      <h2 class="heading pt-3 pb-2 text-white">
                        Add Donations Manually<br />
                      </h2>
                      <p class="mb-5">
                        Fill in the form below to add details of donations that have not been made through the payment portal, and rather through other payment methods.
                      </p>

<<<<<<< HEAD
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Add donation manually</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-md-12 mb-4">

    <!-- DataTales Example -->
    <div class="card shadow mb-4 bg-dark">
      <div class="card-header py-3 bg-light">
        <h3 class="m-3 font-weight-bold text-primary">Add Donations Manually</h3>
      </div>
      <div class="card-body">
=======
>>>>>>> f9342a29eedc92907549fd5fadf13555b18ac6f2
        <form class="form" method="POST" action="add/manual">
          {{ csrf_field() }}
            <div class="row">
              <div class="col md-4">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Enter name" required/>
                </div>
              </div>
              <div class="col md-4">
                <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Enter email ID" required/>
              </div>
              </div>
              <div class="col md-4">
                <div class="form-group">
                  <input type="text" name="instagram" class="form-control" placeholder="Enter Instagram ID" required/>
              </div>
              </div>
            </div>

          <div class="form-group">
            <input type="text" name="amount" class="form-control" placeholder="Enter amount paid (INR)" required/>
          </div>

          <div class="form-group">
            <textarea class="form-control" name="address" rows="4" required placeholder="Enter address here" required/></textarea>
          </div>

          <button type="submit" class="btn btn-md btn-primary">Add Donation</button>
          <button type="reset" class="btn btn-md btn-warning">Reset</button>
        </form>
      </div>
  </div>
  </div>
  </div>
  </div>
  </section>

@endsection('content')
