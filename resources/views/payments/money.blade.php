@extends('layouts.layouts')

@section('content')

<section class="py-xl">
  <!-- <span class="mask bg-primary alpha-6"></span> -->
    <div class="container d-flex align-items-center no-padding">
        <div class="col">
            <div class="row">
              <div class="col-md-12">
                  <div class="card bg-tertiary text-white">
                      <div class="card-body">
                          <h2 class="heading pt-3 pb-2 text-white">
                            Donating Money to #feedThePoor<br />
                          </h2>
                          <p class="mb-5">
                            After your donation, you will receive an confirmation email along with the donation recipt from <strong>Roshni Moolchandani Charitable Trust</strong> (our NGO partner). You will be further updated about
                            your donation status within 24 hours in the provided channels (Instagram / E-mail).
                          </p>
                          <form method="POST" action="{{ url('/process') }}">
                            @csrf
                            <div class="row-wrapper">
                              <h3 class="heading h6 text-uppercase text-primary mt-5 mb-4">
                                Your details
                              </h3>
                              <div class="row cols-xs-space cols-sm-space cols-md-space">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Your name" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <input id="email" name="email" type="email" class="form-control" placeholder="E-mail ID" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <input id="phone" name="phone" type="phone" class="form-control" placeholder="Phone Number" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <input id="instagram" name="instagram" type="text" class="form-control" placeholder="Instagram handle (optional)">
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <textarea name="address" id="address" class="form-control" placeholder="Your resediential address" required></textarea>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <input type="number" id="amount" name="amount" value="{{ $amount }}" class="form-control" placeholder="How much are you donating?">
                                  </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                  <label class="d-block">Generate recipt</label>
                                  <label class="toggle-switch">
                                    <input id="recipt" name="recipt" type="checkbox" checked>
                                    <span class="toggle-switch-slider rounded-circle"></span>
                                  </label>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                  <label class="d-block">Receive updates</label>
                                  <label class="toggle-switch">
                                    <input id="updates" name="updates" type="checkbox" checked>
                                    <span class="toggle-switch-slider rounded-circle"></span>
                                  </label>
                                </div>
                              </div>
                              <!-- XS0PnaNKJP9GhuaHtzfrtygg -->
                              <button type="submit" class="btn btn-primary btn-block">Process donation</button>

                              <center>
                                <br />
                                Powered by <img src="https://dashboard.razorpay.com/img/logo_full.png" style="width: 150px; height: auto;" />
                              </center>
                          </form>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>

<script>
// Swal.fire({
//   icon: 'success',
//   title: 'Oops...',
//   text: 'Something went wrong!',
//   footer: '<a href>Why do I have this issue?</a>'
// });

</script>
@endsection

@section('this-is-disabled')
<div class="row cols-xs-space cols-sm-space cols-md-space" style="display: none;">
  <h3 class="heading h6 text-uppercase text-primary mt-5 mb-4">
    Donation Details
  </h3>
  <div class="col-md-6">
    <div class="form-group">
      <select id="mode" class="selectpicker" name="mode" onchange="processMode();">
        <option selected disabled>How would you like to donate?</option>
        <option value="direct">I wish to donate money directly</option>
        <option value="meal">I wish to donate a meal</option>
      </select>
    </div>
  </div>

  <script>
    function processMode() {
      var mode = document.getElementById('mode');
      if(mode.value == 'direct') {
        console.log(mode.value);
        var mode_amount = document.getElementById('mode_amount');
        mode_amount.style.visibility = "visible";
      } else {
        console.log(mode.value);
        var mode_meals = document.getElementById('mode_meals');
        mode_meals.style.visibility = "visible";
      }


      // setTimeOut( function(){
      //   swal.fire('You have selected ' + selected)
      // }, 2000);

    }
  </script>
  <div class="col-md-6">
    <div class="form-group">



      <span style="display: none;" id="mode_amount">
        <input type="number" class="form-control" placeholder="Please enter amount" />
      </span>



      <div style="display: none;">
        <select  id="mode_meals" class="selectpicker" name="mode">
          <?php
            for($i = 1; $i <= 5; $i++) {
                ?>
                  <option value="{{$i}}"> {{ $i }} meal(s)</option>
                <?php
            }
          ?>
        </select>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="form-group">
      <textarea class="form-control" placeholder="Your resediential address"></textarea>
    </div>
  </div>
</div>
@endsection
