@extends('layouts.frontend')
@section('content')
<section class="section-header bg-success mb-4">
    <div class="container">
       <div class="row justify-content-center">
          <div class="col-12 col-md-8 text-center">
                <h1 class="display-4 text-white">
                    <span class="fw-bolder">{{ $payment->notes->name }}</span>, we you love you <i class="fas fa-heart text-danger"></i>🙏
                </h1>
          </div>


       </div>
    </div>
 </section>

 <div class="container mt-n6 z-2 mb-5">
       <div class="row justify-content-center">
          <div class="col">
             <div class="card shadow-lg border-gray-300 p-4 p-lg-5">
                <p>
                    Thank you so much for your valuable donation. You will receive an email
                    from us confirming the details of this donation.

                    @if(isset($payment->notes->checkbox_80g))
                        Your 80G tax exemption receipt will be included as an attachment on the same e-mail.
                    @endif

                    <br><br>

                    <a href="{{ route('frontend.track-donation', $payment->id) }}" target="_blank" class="btn btn-theme text-white">
                        Track Donation
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>



@endsection
