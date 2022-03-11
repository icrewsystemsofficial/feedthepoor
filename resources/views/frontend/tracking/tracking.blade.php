@extends('layouts.frontend')

@section('css')
<style>
    .vertical-timeline {
    width: 100%;
    position: relative;
    padding: 1.5rem 0 1rem
    }

    .vertical-timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 67px;
    height: 100%;
    width: 4px;
    background: #e9ecef;
    border-radius: .25rem
    }

    .vertical-timeline-element {
    position: relative;
    margin: 0 0 1rem
    }

    .vertical-timeline--animate .vertical-timeline-element-icon.bounce-in {
    visibility: visible;
    animation: cd-bounce-1 .8s
    }

    .vertical-timeline-element-icon {
    position: absolute;
    top: 0;
    left: 60px
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
    margin-left: 90px;
    font-size: .8rem
    }

    .vertical-timeline-element-content .timeline-title {
    font-size: .8rem;
    text-transform: uppercase;
    margin: 0 0 .5rem;
    padding: 2px 0 0;
    font-weight: bold
    }

    .vertical-timeline-element-content .vertical-timeline-element-date {
    display: block;
    position: absolute;
    left: -90px;
    top: 0;
    padding-right: 10px;
    text-align: right;
    color: #adb5bd;
    font-size: .7619rem;
    white-space: nowrap
    }

    .vertical-timeline-element-content:after {
    content: "";
    display: table;
    clear: both
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
            </div>
        </div>
    </div>
</section>

<section class="" x-data="trackingPage()" x-init="init()">
    <div class="container mt-n6 z-2 mb-5">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8">

                {{-- FORM | FIRST PAGE --}}
                <div x-show="showTrackingForm" class="card shadow-lg border-gray-300 p-4 p-lg-5">

                    <span class="mt-2 text-muted p-2">
                        Demo tracking ID: FTP-RMCT-12389
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

                </div>

                {{-- TRACKING | SECOND PAGE --}}
                <div x-show="showTrackingPage" class="card shadow-lg border-gray-300 p-4 p-lg-5">


                    <div class="accordion card shadow-xl cursor-pointer bg-success text-white mt-n6 sm:mt-n5 border-success" id="accordionExample1" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                        <div class="card-body">
                            <div class="">
                                <div >
                                    <span class="font-extrabold">₹5,000 INR</span> was donated with <i class="fas fa-heart text-danger"></i> by
                                    <span class="font-bold">{{ $donation_names[0] }}</span>, from <span class="font-bold">Chennai</span>.
                                </div>

                                {{-- <div class="float-right">
                                    <i class="fas fa-check-circle"></i>
                                </div> --}}
                            </div>

                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample1" style="">

                                <br>

                                <div class="card-body text-left">
                                    Donation ID # <span class="font-bold">FPT-RMCT-01042022-19823</span>
                                    <br>
                                    Donation date <span class="font-bold">{{ now()->subDays(2)->format('d F, Y H:i A')}}</span>
                                    <br>
                                    Donated via <span class="font-bold">Razorpay</span>
                                    <br>
                                    80 G Tax Excemption <span class="font-bold">Eligible <i class="fas fa-check-circle"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <span class="text-muted px-2 py-3 text-sm">
                        <i class="fas fa-info-circle"></i> Click the green box to know more about the donation
                    </span>

                    {{-- <div class="card shadow-xl bg-success text-white mt-n7 border-success">
                        <div class="card-body px-5 py-5 text-center text-md-left">
                           <div class="row align-items-center">
                            <div class="col-md-12">



                            </div>
                           </div>
                        </div>
                    </div> --}}

                    <div class="float-top mb-4 mt-4">
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

                    {{-- DONATION STATUS --}}


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
                                    {{-- <img src="{{asset('tracking-images/donation.png')}}" alt="" width="50px" height="50px" class="image-link ms-1 rounded ml-2"> --}}
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
                                    {{-- <img src="{{asset('tracking-images/donation.png')}}" alt="" width="50px" height="50px" class="image-link ms-1 rounded ml-2"> --}}
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
                                    {{-- <img src="{{asset('tracking-images/donation.png')}}" alt="" width="50px" height="50px" class="image-link ms-1 rounded ml-2"> --}}
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
                                    {{-- <img src="{{asset('tracking-images/donation.png')}}" alt="" width="50px" height="50px" class="image-link ms-1 rounded ml-2"> --}}
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
                                    {{-- <img src="{{asset('tracking-images/donation.png')}}" alt="" width="50px" height="50px" class="image-link ms-1 rounded ml-2"> --}}
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
                                    {{-- <img src="{{asset('tracking-images/donation.png')}}" alt="" width="50px" height="50px" class="image-link ms-1 rounded ml-2"> --}}
                                    Activity Complete
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="">

                        <h5 class="display-5">
                            Donation Status
                        </h5>

                        <div class="progress-wrapper ">

                            <script>
                                function runProgress() {
                                    return {
                                        progress_bar_start: 0,
                                        progress_bar_end: 45,
                                        progress_bar_style: 'width: 10%',
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

                                            }, 2000);
                                        }
                                    }
                                }
                            </script>


                            <div class="progress progress-lg" x-data="runProgress()" x-init="init()">
                                <div class="progress-bar" :class="progress_bar_class" role="progressbar" :style="progress_bar_style" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <div class="text-center mb-5">


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
                                            'in_progress' => true,
                                        ),

                                        3 => array(
                                            'title' => 'Mission Assigned',
                                            'complete' => false,
                                            'in_progress' => false,
                                        ),

                                        4 => array(
                                            'title' => 'Volunteers Assigned',
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
                                        ),

                                        7 => array(
                                            'title' => 'Mission Complete',
                                            'complete' => false,
                                            'in_progress' => false,
                                        )
                                    );

                                @endphp


                                <div class="flex flex-col">
                                    @foreach ($statuses as $status)
                                        <span class="p-2 fw-bold">

                                            <span class="float-left">
                                                {{ $status['title']}}
                                            </span>

                                            <span class="float-right">
                                                <span class="mr-5">

                                                    @php

                                                        $color = '';
                                                        $icon = '';

                                                        if($status['complete'] == true) {
                                                            $color = 'success';
                                                        }
                                                        elseif($status['in_progress'] == true) {
                                                            $color = 'info';
                                                        }
                                                        else {
                                                            $color = 'dark';
                                                        }

                                                        if($status['complete'] == true) {
                                                            $icon = 'fa-check-circle';
                                                        }
                                                        elseif($status['in_progress'] == true) {
                                                            $icon = 'fa-sync fa-spin';
                                                        }
                                                        else {
                                                            $icon = 'fa-times-circle';
                                                        }
                                                    @endphp



                                                    <i class="fas {{ $icon }} text-{{ $color }}"></i>
                                                </span>
                                            </span>
                                        </span>
                                    @endforeach
                                </div>



                                {{-- <span class="p-2">
                                    Receipt Generated <i class="fas fa-check-circle text-success"></i>
                                </span> --}}

                                {{-- <p class="text-white text-center bg-dark fw-bolder border border-light rounded">
                                    {{-- <span class="spinner-grow text-white" role="status" style="width: 7px; height:7px;">
                                    </span> <span class="spinner-grow text-white" role="status" style="width: 7px; height:7px;">
                                    </span> <span class="spinner-grow text-white" role="status" style="width: 7px; height:7px;"></span>
                                </p> --}}
                            </div>
                        </div>
                    </div>


                    {{-- DONATION TIMELINE --}}
                    <div class="border-top border-gray-300 mb-5"></div>
                    <div class="row d-flex justify-content-center mt-70 mb-70">
                        <div class="col-md-12">
                            <div class="main-card mb-3">
                                <h5 class="card-title">
                                    Donation Timeline
                                </h5>
                                <div class="card-body" style="height: 400px; overflow: scroll;">
                                        <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">

                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="fas fa-info-circle"> </i> </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <p>Another meeting with UK client today, at <b class="text-danger">3:00 PM</b></p>
                                                        <p>Yet another one, at <span class="text-success">5:00 PM</span></p> <span class="vertical-timeline-element-date">12:25 PM</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="fas fa-exclamation-circle"></i> </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">Meeting with client</h4>
                                                        <p>
                                                            Meeting with USA Client, today at <a href="javascript:void(0);" data-abc="true">12:00 PM</a>
                                                        </p>
                                                        <span class="vertical-timeline-element-date uppercase">
                                                            Pending
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="vertical-timeline-item vertical-timeline-element">
                                            <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="fas fa-info-circle"> </i> </span>
                                                <div class="vertical-timeline-element-content bounce-in">
                                                    <h4 class="timeline-title">Discussion with team about new product launch</h4>
                                                    <p>meeting with team mates about the launch of new product. and tell them about new features</p> <span class="vertical-timeline-element-date">6:00 PM</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-item vertical-timeline-element">
                                            <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="fas fa-info-circle"> </i> </span>
                                                <div class="vertical-timeline-element-content bounce-in">
                                                    <h4 class="timeline-title text-success">Discussion with marketing team</h4>
                                                    <p>Discussion with marketing team about the popularity of last product</p> <span class="vertical-timeline-element-date">9:00 AM</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-item vertical-timeline-element">
                                            <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="fas fa-info-circle"> </i> </span>
                                                <div class="vertical-timeline-element-content bounce-in">
                                                    <p>Another conference call today, at <b class="text-danger">11:00 AM</b></p>
                                                    <p>Yet another one, at <span class="text-success">1:00 PM</span></p> <span class="vertical-timeline-element-date">12:25 PM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- <br>

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
