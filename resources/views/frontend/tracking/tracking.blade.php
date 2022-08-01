@extends('layouts.frontend')

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0/lightgallery.min.js" integrity="sha512-FDbnUqS6P7md6VfBoH57otIQB3rwZKvvs/kQ080nmpK876/q4rycGB0KZ/yzlNIDuNc+ybpu0HV3ePdUYfT5cA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chocolat/1.1.0/js/chocolat.min.js" integrity="sha512-f0RyyfsrXaAqNTCqDXt0A7GDr5YauTMYj42P7Y6DNNQ+KjU7cYZpxqLzqncnWMXPZy9h4XtpKPcvsQ/3C2PA1A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chocolat/1.1.0/css/chocolat.min.css" integrity="sha512-0Wtl14JWThNlRkEer0rCPKk6ZVa8DfCb2bpvi8hMM5XqBLygHTJbWcrDP/3Qomp2LMuWMdAZK+E93HFF1puBOQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>

        /* TODO Put this CSS in a separate file */

        .owl-carousel .owl-stage {
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

        .owl-carousel .owl-item img, .owl-carousel .owl-item video {
            width: 100%;
            height: 100% !important;
        }

        .vertical-timeline {
            width: 100%;
            position: relative;
            padding: 1.5rem 0 1rem
        }

        .vertical-timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 27px;
            height: 100%;
            width: 4px;
            background: #e9ecef;
            border-radius: .25rem
        }

        .vertical-timeline-element-icon {
            position: absolute;
            top: 0;
            left: 20px
        }

        .vertical-timeline-element {
            position: relative;
            margin: 0 0 1rem
        }

        .vertical-timeline--animate .vertical-timeline-element-icon.bounce-in {
            visibility: visible;
            animation: cd-bounce-1 .8s
        }


        .vertical-timeline-element-icon .badge-dot-xl {
            box-shadow: 0 0 0 5px #fff
        }

        .badge-dot-xl {
            width: 18px;
            height: 18px;
            position: relative
        }

        .badge:empty {
            display: none
        }

        .badge-dot-xl::before {
            content: '';
            width: 10px;
            height: 10px;
            border-radius: .25rem;
            position: absolute;
            left: 50%;
            top: 50%;
            margin: -5px 0 0 -5px;
            background: #fff
        }

        .vertical-timeline-element-content {
            position: relative;
            margin-left: 60px;
            font-size: .8rem
        }

        .vertical-timeline-element-content .timeline-title {
            font-size: .8rem;
            text-transform: uppercase;
            margin: 0 0 .5rem;
            padding: 2px 0 0;
            font-weight: bold
        }


        .vertical-timeline-element-content:after {
            content: "";
            display: table;
            clear: both
        }

        .vertical-timeline-element-content .vertical-timeline-element-date {
            display: block;
            position: absolute;
            left: -130px;
            top: 0;
            padding-right: 10px;
            text-align: right;
            color: #adb5bd;
            font-size: .7619rem;
            white-space: nowrap;
        }
    </style>

    <script>
    function trackingPage() {
        return {

            showTrackingForm: true,
            showTrackingPage: false,

            init() {
                this.togglePages();
                console.log('mounted');
            },

            togglePages() {
                this.showTrackingForm = !this.showTrackingForm;
                this.showTrackingPage = !this.showTrackingPage;
            }
        }
    }
    $('document').ready(function(){
        Chocolat(document.querySelectorAll('.chocolat-parent .chocolat-image'), {
            imageSize: 'contain',
            loop: true,
        });
    });



    </script>
@endsection

@section('content')


    <section class="section-header bg-dark mb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 text-center">
                    <h1 class="display-4 text-white">
                        Donation Tracking ⌛

                        <br>
                        <small>
                        <span class="display-6">
                            With <strong><span class="text-theme">{{ config('app.ngo_name') }}</span></strong>, you will be able to track
                            your donation, <span class="text-theme">every step of the way.</span>
                        </span>
                        </small>

                    </h1>

                    {{-- <div class="alert alert-danger">
                        <small>
                            <i class="fas fa-info-circle"></i> Certain items of this page are currently under development, we'll let you know once they're live.
                        </small>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="" x-data="trackingPage()" x-init="init()">
        <div class="container mt-n6 z-2 mb-5">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-12">

                    {{-- FORM | FIRST PAGE

                    Little time to implement this so I guess this goes under coming soon

                    June 6,
                    Anirudh R

                    <div x-show="showTrackingForm" class="card shadow-lg border-gray-300 p-4 p-lg-5">

                        <span class="mt-2 text-muted p-2">
                            Demo tracking ID: pay_JdtcQrQ6uddkqS
                        </span>

                        <div class="flex">
                            <div class="w-4/6">
                                <input type="text" class="form-control" placeholder="Enter donation tracking #" />
                            </div>

                            <div class="ml-3">
                                <button class="btn btn-success text-white btn-zoom--hover btn-shadow--hover btn-animated btn-animated-x" type="button" @click="togglePages()">
                                    <span class="btn-inner--visible">Track Donation</span>
                                    <span class="btn-inner--hidden"><i class="fas fa-arrow-right"></i></span>
                                </button>
                            </div>
                        </div>

                    </div>--}}



                    {{-- TRACKING | SECOND PAGE --}}


                    <div class="card shadow-lg border-gray-300 p-4 p-lg-5">

                        <div class="accordion card shadow-xl cursor-pointer bg-success text-white mt-n6 sm:mt-n5 border-success" id="accordionExample1" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                            <div class="card-body">
                                <div class="">
                                    <div>
                                        <span class="font-extrabold">₹{{ number_format($donation->donation_amount) }} INR ({{ $donation->donation_in_words }})</span> was donated with <i class="fas fa-heart text-danger"></i> by
                                        <span class="font-bold">{{ $donation->donor_name }}</span>, for

                                        @if($donation->campaign_id != null)
                                            campaign <span class="font-bold"> {{ App\Helpers\CampaignsHelper::getCampaignName($donation->campaign_id) }}, {{ $donation->cause_name }}</span>.
                                        @else
                                            the cause <span class="font-bold"> {{ $donation->cause_name }}</span>.
                                        @endif

                                    </div>

                                    {{-- <div class="float-right">
                                        <i class="fas fa-check-circle"></i>
                                    </div> --}}
                                </div>

                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample1" style="">

                                    <br>

                                    <div class="card-body text-left">
                                        Donation ID # <span class="font-bold">{{ $donation->id }} | {{ $donation->razorpay_payment_id }}</span>
                                        <br>
                                        Donation date <span class="font-bold">{{ $donation->created_at->format('d F, Y H:i A')}}</span>
                                        <br>
                                        Donated via <span class="font-bold">{{ Str::ucfirst(Str::lower(\App\Helpers\DonationsHelper::get_payment_method($donation->payment_method))) }}</span>
                                        <br>

                                        @php
                                            $excemption = 'Unable to determine <i class="fas fa-times-circle"></i>';
                                             // We're only getting it if the payment method is Razorpay
                                            if($donation->payment_method == App\Models\Donations::$payment_methods['RAZORPAY']) {
                                                $razorpay_data = app(App\Http\Controllers\API\RazorpayAPIController::class)->fetch_payment($donation->razorpay_payment_id);
                                                  if(isset($payment->notes->checkbox_80g)) {
                                                  if($razorpay_data->notes->checkbox_80g == "on") {
                                                    $excemption = 'Eligible <i class="fas fa-check-circle"></i>, <br><span class="font-light"></span>';
                                                  } else {
                                                    $excemption = 'Not eligible <i class="fas fa-times-circle"></i>';
                                                    }
                                                }
                                            }
                                        @endphp

                                        80 G Tax Excemption <span class="font-bold">{!! $excemption !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <span class="text-muted px-2 py-3 text-sm">
                        <i class="fas fa-info-circle"></i> Click the green box to know more about the donation
                    </span>


                        {{-- <div class="card shadow-xl bg-success text-white mt-n7 border-success">
                            <div class="card-body text-center text-md-left">
                               <div class="row align-items-center">
                                    <div class="col-md-12">

                                        <p class="display-5"><b>Donor name : </b><span class="display-6">{{ $donation->donor_name }}</span></p>
                                        <p class="display-5"><b>Donation ID : </b><span class="display-6">{{ $donation->razorpay_payment_id }}</span></p>
                                        <p class="display-5"><b>Donation Amount : </b><span class="display-6">{{ $donation->donation_amount }} ({{ $donation->donation_in_words }})</span></p>
                                        <p class="display-5"><b>Cause/Campaign : </b><span class="display-6">{{ $donation->cause_name }}</span></p>
                                        <p class="display-5"><b>Donated on : </b><span class="display-6">{{ date('d F Y',strtotime($donation->created_at)) }}</span></p>

                                        <a href="{{ route('frontend.donations.receipt', $donation->razorpay_payment_id) }}" target="_blank" class="btn btn-primary text-white">
                                            Download Receipt
                                        </a>

                                    </div>
                               </div>
                            </div>
                        </div> --}}

                        {{--<div class="float-top mb-4 mt-4">
                            <button class="btn btn-danger btn-sm text-white btn-zoom--hover btn-shadow--hover btn-animated btn-animated-x" type="button" @click="togglePages()">
                                <span class="btn-inner--visible">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Go back
                                </span>
                                <span class="btn-inner--hidden"><i class="fas fa-arrow-left"></i></span>
                            </button>

                            <button class="ml-1 btn btn-dark btn-sm text-white btn-zoom--hover btn-shadow--hover btn-animated btn-animated-x" type="button" @click="togglePages()">
                                <span class="btn-inner--visible">
                                    <i class="fas fa-sync mr-1"></i>
                                    Refresh
                                </span>
                                <span class="btn-inner--hidden"><i class="fas fa-sync"></i></span>
                            </button>
                        </div>

                        Coming soon...

                         DONATION STATUS --}}

                        <div class="mt-5">

                            <h5 class="display-5">
                                Donation Status
                            </h5>

                            <div class="progress-wrapper ">

                                @php

                                    $statuses = array(
                                        0 => array(
                                            'title' => 'Donation Received',
                                            'complete' => true,
                                            'in_progress' => false,
                                        ),

                                        1 => array(
                                            'title' => 'Receipt Generated',
                                            'complete' => true,
                                            'in_progress' => false,
                                        ),

                                        2 => array(
                                            'title' => 'Order Placed',
                                            'complete' => false,
                                            'in_progress' => false,
                                        ),

                                        3 => array(
                                            'title' => 'Mission Assigned',
                                            'complete' => false,
                                            'in_progress' => false,
                                        ),

                                        4 => array(
                                            'title' => 'Fieldwork done',
                                            'complete' => false,
                                            'in_progress' => false,
                                        ),

                                        5 => array(
                                            'title' => 'Fieldwork done',
                                            'complete' => false,
                                            'in_progress' => false,
                                        ),

                                        6 => array(
                                            'title' => 'Pictures Updated',
                                            'complete' => false,
                                            'in_progress' => false,
                                        )
                                    );

                                    $donation_status = $donation->donation_status>=2 ? $donation->donation_status : 1;

                                @endphp

                                <script>
                                function runProgress() {
                                    return {
                                        progress_bar_start: 0,
                                        progress_bar_end: {{ round(($donation_status+1)*(100/6)) }},
                                        progress_bar_style: 'width: 0%',
                                        progress_bar_class: null,

                                        init() {

                                            this.progress_bar_class = 'bg-muted';

                                            setInterval(() => {

                                                for(i = this.progress_bar_start; i < this.progress_bar_end; i++) {
                                                    if(i > 20) {
                                                        this.progress_bar_class = 'bg-success';
                                                    }

                                                    this.progress_bar_style = 'width: ' + i + '%';
                                                    // console.log(this.progress_bar_style);
                                                }

                                            }, 500);
                                        }
                                    }
                                }
                                runProgress().init();



                                </script>


                                <div class="progress progress-lg" x-data="runProgress()" x-init="init()">
                                    <div class="progress-bar" :class="progress_bar_class" role="progressbar" :style="progress_bar_style" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <div class="text-center mb-5">

                                    <div class="flex flex-col">
                                        @foreach ($statuses as $id => $status)
                                            <span class="p-2 fw-bold">
                                            <span class="float-left uppercase">
                                                {{ $status['title']}}
                                            </span>

                                            <span class="float-right">
                                                <span class="mr-5">

                                                    @php

                                                        $color = '';
                                                        $icon = '';

                                                        if ($id <= $donation_status) {
                                                            $color = 'success';
                                                            $icon = 'fa-check-circle';
                                                        }
                                                        elseif ($id == $donation_status+1) {                                                            
                                                            $color = 'info';
                                                            $icon = 'fa-sync fa-spin';
                                                        }
                                                        else {
                                                            $color = 'dark';
                                                            $icon = 'fa-times-circle';
                                                        }
                                                    $images = [];
                                                    $videos = [];
                                                    @endphp



                                                    <i class="fas {{ $icon }} text-{{ $color }}"></i>
                                                </span>
                                            </span>
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($donation->donation_status == 6)
                            <div class="border-top border-gray-300 mb-5"></div>
                            <div class="row d-flex justify-content-center mt-70 mb-70">
                                <div class="col-md-12">
                                    <div class="main-card mb-3">
                                        <h5 class="card-title">
                                            Pictures
                                        </h5>
                                        <small>
                                            Take a look at the bundles of joy made possible by YOU!
                                        </small>
                                        @foreach(json_decode(App\Helpers\DonationsHelper::getDonationMedia($donation->id)) as $media)
                                            @if (mime_content_type($media) == 'image/jpeg' || mime_content_type($media) == 'image/png' || mime_content_type($media) == 'image/gif' || mime_content_type($media) == 'image/jpg' || mime_content_type($media) == 'image/heic')
                                                @php $images[] = $media; @endphp
                                            @elseif (mime_content_type($media) == 'video/mp4' || mime_content_type($media) == 'video/webm')
                                                @php $videos[] = $media; @endphp
                                            @endif
                                        @endforeach
                                        @if ($images)
                                            <div class="chocolat-parent">
                                                @foreach ($images as $media)
                                                    <a class="chocolat-image" href="{{ asset($media) }}">
                                                        <img src="{{ asset($media) }}"/>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                        @if ($videos)
                                            <div class="owl-carousel owl-theme mt-3">
                                                @foreach ($videos as $media)
                                                    <div class="item">
                                                        <video controls style="height: fit-content">
                                                            <source src="{{ asset($media) }}" alt="video">
                                                        </video>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- DONATION TIMELINE --}}
                        <div class="border-top border-gray-300 mb-5"></div>
                        <div class="row d-flex justify-content-center mt-70 mb-70">
                            <div class="col-md-12">
                                <div class="main-card mb-3">
                                    <h5 class="card-title">
                                        Donation Timeline
                                    </h5>
                                    <small>
                                        Last update was on {{ $donation->updated_at->format('d, F Y, H:i A') . ', '. $donation->updated_at->diffForHumans() }}.
                                    </small>

                                    @php

                                        $timestamp = [];//json_decode($operation->timestamps)

                                        //timestamps coming soon...

                                        $donation_timeline = array(
                                            0 => array(
                                                'header' => 'Donation was received',
                                                'body' => 'Donation was initiated by ' . $donation->donor_name .' through Razorpay. The amount was received successfully by ' . config('app.ngo_name'),
                                                'time' => isset($timestamp[0]) ? date('d F Y', strtotime($timestamp[0])):'',
                                                'icon' => 'fas fa-check-circle text-success',
                                            ),


                                            1 => array(
                                                'header' => 'Receipt was generated',
                                                'body' => 'Receipt for the donation was generated succesfully and sent to the donor',
                                                'time' => isset($timestamp[1]) ? date('d F Y', strtotime($timestamp[1])):'',
                                                'icon' => 'fas fa-check-circle text-success',
                                            ),

                                            2 => array(
                                                'header' => 'Order was placed',
                                                'body' => 'Procurement order was initiated successfully by ' . config('app.ngo_name'),
                                                'time' => isset($timestamp[2]) ? date('d F Y', strtotime($timestamp[2])):'',
                                                'icon' => 'fas fa-check-circle text-success',
                                            ),

                                            3 => array(
                                                'header' => 'Mission was assigned',
                                                'body' => 'Mission was assigned to deliver smiles to the needy',
                                                'time' => isset($timestamp[3]) ? date('d F Y', strtotime($timestamp[3])):'',
                                                'icon' => 'fas fa-check-circle text-success',
                                            ),

                                            4 => array(
                                                'header' => 'Fieldwork was done',
                                                'body' => 'Fieldwork was completed successfully by ',
                                                'time' => isset($timestamp[4]) ? date('d F Y', strtotime($timestamp[4])):'',
                                                'icon' => 'fas fa-check-circle text-success',
                                            ),

                                            5 => array(
                                                'header' => 'Pictures were updated',
                                                'body' => 'Pictures of the happiness shared through your donation were updated successfully',
                                                'time' => isset($timestamp[5]) ? date('d F Y', strtotime($timestamp[5])):'',
                                                'icon' => 'fas fa-check-circle text-success',
                                            ),
                                        );


                                    @endphp




                                    @if($activities->count() > 0)
                                        <div class="card-body" style="height: 400px; overflow: scroll;">
                                            <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                @endif
                                                {{-- @foreach ($donation_timeline as $id => $log)
                                                    @if ($id <= $donation_status)
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="{{ $log['icon'] }}"></i> </span>
                                                                <div class="vertical-timeline-element-content bounce-in">

                                                                    <span class="uppercase text-muted">
                                                                        {{ $log['time'] }}
                                                                    </span>

                                                                    <h4 class="timeline-title font-bold">{{ $log['header'] }}</h4>
                                                                    <p>
                                                                        {!! $log['body'] !!}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach --}}




                                                @forelse ($activities as $activity)
                                                    <div class="vertical-timeline-item vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"> <i class="fas fa-info-circle text-secondary"></i> </span>
                                                            <div class="vertical-timeline-element-content bounce-in">

                                                        <span class="uppercase text-muted">
                                                            {{ $activity->created_at->diffForHumans() }}
                                                        </span>

                                                                <h4 class="timeline-title font-bold">
                                                                    @if($activity->causer_id != null)
                                                                        {{-- If it's a manual update, like status change, then activity
                                                                            logger records the user who performs that update.
                                                                         --}}
                                                                        {{ App\Models\User::find($activity->causer_id)->name }}
                                                                    @else
                                                                        {{--
                                                                            If not, we tap into the "event" property and update it there
                                                                            here we parse for that.

                                                                            - Leonard,
                                                                            6th June 2022.
                                                                        --}}

                                                                        {{ ($activity->event != null) ? $activity->event : 'Operations Team'  }}
                                                                    @endif
                                                                </h4>
                                                                <p>
                                                                    @if($activity->changes != '[]')
                                                                        {!! App\Helpers\DonationsHelper::get_status_change_context($activity, 2) !!}
                                                                    @else
                                                                        (#) {{ $activity->description }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle"></i>
                                                        This donation was received only {{ $donation->created_at->diffForHumans() }}, our operations team will acknowledge this donation and start the fulfillment processes very soon. We'll send you all updates via e-mail. Please check back later.
                                                    </div>
                                                @endforelse


                                                @if($activities->count() > 0)
                                            </div>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>


                        {{--
                            ALPINE JS MODAL CREATED BY SATISH

                            <div class="row mt-4 ms-4 position-relative mb-5" x-show="false">

                            <div class="col text-center">
                                <div class="flex flex-col text-center">
                                    <i class="fas fa-check-circle text-success fa-3x"></i>
                                </div>
                                <div class="mt-1" x-data="{}">
                                    <a
                                        @click="$dispatch('img-modal', {  imgModalSrc: '{{asset('tracking-images/donation.png')}}', imgModalDesc: 'The Donation was received by the Mr.User on this date' })"
                                        class="uppercase font-bold"
                                    >

                                        Donation Received
                                    </a>
                                </div>
                            </div>

                            <div class="col text-center">
                                <div class="flex flex-col text-center">
                                    <i class="fas fa-check-circle text-success fa-3x"></i>
                                </div>
                                <div class="mt-1" x-data="{}">
                                    <a
                                        @click="$dispatch('img-modal', {
                                            imgModalSrc: '{{asset('tracking-images/donation.png')}}',
                                            imgModalDesc: 'The Donation was received by the Mr.User on this date' })
                                        "
                                        class="uppercase font-bold"
                                    >

                                        RECEPT GENERATED
                                    </a>
                                </div>
                            </div>

                            <div class="col text-center">
                                <div class="flex flex-col text-center">
                                    <i class="fas fa-clock text-muted fa-3x"></i>
                                </div>
                                <div class="mt-1" x-data="{}">
                                    <a
                                        @click="$dispatch('img-modal', {
                                            imgModalSrc: '{{asset('tracking-images/donation.png')}}',
                                            imgModalDesc: 'The Donation was received by the Mr.User on this date' })
                                        "
                                        class="uppercase font-bold"
                                    >

                                        ORDER PLACED
                                    </a>
                                </div>
                            </div>

                            <div class="col text-center">
                                <div class="flex flex-col text-center">
                                    <i class="fas fa-clock text-muted fa-3x"></i>
                                </div>
                                <div class="mt-1" x-data="{}">
                                    <a
                                        @click="$dispatch('img-modal', {
                                            imgModalSrc: '{{asset('tracking-images/donation.png')}}',
                                            imgModalDesc: 'The Donation was received by the Mr.User on this date' })
                                        "
                                        class="uppercase font-bold"
                                    >

                                        Mission Assigned
                                    </a>
                                </div>
                            </div>

                            <div class="col text-center">
                                <div class="flex flex-col text-center">
                                    <i class="fas fa-clock text-muted fa-3x"></i>
                                </div>
                                <div class="mt-1" x-data="{}">
                                    <a
                                        @click="$dispatch('img-modal', {
                                            imgModalSrc: '{{asset('tracking-images/donation.png')}}',
                                            imgModalDesc: 'The Donation was received by the Mr.User on this date' })
                                        "
                                        class="uppercase font-bold"
                                    >

                                        Volunteers Assigned
                                    </a>
                                </div>
                            </div>

                            <div class="col text-center">
                                <div class="flex flex-col text-center">
                                    <i class="fas fa-clock text-muted fa-3x"></i>
                                </div>
                                <div class="mt-1" x-data="{}">
                                    <a
                                        @click="$dispatch('img-modal', {
                                            imgModalSrc: '{{asset('tracking-images/donation.png')}}',
                                            imgModalDesc: 'The Donation was received by the Mr.User on this date' })
                                        "
                                        class="uppercase font-bold"
                                    >

                                        Activity Complete
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end bottom-0 end-0 position-absolute pe-3">
                            <i class="fas fa-info-circle"></i>
                            <h6 class="ps-2 text-secondary fs-6"> Click on each image to know more info </h6>
                        </div> --}}

                        {{-- <div x-data="{ imgModal : false, imgModalSrc : '', imgModalDesc : '' }">
                            <template
                                x-if="imgModal"
                                @img-modal.window="imgModal = true;
                                    imgModalSrc = $event.detail.imgModalSrc;
                                    imgModalDesc = $event.detail.imgModalDesc;"
                            >
                                <div
                                    class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-white bg-opacity-75"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform scale-10"
                                        x-transition:enter-end="opacity-100 transform scale-100"
                                        x-transition:leave="transition ease-in duration-300"
                                        x-transition:leave-start="opacity-100 transform scale-100"
                                        x-transition:leave-end="opacity-0 transform scale-10"
                                        x-on:click.away="imgModalSrc = ''"
                                    >
                                    <div
                                        @click.away="imgModal = ''"
                                        class="flex flex-col max-w-3xl max-h-full overflow-auto"
                                    >
                                        <div class="z-50">
                                            <button @click="imgModal = ''" class="float-right pt-2 pr-2 outline-none focus:outline-none">
                                                <svg class="fill-current text-dark " xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-2">
                                            <div class="justify-content-center">
                                                <center>
                                                    <img :alt="imgModalSrc" class="text-center" :src="imgModalSrc">
                                                </center>
                                                <p x-text="imgModalDesc" class="text-center text-dark"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


