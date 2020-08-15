@extends('layouts.layouts')

@section('content')

<section class="py-xl">
  <!-- <span class="mask bg-primary alpha-6"></span> -->
    <div class="container d-flex align-items-center no-padding">
        <div class="col">
            <div class="row">
                <div class="col-lg-8 col-md-12 pr-5">
                    <img style="height: auto; width: 100%;" src="https://cdn.discordapp.com/attachments/530789778912837640/742715123680149545/marginalia-payment-processed.png" alt="">
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                          <?php
                            $status = $invoice->status;
                            switch($status) {
                              case "not_paid":
                                $color = 'danger';
                                $icon = 'fa fa-exclamation';
                              break;
                              case "paid":
                                $color = 'success';
                                $icon = 'fa fa-check';
                              break;
                              default:
                                $color = 'danger';
                              break;
                            }

                            $status = str_replace('_', ' ', $status);
                          ?>
                            <button type="button" class="btn btn-{{ $color}} btn-sm btn-zoom--hover">
                              {{ strtoupper($status) }} <i class="{{ $icon }}"></i>
                            </button>

                            <h4 class="heading pt-3 pb-2 text-white"><small>Invoice#</small>
                              <br />
                              {{ $invoice_prefix->setting_value }}{{ $invoice->id }}</h4>
                            <p>
                              This payment is generated for project <strong>{{ $project->title }} ({{ $client->company_name }}, {{ $client->country }})</strong> on   {{ strtoupper(date('d/M/Y', strtotime($invoice->bill_date))) }},
                              <br />The invoice amount is {{ $invoice_amount }} @currency($currency)
                              <?php
                                if($currency != 'INR') {
                                  echo "<br /><small>Please note, only INR (Indian Rupee) supported at this time.</small>";
                                }
                              ?>


                            </p>


                            <!-- <form action="/charge" method="POST">
                              <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_n5jfuB9mPGicnuXal78qC9Ls"
                                data-amount="{{$invoice_amount}}"
                                data-currency="USD"
                                data-name="icrewsystems software development LLP"
                                data-email="kashrayks@gmail.com"
                                data-allow-remember-me="false"
                                data-description="{{ $project->title }} ({{ $client->company_name }}, {{ $client->country }})"
                                data-image="https://icrewsystems.com/logo.png"
                                data-locale="auto">
                              </script>
                            </form> -->

                            <form id="redirectForm" class="form-primary" method="post" action="{{ url('/request') }}">
                              @csrf

                              <div class="form-group">
                                <div class="input-group">
                                    <input type="text" id="orderAmount" class="form-control" name="orderAmount" value="{{ $invoice_amount }}" placeholder="Enter Order Amount here (Ex. 100)">
                                    <div class="input-group-append text-white">
                                        <select id="orderCurrency" name="orderCurrency" class="selectpicker" onChange="fireCurrencyChange();">

                                          <option value="USD">USD</option>
                                          <option value="INR" selected>INR</option>
                                          <option value="GBP">GBP</option>
                                          <option value="JPY">JPY</option>
                                        </select>
                                      </div>
                                </div>
                                <br />

                                <small><p id="exchangerate"></p></small>
                                <input id="base_currency" type="hidden" name="base_currency" value="USD" />
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                            <script>
                            fireCurrencyChange();
                              function fireCurrencyChange() {
                                var base_currency = '<?php echo $currency; ?>';
                                var base_amount = '<?php echo $invoice_amount; ?>';
                                var orderCurrency = document.getElementById('orderCurrency');
                                var orderAmount = document.getElementById('orderAmount');
                                var exchangerate = document.getElementById('exchangerate');

                                axios.get('http://localhost/laravel/payments/api/convert/' + base_currency + '/' + orderCurrency.value + '/' + base_amount)
                                  .then(function (response) {
                                    Swal.fire({
                                      icon: 'info',
                                      title: 'Currency converted',
                                      text: 'Since our payment partner only accepts INR at the moment, the invoice value had to be converted from ' + orderAmount.value + ' ' + base_currency.value + ' to ' + response.data.converted_amount + ' ' + orderCurrency.value + '. Alternatively, you can still use PayPal.me link to pay the invoice.' ,
                                      footer: '<a href="https://www.ecb.europa.eu/stats/policy_and_exchange_rates/euro_reference_exchange_rates/html/index.en.html" target="_blank">Check conversion rates </a>'
                                    });

                                    orderAmount.value  = response.data.converted_amount;
                                    base_currency.value  = response.data.converted_currency;
                                    exchangerate.innerHTML  = "1 " + response.data.base_currency + " = " + response.data.conversion_rate + ' ' + response.data.converted_currency + ". Conversion rate acquired from European Central Bank." ;
                                  })
                                  .catch(function (error) {
                                    // handle error
                                    console.log(error);
                                    Swal.fire({
                                      icon: 'error',
                                      title: 'Whhoooops!',
                                      text: 'Something went wrong. We were unable to contact the Currency conversion API server. This might be an error on our server. Please use PayPal.me' ,
                                      footer: '<a href="https://www.ecb.europa.eu/stats/policy_and_exchange_rates/euro_reference_exchange_rates/html/index.en.html" target="_blank">Check conversion rates </a>'
                                    });
                                  })
                                  .then(function () {
                                    console.log("always");
                                  });


                              }
                            </script>
                              <!-- <div class="col-md-8">
                                <div class="form-group">
                                  <label>Invoice Amount:</label><br>
                                  <input class="form-control" name="orderAmount" value="{{ $invoice_amount }}" placeholder="Enter Order Amount here (Ex. 100)"/>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Order Currency:</label><br>
                                  <select name="orderCurrency" class="form-control">

                                  </select>
                                </div>
                              </div> -->

                              <div class="form-group">
                                <label>Payee Name:</label><br>
                                <input required class="form-control" name="customerName" value="{{ $client->company_name }}" placeholder="Your name / Company Name"/>
                              </div>
                              <div class="form-group">
                                <label>Email:</label><br>
                                <!-- <input class="form-control" name="customerEmail" value="{{ $user->email }}" placeholder="Enter your email address here (Ex. Johndoe@test.com)"/> -->
                                <input required class="form-control" name="customerEmail" value="kashrayks@gmail.com" placeholder="Enter your email address here (Ex. Johndoe@test.com)"/>
                              </div>
                              <div class="form-group">
                                <label>Phone</label><br>
                                <input required class="form-control" name="customerPhone" value="{{ $client->phone }}" placeholder="Enter your phone number here (Ex. 9999999999)"/>
                              </div>

                              <input type="hidden" name="appId" value="1235099d801e5372b0c853fb605321"/>
                              <input type="hidden" name="orderNote" value="{{ $invoice->note }}" />
                              <input type="hidden" name="orderId" value="<?php echo rand(10, 10283); ?>" />
                              <!-- <input type="hidden" name="orderId" value="{{ $invoice->id }}"/> -->
                              <input type="hidden" name="returnUrl" value="http://localhost/laravel/payments/response"/>
                              <input type="hidden" name="notifyUrl" value="http://localhost/laravel/payments/response"/>
                              <button type="submit" value="pay" class="btn btn-block btn-lg bg-white mt-4 btn-animated btn-animated-x">
                                <span class="btn-inner--visible">Pay Now</span>
                                <span class="btn-inner--hidden"><i class="fas fa-arrow-right"></i></span>
                              </button>
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
