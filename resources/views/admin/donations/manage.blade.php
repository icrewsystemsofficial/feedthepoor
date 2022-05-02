@extends('layouts.admin')

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

<div class="row">
    <div class="col-md-4">
        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">
                    DONOR DETAILS
                </h3>
                <div class="row mb-3">
                    <div class="card-title">
                        Name
                    </div>
                    <div class="card-text">
                        {{ $user->name }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="card-title">
                        Email
                    </div>
                    <div class="card-text">
                        {{ $user->email }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="card-title">
                        Contact
                    </div>
                    <div class="card-text">
                        {!! $user->phone_number ?? '<span class="text-danger"><i class="fa-solid fa-exclamation-triangle"></i> NOT PROVIDED</span>' !!}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="card-title">
                        Joined on
                    </div>
                    <div class="card-text">
                        {{ $user->created_at->format('d M Y') }}
                    </div>
                </div>

                <a href="{{ route('admin.users.manage', $donation->donor_id) }}" target="_blank" class="btn btn-sm btn-primary">
                    View donor profile
                </a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">
                    MISSION DETAILS
                </h3>

                <div class="alert alert-danger">
                    This is still a work in progress.
                    When complete, should be able to pull the details of the mission this donation was assigned to.
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">
                    DONATION DETAILS
                    <br>
                    {!! App\Helpers\DonationsHelper::getStatusBadges($donation->donation_status) !!}
                </h3>
                <small class="text-muted">
                    This donation was last updated on {{ $donation->updated_at->format('d M Y') }}
                </small>
                <div class="row mb-3">
                    <div class="col-md-12">
                    <form action="{{ route('admin.donations.update', $donation->id) }}" id="update_form" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Donation amount (in INR)</label>
                            <input type="text" id="donation_amount" name="donation_amount" class="form-control" value="{{ $donation->donation_amount }}" disabled/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Donation amount (in words)</label>
                            <input type="text" class="form-control" value="{{ $donation->donation_in_words }}" disabled/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Date of Donation</label>
                            <input type="text" class="form-control" value="{{ $donation->created_at->format('d M Y') }}" disabled/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="payment_method" class="form-label">Payment method</label>
                            <select name="payment_method" id="payment_method" class="form-control select2" disabled>
                                {!! App\Helpers\DonationsHelper::getAllPaymentMethods($donation->payment_method) !!}
                            </select>
                        </div>
                        <div class="form-group mb-3 hide-goal">
                            <label for="razorpay_payment_id" class="form-label">Razorpay payment ID</label>
                            <input type="text" id="razorpay_payment_id" name="razorpay_payment_id" class="form-control" value="{{ $donation->razorpay_payment_id }}" disabled/>
                        </div>
                        <div class="form-group mb-3">
                            <a href="{{ route('frontend.donations.receipt', $donation->razorpay_payment_id) }}" target="_blank" class="btn btn-sm btn-primary">
                                View receipt
                            </a>

                            @if($donation->payment_method == App\Models\Donations::$payment_methods['RAZORPAY'])
                            <a href=" https://dashboard.razorpay.com/app/payments/{{ $donation->razorpay_payment_id }}" target="_blank" class="btn btn-sm btn-primary">
                                View on Razorpay
                            </a>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="cause_name" class="form-label">Cause</label>
                            <select name="cause_id" id="cause_id" class="form-control select2">
                                {!! App\Helpers\DonationsHelper::getAllCauses($donation->cause_id) !!}
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="campaign_name" class="form-label">Campaign</label>
                            <select name="campaign_id" id="campaign_id" class="form-control select2">
                                {!! App\Helpers\DonationsHelper::getAllCampaigns($donation->campaign_id) !!}
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="donation_status" class="form-label">Status</label>
                            <select class="form-control" id="donation_status" name="donation_status">
                                {!! App\Helpers\DonationsHelper::getAllStatuses($donation->donation_status) !!}
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            {{-- These items are disabled --}}
                            <input type="hidden" name="donor_name" value="{{ $donation->donor_name }}" />
                            <input type="hidden" name="donation_amount" value="{{ $donation->donation_amount }}"/>
                            <input type="hidden" name="payment_method" value="{{ $donation->payment_method }}"/>
                            <input type="hidden" name="razorpay_payment_id" value="{{ $donation->razorpay_payment_id }}"/>
                            <span onclick="document.getElementById('update_form').submit();">
                                <x-loadingbutton>Save</x-loadingbutton>
                            </span>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-3">
                    <h3>
                        Other donations from <strong>{{ $user->name }}</strong> ({{ count($all_donations) }})
                    </h3>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <table id="table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>AMOUNT</th>
                                    <th>CAUSE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_donations as $per_donation)
                                <tr>
                                    <td>{{ $per_donation->id }}</td>
                                    <td>₹ {{ $per_donation->donation_amount }}</td>
                                    <td>{{ $per_donation->cause_name }}</td>
                                    <td>
                                        {!! App\Helpers\DonationsHelper::getStatus($per_donation->donation_status) !!}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.donations.manage', $per_donation->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-edit"></i> &nbsp;
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#table').DataTable();
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
        $('#campaign_id').select2({
            placeholder: 'Select campaign'
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
