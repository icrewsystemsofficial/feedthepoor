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

                    <a href="{{ route('frontend.donations.receipt', $payment->id) }}" target="_blank" class="btn btn-success text-white">
                        Download Receipt
                    </a>


                    @php

                            $text = 'I have just donated Rs. '.$payment->amount.' to '.config('app.ngo_name').'. This NGO will act on behalf of me and
                            help the needy. The most interesting part is, I get to see the live updates about where, and how my money is being used. I recommend you
                            to donate as well. The feeling of doing something helpful for the undeprivledged, is truly different.';
                            $share = Share::page(route('frontend.track-donation', $payment->id), $text)
                            // ->whatsapp($text)
                            ->telegram()
                            ->facebook()
                            ->twitter()
                            // ->linkedin()
                            ->getRawLinks();
                        @endphp




                        <br><br>
                        <span class="mt-3"  x-data="{
                            shareMenuOpen: false,
                        }" x-show="false">
                            <span
                            @click.away="shareMenuOpen = !shareMenuOpen"
                            x-show="shareMenuOpen"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"
                            >
                                @foreach ($share as $key => $value)
                                    <a class="btn btn-primary btn-sm" href="{{ $value }}" target="_blank">
                                        <i class="fab fa-{{ $key }}"></i> {{ ucfirst($key) }}
                                    </a>
                                @endforeach
                            </span>

                            <button type="button" class="btn btn-primary btn-md" x-show="!shareMenuOpen" @click="shareMenuOpen = !shareMenuOpen"
                            >
                                <span class="me-1">
                                    <span class="fas fa-share"></span>
                                </span>
                                Share website
                             </button>
                        </span>
                </p>
            </div>
        </div>
    </div>
</div>



@endsection
