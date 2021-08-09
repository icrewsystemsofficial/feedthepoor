@section('meta')
@endsection
@section('title')
@endsection
@section('css')
@endsection
@section('content')
<section class="slice slice-md">
    <div class="container mt-5">
      <div class="row justify-content-center">

        <div class="col-lg-6">
            <div class="text-left pt-lg-md">
                <h4 class="heading h2">
                    Your donation will <strong>impact</strong> lives 🙏
                    <br>
                    <small>
                        with absolute transparency, donate more confidently. <strong>#feedThePoor</strong>
                    </small>
                  </h4>
              <p class="lead lh-180">
                <button onclick="window.location='#how'" class="btn btn-sm btn-success mt-2">
                  View donation activity on {{ strtolower(date('l, d/m/Y', strtotime('yesterday'))) }}
                </button>
              </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="card bg-primary text-white">
               <div class="card-body">
                  <h4 class="heading h2 text-white pt-3 pb-5">
                    <strong>Step 1</strong>
                    <br>
                    <small>
                        Choose the amount
                    </small>
                  </h4>
                  <form class="form-primary">
                     <div class="form-group">
                        <div class="row align-items-center">
                            <div class="col-md-12">


                                <div id="money-buttons-group">
                                    <center class="mb-2">
                                        <button type="button" onclick="updateMoney(100);" class="btn btn-success btn-sm">
                                            ₹100
                                        </button>

                                        <button type="button" onclick="updateMoney(250);" class="btn btn-success btn-sm ml-0">
                                            ₹250
                                        </button>

                                        <button type="button" onclick="updateMoney(500);" class="btn btn-success btn-sm ml-0">
                                            ₹500
                                        </button>

                                        <button type="button" onclick="toggleCustomDonation();" class="btn btn-secondary btn-sm ml-0 mt-2 btn-block">
                                            Enter custom amount
                                        </button>

                                        {{-- <button type="button" class="btn btn-secondary btn-sm ml-0 mt-2">
                                            Choose no. of meals
                                        </button> --}}
                                    </center>
                                </div>

                               

                                <div class="input-group mb-3" id="customDonationAmountBox" style="display: none;">
                                    <input type="text" class="form-control" placeholder="Minimum of ₹30" id="custom-amount">
                                    <div class="input-group-append">
                                        <button onclick="updateMoney(document.getElementById('custom-amount').value); toggleCustomDonation();" class="btn btn-secondary" type="button">Process</button>
                                    </div>
                                </div>

                             </div>
                           {{-- <div class="col-md-2" style="padding: 0px; margin: 0px;">
                              <a class="btn btn-sm donate-plus-button text-dark btn-secondary">
                                 <i class="fa fa-plus"></i>
                              </a>
                           </div>
                           <div class="col-md-2" style="padding: 0px; margin: 0px;">
                              <a class="btn btn-sm text-dark donate-minus-button btn-secondary">
                                <i class="fa fa-minus"></i>
                              </a>
                           </div> --}}
                        </div>
                     </div>
                     <button onclick="processNextStep();" class="btn btn-block btn-lg bg-white mt-4 btn-animated btn-animated-x text-success">
                        <span class="btn-inner--visible">Proceed to donate ₹<span id="donationAmount">50</span></span>
                        <span class="btn-inner--hidden">
                           <svg class="svg-inline--fa fa-credit-card fa-w-18" aria-hidden="true" data-prefix="fas" data-icon="credit-card" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                              <path fill="currentColor" d="M0 432c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V256H0v176zm192-68c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H204c-6.6 0-12-5.4-12-12v-40zm-128 0c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM576 80v48H0V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48z"></path>
                           </svg>
                           <!-- <i class="fas fa-credit-card"></i> -->
                        </span>
                     </button>

                     <p class="mt-3 text-center text-white">
                        <span id="mealsPossible">1</span> donation(s) possible* ₹<span id="moneyPossible">50</span>
                     </p>
                  </form>
               </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>
                                    function updateMoney(value) {
                                        if(value == '') {
                                            alert('Choose an amount first');
                                        } else {
                                            if(value > 10000) {
                                            //TODO: Do this via SweetAlert.
                                                alert('Dear donor, For any amount higher than ₹10,000, please contact staff. donations@feedthepoor.in')
                                            }
                                            if(value < 30) {
                                                alert('Dear donor, it takes us a minimum of ₹30 to feed a person. Please consider a higher amount to continue.')
                                            }
                                        }
                                        var donationAmount = document.getElementById('donationAmount');
                                        donationAmount.innerHTML = value;
                                        calculateNumberOfMeals(value);
                                    }
                                    function toggleCustomDonation() {
                                        var customDonationAmountBox = document.getElementById('customDonationAmountBox');
                                        if(customDonationAmountBox.style.display == 'none') {
                                            customDonationAmountBox.style.display = '';
                                        } else {
                                            customDonationAmountBox.style.display = 'none';
                                        }
                                    }
                                    function calculateNumberOfMeals(money) {
                                        var costpermeal = 50;
                                        var meals = 0;
                                        meals = Math.floor(money / costpermeal);
                                        if(meals < 0) {
                                            meals = 0;
                                        }
                                        document.getElementById('mealsPossible').innerHTML = meals;
                                        document.getElementById('moneyPossible').innerHTML = money;
                                    }
                                    function processNextStep() {
                                     var amount = donationAmount.innerHTML;
                                     window.location.href = "{{ url('donate') }}/" + amount;
                                    }
                                </script>
@endsection