@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/4.0.0-alpha.1/js/bootstrap-switch.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/4.0.0-alpha.1/css/bootstrap-switch.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .badge-warning {
        background-color: #f0ad4e;
        color: #fff;
    }
    .badge-success {
        background-color: #5cb85c;
        color: #fff;
    }
    .badge-danger {
        background-color: #d9534f;
        color: #fff;
    }
    .badge-info {
        background-color: #5bc0de;
        color: #fff;
    }
    .action-btns {
        width: fit-content;
    }
    input[type="date"]::-webkit-inner-spin-button,
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }
    .hide-date, .hide-goal, .hide-cause {
        display: none !important;
    }
    .show-date, .show-goal, .show-cause {
        display: block !important;
    }
    .form-check {
        padding-left: 0px !important;
    }
    .bootstrap-switch .bootstrap-switch-handle-on,
    .bootstrap-switch .bootstrap-switch-handle-off,
    .bootstrap-switch .bootstrap-switch-label {
        display: inline-block;
        width: 44%;
    }
    .select2 {
        width: 100% !important;
    }
    .hide-badge {
        display: none;
    }
    .show-badge {
        display: block;
        width: fit-content;
    }
</style>

<style>
    .badge-danger {
        background-color: #d9534f;
        color: #fff;
        border-color: transparent;
    }
    .badge-danger:hover {
        background-color: #d9534f;
        color: #fff;
        border-color: transparent;
    }
    .delete-modal {
        font-size: 1.2rem !important;
    }
</style>
@endsection

@section('js')
<script>
    function trigger_delete() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

            Swal.showLoading();

            if (result.isConfirmed) {


                setTimeout(() => {
                    Swal.fire(
                        'Alright!',
                        'Campaign is being deleted..',
                        'success'
                    );

                    document.getElementById('delete_donation_form').submit();
                }, 1500);
            }
        });
    }
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Donations <span class="text-muted">></span> Manage
        </h3>
        <p class="mt-n2">
            <small>
                Edit/delete existing donations
            </small>
        </p>
    </div>
</div>
<div class="row mb-3">
    <div class="col-6">
        <div class="flex d-flex">
            <div>
                <a href="{{ route('admin.donations.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-angle-left me-2"></i> Back
                </a>
            </div>

            <div class="ml-2">
                &nbsp;
            </div>



            <div class="">
                <button class="btn btn-danger" type="button" onclick="trigger_delete();">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>

                {{-- This form is submitted by JS method --}}
                <form action="{{ route('admin.donations.destroy', $donation->id) }}" id="delete_donation_form" method="POST">@csrf @method('DELETE')</form>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="row">
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
<div class="card mt-3">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-12">
            <form action="{{ route('admin.donations.update', $donation->id) }}" id="update_form" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Donor</label>                    
                    <input type="text" class="form-control" id="donor_name" name="donor_name" value="{{ $donation->donor_name }}">
                </div>                
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Donation amount (in INR)</label>
                    <input type="text" id="donation_amount" name="donation_amount" class="form-control" value="{{ $donation->donation_amount }}"/>
                </div>
                <div class="form-group mb-3">
                    <label for="cause_name" class="form-label">Cause</label>
                    <select name="cause_id" id="cause_id" class="form-control select2">
                        {!! App\Helpers\DonationsHelper::getAllCauses($donation->cause_id) !!}
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="payment_method" class="form-label">Payment method</label>
                    <select name="payment_method" id="payment_method" class="form-control select2">                        
                        {!! App\Helpers\DonationsHelper::getAllPaymentMethods($donation->payment_method) !!}
                    </select>
                </div>
                <div class="form-group mb-3 hide-goal">
                    <label for="razorpay_payment_id" class="form-label">Razorpay payment ID</label>
                    <input type="text" id="razorpay_payment_id" name="razorpay_payment_id" class="form-control" value="{{ $donation->razorpay_payment_id }}"/>
                </div>
                <div class="form-group mb-3">
                    <label for="donation_status" class="form-label">Status</label>
                    <div class="mb-2">{!! App\Helpers\DonationsHelper::getStatusBadges($donation->donation_status) !!}</div>
                    <select class="form-control" id="donation_status" name="donation_status">
                        {!! App\Helpers\DonationsHelper::getAllStatuses($donation->donation_status) !!}
                    </select>
                </div>       
                <div class="form-group mb-3">
                    <a href="{{ route('donations.receipt', $donation->id) }}" target="_blank" class="btn btn-primary">
                        <i class="fas fa-eye"></i> View receipt
                    </a>  
                </div>         
                <div class="form-group mb-3">
                    <span onclick="document.getElementById('update_form').submit();">
                        <x-loadingbutton>Save</x-loadingbutton>
                    </span>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {       
        $('#donation_status').on('change',()=>{
            let val = '#'+$('#donation_status option:selected').text();
            $('.show-badge').addClass('hide-badge');
            $('.show-badge').removeClass('show-badge');            
            $(val).removeClass('hide-badge');
            $(val).addClass('show-badge');            
        });
        $('#cause_id').select2({
            placeholder: 'Select cause'
        });
        $('#payment_method').on('change', function() {
            if($(this).val() == 4) {
                $('.hide-goal').addClass('show-goal');
                $('.hide-goal').removeClass('hide-goal');
            } else {
                $('.show-goal').addClass('hide-goal');
                $('.show-goal').removeClass('show-goal');
            }
        });

    });
    $(document).on('select2:open', (e) => {
        const selectId = e.target.id

        $(".select2-search__field[aria-controls='select2-" + selectId + "-results']").each(function (
            key,
            value,
        ){
            value.focus();
        })
    });
    //
</script>
@endsection
