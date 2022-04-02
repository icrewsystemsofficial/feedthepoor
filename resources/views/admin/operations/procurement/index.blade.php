@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
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
    .select2 {
        width: 100% !important;
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
            Operations <span class="text-muted">></span> Procurement
        </h3>

        <p class="mt-n2">
            <small>
                Items to be procured for the donation
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
                                    <th>ITEM</th>
                                    <th>QUANTITY</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $tot = array(); @endphp
                                @foreach($operations as $operation)
                                @php 
                                    array_push($tot, $operation->id);
                                @endphp
                                <tr>
                                    <td>{{ $operation->id }}</td>
                                    <td>{{ $operation->procurement_item }}
                                        
                                    </td>
                                    <td>{{ $operation->procurement_quantity }} Number(s)</td>
                                    <td>
                                        {!! App\Helpers\OperationsHelper::getProcurementBadge($operation->status) !!}
                                        {{-- App\Helpers\OperationsHelper::getProcurementStatus($operation->status,$operation->id) --}}
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" type="button" onclick="">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
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
        $('#table').DataTable({
            "columnDefs": [
                { "searchable": true, "targets": 0 },
                { "searchable": true, "targets": 1 },
                { "searchable": false, "targets": 2 },
                { "searchable": true, "targets": 3 },
                { "searchable": false, "targets": 4 }
            ]
        });    
        let selects = {{ json_encode($tot) }};
        selects.forEach(id => {            
            $('#status_'+id).select2();
            $('#status_'+id).on('change', function() {
                let status = $(this).val();
                $.ajax({
                    url: '/admin/operations/procurement/update/'+id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(data) {
                        window.location.reload();
                    }
                });
            });
        });
        let select2s = document.querySelectorAll('.select2');
        select2s.forEach(select2 => {
            select2.style.display = 'none';
        });
    });
</script>
@endsection