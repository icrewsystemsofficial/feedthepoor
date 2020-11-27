@extends('layouts.layouts')

@section('content')
<style>
  .row{
    margin-top: 10%;
  }
  .card-body{
    text-align: center;
  }

  h5{
    color: #fff;
  }
</style>
<section>

  <section class="py-xl">
    <!-- <span class="mask bg-primary alpha-6"></span> -->
      <div class="container d-flex align-items-center no-padding">
          <div class="col">
              <div class="row">
                <div class="col-md-12">
                    <div class="card bg-tertiary text-white">
                        <div class="card-body">
                            <h2 class="heading pt-3 pb-2 text-white">
                              Yay! Your request was saved. <br />
                            </h2><br><br>
                            <button class="alert alert-success" role="alert" type="button" name="button">Request Successful</button><br><br><br>

                            <h5 class="mb-5">
                              One of our voulenteers will get in touch with you. We are excited and looking forward to this.
                            </h5>
                          </div>
                        </div></div>
                      </div></div>
                    </div>




  </section>
@endsection
