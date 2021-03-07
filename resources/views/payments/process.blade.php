@extends('layouts.layouts')

@section('content')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<section class="py-xl">
  <!-- <span class="mask bg-primary alpha-6"></span> -->
    <div class="container d-flex align-items-center no-padding">
        <div class="col">
            <div class="row">
              <div class="col-md-12">
                  <div class="card bg-tertiary text-white">
                      <div class="card-body">
                          <h2 class="heading pt-3 pb-2 text-white">
                            Processing, please wait<br />
                          </h2>
                          <p class="mb-5">
                            Sending request to RazorPay API.
                          </p>
                          <!-- The Data response from Razorpay is submitted to this route dynamically via JavaScript.
                            -Leonard, 16/08/2020.
                          -->
                          <form id="verify-form" action="{{ url('payments/verify') }}" method="POST">
                            @csrf
                            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                            <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" />
                            <input type="hidden" name="razorpay_signature" id="razorpay_signature" />
                          </form>
                          <div class="row-wrapper">
                            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                            <script>
                            var options = {
                                "key": "rzp_test_tufnOqSwzLJerx", // Enter the Key ID generated from the Dashboard
                                "amount": "{{ $post->amount * 100 }}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                                "currency": "INR",
                                "name": "{{ env('APP_NAME') }}",
                                "description": "Donation by {{ $post->name }}",
                                "image": "https://cdn.discordapp.com/attachments/530789778912837640/691801343723307068/1585008642050.png",
                                "handler": function (response){
                                  // THIS PART OF THE CODE IS EXECUTED ONCE RAZORPAY SENDS A SUCCESFUL RESPONSE - Leonard, 16/08/2020.
                                    // console.log(response.razorpay_payment_id);
                                    // console.log(response.razorpay_order_id);
                                    // console.log(response.razorpay_signature);
                                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                                    document.getElementById('razorpay_signature').value = response.razorpay_signature;
                                    document.getElementById("verify-form").submit();
                                },
                                "prefill": {
                                    "name": "{{ $post->name }}",
                                    "email": "{{ $post->email }}",
                                    "contact": "{{ $post->phone }}"
                                },
                                "notes": {
                                    "desc": "Donation on #feedThePoor initiative, to Roshini Moolchandani Charitable Trust.",
                                    "name": "{{ $post->name }}",
                                    "address": "{{ $post->address }}",
                                    "instagram": "{{ $post->instagram }}",
                                },
                                "theme": {
                                    "color": "#23294a"
                                }
                            };
                            var rzp1 = new Razorpay(options);
                            rzp1.open();


                            function getPaymentDetails() {
                              axios.get('https://rzp_test_tufnOqSwzLJerx:XS0PnaNKJP9GhuaHtzfrtygg@api.razorpay.com/v1/payments/pay_FRAKf0HqBnmsFw')
                                .then(function (response) {
                                  // handle success
                                  console.log(response);
                                  Swal.fire(
                                    'Response verified',
                                    'Thank you for your donation',
                                    'success'
                                  )
                                })
                                .catch(function (error) {
                                  // handle error
                                  console.log(error);
                                })
                                .finally(function () {
                                  // always executed
                                });
                              }
                            //pay_FRAFxRuQHP6xHI
                            </script>

                            <center>
                              <br />
                              Powered by <img src="https://dashboard.razorpay.com/img/logo_full.png" style="width: 150px; height: auto;" />
                            </center>
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
