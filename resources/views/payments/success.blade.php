@extends('layouts.layouts')

@section('content')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<section class="py-xl">
  <!-- <span class="mask bg-primary alpha-6"></span>
  To retrive API details.
  https://rzp_test_tufnOqSwzLJerx:XS0PnaNKJP9GhuaHtzfrtygg@api.razorpay.com/v1/payments/pay_FRAKf0HqBnmsFw
-->
    <div class="container d-flex align-items-center no-padding">
        <div class="col">
            <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-success">
                    <h2 class="heading pt-3 pb-2 text-white">
                      Thank you {{ $payment->notes->name }}, We <i class="fa fa-heart text-danger"></i> you
                      <br />
                      <small>
                       we received your donation of ₹{{ ($payment->amount / 100) }} {{ $payment->currency }}.
                     </small>
                    </h2>
                    <p>
                      Your money will be used to pay hungry kids <strong>{{ round($payment->amount / 500) }} times</strong>. You will receive updates daily on your email ID and Instagram
                      (if provided).
                    </p>
                  </div>
                  <div class="d-flex align-items-start">
                    <div class="icon-text">
                      <p>
                        <p class="mb-5">
                          {{ $payment->notes->name }}. We have dispatched the payment recipt to your E-mail ID {{ $payment->email }}. You will receive it within 24 hours.
                        </p>

                        <p class="py-2">
                          <a href="{{ url('/') }}" class="btn btn-tertiary btn-md">Home <i class="fa fa-home"></i></a>
                        </p>
                      </p>
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
