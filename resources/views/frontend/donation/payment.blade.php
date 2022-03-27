@extends('layouts.frontend')
{{-- call email event event(new App\Events\Donations\DonationReceived($order)); --}}
@section('js')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "rzp_test_SmU75lqcibiulc", // Enter the Key ID generated from the Dashboard
        "amount": "{{ $order->amount }}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "{{ config('setting.app_name') }}",
        "description": "Donation # {{ $order->id }}",
        "image": "https://icrewsystems.com/logo.png",
        "order_id": "{{ $order->id }}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "handler": function (response){           
            window.location.href = '{{ route("frontend.donate.thank_you") }}' + '/' + response.razorpay_payment_id
        },
        "prefill": {
            "name": "{{ $order->notes->name }}",
            "email": "{{ $order->notes->email }}",
            "contact": "{{ $order->notes->phone ?? '' }}"
        },
        "theme": {
            "color": "#3399cc"
        }
    };

    var razorpay_instance = new Razorpay(options);

    razorpay_instance.on('payment.failed', function (response){
        alert('Check console for payment error');
        console.log(response.error.code);
    });

    // TODO Capture other events too, lke INVALID PAYMENT etc.

    razorpay_instance.open();
</script>
@endsection

@section('content')
<section class="section-header bg-dark mb-4">
    <div class="container">
       <div class="row justify-content-center">
          <div class="col-12 col-md-8 text-center">
                <h1 class="display-4 text-white">
                    <i class="fas fa-spinner fa-spin me-3"></i> Processing, don't close this page
                </h1>
          </div>
       </div>
    </div>
 </section>
@endsection
