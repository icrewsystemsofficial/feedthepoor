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

                    document.getElementById('delete_campaign_form').submit();
                }, 1500);
            }
        });
    }
</script>

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
            Donations Media <span class="text-muted">></span> Manage
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
        </div>

        <div class="row">
            <div class="col-12">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donations as $donation)
                                        <tr>
                                            <td>{{ $donation->donor_name }}</td>
                                            <td>{{ $donation->donation_amount }}</td>
                                            <td>{{ $donation->cause_name }}</td>
                                            <td>{{ $donation->created_at->todatestring() }}</td>                                                                                        
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
