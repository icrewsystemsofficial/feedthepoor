@extends('layouts.admin')

@section('content')
<style media="screen">
  .hero{
    padding-top: 5%;
  }
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4 hero">
  <h1 class="h3 mb-0 text-gray-800">Add Donations Manually</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-md-12 mb-4">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Fill in the form below to add the details of payments made manuallly into the database.</h6>
      </div>
      <div class="card-body">
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
                              <br><br>
                        <div class="form-group">
                          <input type="text" name="amount" class="form-control" placeholder="Enter amount paid (INR)" required/>
                        </div>
                          <br><br>
                        <div class="form-group">
                          <textarea class="form-control" name="address" rows="4" required placeholder="Enter address here" required/></textarea>
                        </div>
                        <br><br>
                        <button type="submit" class="btn btn-md btn-primary">Add Donation</button>
                        <button type="reset" class="btn btn-md btn-warning">Reset</button>
                      </form>

<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Add donation manually</h1>
</div> -->


</div>
</div>
</div>
</div>

@endsection('content')
