@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/4.0.0-alpha.1/js/bootstrap-switch.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/4.0.0-alpha.1/css/bootstrap-switch.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .badge {
        cursor: pointer;
    }
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
    .select2-close-mask{
        z-index: 2099;
    }
    .select2-dropdown{
        z-index: 3051;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Donations
        </h3>

        <p class="mt-n2">
            <small>
                Contributions to make someones life better
            </small>
        </p>

        @if ($errors->any())
            <div class="row p-3">
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
            <i class="fa-solid fa-plus"></i> &nbsp; Add new donation
        </button>

        <div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adding new donation</h5>
                    </div>
                    <div class="modal-body m-3">

                        <form action="{{ route('admin.donations.store') }}" id="new_donation_form" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Donor</label>
                                <select name="donor_id" id="donor_id" class="form-control" style="width: 100%;">
                                    <option></option>
                                    {!! App\Helpers\DonationsHelper::getAllDonors() !!}
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="amount" class="form-label">Donation amount</label>
                                <input type="number" name="donation_amount" id="donation_amount" class="form-control" placeholder="Enter donation amount">
                            </div>
                            <div class="form-group mb-3">
                                <label for="cause" class="form-label">Cause</label>
                                <select name="cause_id" id="cause_id" class="form-control" style="width: 100%;">
                                    <option></option>
                                    {!! App\Helpers\DonationsHelper::getAllCauses() !!}
                                </select>
                            </div>                            
                            <div class="form-group mb-3">
                                <label for="payment_method" class="form-label">Payment method</label>
                                <select name="payment_method" id="payment_method" class="form-control" style="width: 100%;">
                                    {!! App\Helpers\DonationsHelper::getAllPaymentMethods() !!}
                                </select>
                            </div>
                            <div class="form-group mb-3 hide-goal">
                                <label for="razorpay_payment_id" class="form-label">Razorpay payment id</label>
                                <input type="text" name="razorpay_payment_id" id="razorpay_payment_id" class="form-control" placeholder="Enter razorpay payment id">
                            </div>
                            <div class="form-group mb-3">
                                <label for="status" class="form-label">Donation status</label>
                                <select name="donation_status" id="donation_status" class="form-control" style="width: 100%;">
                                    {!! App\Helpers\DonationsHelper::getAllStatuses() !!}
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <span onclick="document.getElementById('new_donation_form').submit()">
                                    <x-loadingbutton type="submit">Create</x-loadingbutton>
                                </span>
                            </div>

                    </form>
                </div>
            </div>
        </div>
        </div>

        @if(session('success'))

            <div class="row p-3">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>

        @endif

        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <table id="table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>DONOR</th>
                                    <th>AMOUNT</th>
                                    <th>CAUSE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donations as $donation)
                                <tr>
                                    <td>{{ $donation->id }}</td>
                                    <td>{{ $donation->donor_name }}</td>
                                    <td>₹ {{ $donation->donation_amount }}</td>
                                    <td>{{ $donation->cause_name }}</td>
                                    <td>
                                        {!! App\Helpers\DonationsHelper::getStatus($donation->donation_status) !!}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.donations.manage', $donation->id) }}" class="btn btn-primary btn-sm">
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
    $('#donor_id').select2({
        dropdownParent: $("#defaultModalPrimary .modal-body"),
        dropdownAutoWidth : false,
        placeholder: 'Select donor'
    });
    $('#cause_id').select2({
        dropdownParent: $("#defaultModalPrimary .modal-body"),
        dropdownAutoWidth : false,
        placeholder: 'Select cause'
    });
    $('#table').DataTable();
    $("input[type='search']").attr('id','search');
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
})
</script>
@endsection
