@extends('layouts.admin')

@section('css')
<style>
.active-donation > *{
    background-color: #b6effb !important;
    --bs-table-accent-bg: #b6effb !important;
}
</style>
@endsection

@section('js')

<script>
    $(document).ready(function() {        

        changeBG = (tr) => {
            $('.active-donation').removeClass('active-donation')            
            tr.addClass('active-donation'); 
        }

        $('#table1').DataTable({
            pageLength: 5,
        });
        $('#table2').DataTable();

        $("input[type='search']").attr('id','search');        

        const getUsers =async (role) => {
            const table = $('#table').DataTable();
            $("#search").val(role);
            $("#search").keyup();
            $("#search").focus();
        }

        $.fn.filepond.registerPlugin(FilePondPluginFileValidateType);
        $.fn.filepond.registerPlugin(FilePondPluginImagePreview);
        FilePond.setOptions({
            name: 'donation_media',
            required: true,
            server: {
                url: '/admin/donations/media/upload',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
        let file = FilePond.create(
            document.querySelector('#donation_media')
        );
        $.fn.filepond.setDefaults({
            acceptedFileTypes: ['image/*', 'video/*'],
        });
    });
</script>

@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Donations Media
        </h3>

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
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
            <i class="fa-solid fa-plus"></i> &nbsp; Add new media for a donation
        </button>

        <div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adding new media for donation</h5>
                    </div>
                    <div class="modal-body m-3">

                        <form action="{{ route('admin.donations.media.store') }}" id="new_donation_form" method="POST" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="cause" class="form-label"><b>Donations<b> <span class="required">*</span></label>
                                    <input type="hidden" name="donation_id" id="donation_id" value="">
                                    <div class="alert alert-info">
                                        <p class="display-7">Search and click the donation for which you want to add media</p>
                                    </div>
                                <table id="table1" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>DONOR NAME</th>
                                            <th>DONATION AMOUNT</th>
                                            <th>CAUSE NAME</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($donations as $donation)
                                            <tr onclick="$('#donation_id')[0].value = '{{ $donation->id }}'; changeBG($(this));" style="cursor: pointer;">
                                                <td>{{ $donation->donor_name }}</td>
                                                <td>{{ $donation->donation_amount }}</td>
                                                <td>{{ $donation->cause_name }}</td>
                                                <td>{{ $donation->created_at->todatestring() }}</td>
                                            </tr></a>
                                        @endforeach                                                                            
                                    </tbody>
                                </table>                                
                                <div class="form-group mb-3">
                                    <label for="campaign_poster">Media <span class="required">*</span></label>
                                    <input type="file" class="donation_media" id="donation_media" name="donation_media[]" accept="image/*, video/*" multiple>
                                </div>
                            </div><br>                          
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

        <div class="row">
            <div class="col-12">
                <div class="alert alert-info mb-2">
                    <p class="display-7">The below table shows all donations for which media has been added</p>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table2" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>DONOR NAME</th>
                                        <th>DONATION AMOUNT</th>
                                        <th>CAUSE NAME</th>
                                        <th>DATE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donation_media as $donation)
                                        @php 
                                            $donation_data = App\Helpers\DonationsHelper::getDonation($donation->donation_id);
                                        @endphp
                                        <tr>
                                            <td>{{ $donation_data->donor_name }}</td>
                                            <td>{{ $donation_data->donation_amount }}</td>
                                            <td>{{ $donation_data->cause_name }}</td>
                                            <td>{{ $donation->created_at->todatestring() }}</td>                                            
                                            <td>
                                                <center><a href="{{ route('admin.donations.media.manage', $donation->id) }}" class="btn btn-primary btn-sm mb-2">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.donations.media.destroy', $donation->id) }}" class="btn btn-danger btn-sm badge-danger mb-2">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a></center>
                                                <a href="{{ route('admin.donations.manage', $donation->donation_id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa-solid fa-eye"></i>&nbsp; View donation
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

@endsection
