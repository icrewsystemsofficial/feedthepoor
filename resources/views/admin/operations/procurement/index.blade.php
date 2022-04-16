@extends('layouts.admin')

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
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="card" style="height: 100%;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h1 class="card-title">Items Delivered</h1>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="truck"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3" id="procured">{{ $procured }}</h1>
                        <div class="mb-0">
                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                @if($total > 0)
                                <span id="procuredPercent">{{ $procuredPercent }}</span>% <span class="text-muted">of total</span>
                                @else
                                Not enough data
                                @endif
                            </span>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="height: 100%;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h1 class="card-title">Items To Procure</h1>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="truck"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3" id="toProcure">{{ $toProcure }}</h1>
                        <div class="mb-0">
                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                @if($total > 0)
                                <span id="toProcurePercent">{{ $toProcurePercent }}</span>% <span class="text-muted">of total</span>
                                @else
                                Not enough data
                                @endif
                            </span>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="height: 100%;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h1 class="card-title">Average items procured per month</h1>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="truck"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3" id="avgProcured">{{ round($procured/12,2) }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="height: 90%;">
                    <div class="card-body">
                        <div id="chart1" style="height: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="height: 90%;">
                    <div class="card-body">
                        @php
                            $statuses = App\Helpers\OperationsHelper::getStatusNumbers();
                        @endphp
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statuses as $status => $val)
                                    <tr>
                                        <td>{!! App\Helpers\OperationsHelper::getProcurementBadge($status) !!}</td>
                                        <td id="table_{{ $status }}">{{ $val }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="container col-md-12 well">
                        <table id="table" class="table table-striped nowrap dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th data-priority=1>ITEM</th>
                                    <th>QUANTITY</th>
                                    <th data-priority=2>STATUS</th>
                                    <th class="none">LOCATION</th>
                                    <th class="none">DONATION</th>
                                    <th class="none">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($operations as $operation)
                                <tr>
                                    <td>{{ $operation->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <strong>
                                            {{ $operation->procurement_item }}
                                        </strong>
                                        <br>
                                        
                                        <div id="badge_{{ $operation->id }}">
                                            {!! App\Helpers\OperationsHelper::getProcurementBadge($operation->status) !!}
                                        </div>

                                    </td>
                                    <td>{{ $operation->procurement_quantity }}</td>
                                    <td>
                                        {!! App\Helpers\OperationsHelper::getProcurementStatus($operation->status,$operation->id) !!}
                                    </td>
                                    <td>
                                        <span class="badge badge-info" onclick="showLocation({{ $operation->location_id }})">
                                            {{ App\Helpers\OperationsHelper::getProcurementLocation($operation->location_id) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.donations.manage', $operation->donation_id) }}" class="btn btn-sm btn-primary" target="_blank">
                                            Donation #{{ $operation->donation_id }}
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" type="button" onclick="trigger_delete({{ $operation->id }})">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                        <form action="{{ route('admin.operations.destroy', $operation->id) }}" id="delete_procurement_{{ $operation->id }}" method="POST">@csrf @method('DELETE')</form>
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
<script async>
    function trigger_delete(id) {

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
                document.getElementById('delete_procurement_'+id).submit();
            }
        });

    }
    function showLocation(id){

        window.open("{{ route('admin.location.manage', ':id') }}".replace(':id', id), '_blank');

    }
    $(document).ready(function() {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
        });

        let table = $('#table').DataTable({
            "columnDefs": [
                { "searchable": true, "targets": 0 },
                { "searchable": true, "targets": 1 },
                { "searchable": false, "targets": 2 },
                { "searchable": true, "targets": 3 },
                { "searchable": false, "targets": 4 }
            ],
            responsive: true,
        });

        $("input[type='search']").attr('id','search');
        $.fn.DataTable.ext.search.push((_,__,i) => {
            const currentTr = table.row(i).node();
            const inputMatch = $(currentTr)
                .find('select,input')
                .toArray()
                .some(x => $(x).val().toLowerCase().includes( $('input[type="search"]').val().toLowerCase()));
            const textMatch = $(currentTr)
                .children()
                .not('td:has("input,select")')
                .toArray()
                .some(x => $(x).text().toLowerCase().includes( $('input[type="search"]').val().toLowerCase()));                
            return inputMatch || textMatch || $('input[type="search"]').val() == '';
        });
        $('input[type="search"]').on('keyup', () => table.draw());
        
        let selects = {{ json_encode($allOperations) }};
        selects.forEach(id => {
            $('#status_'+id).select2();
            $('#location_'+id).select2();
            $('#status_'+id).on('change', function() {
                let status = $(this).val();
                $.ajax({
                    url: '/admin/operations/procurement/update/'+id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status,
                        last_updated_by: {{ Auth::user()->id }}
                    },
                    success: function(data) {
                        $('#table_'+data.status_new).text(parseInt($('#table_'+data.status_new).text())+1);
                        $('#table_'+data.status_old).text(parseInt($('#table_'+data.status_old).text())-1);
                        let oldStatus = data.status_old;
                        let newStatus = data.status_new;
                        let total = {{ $total }};
                        if (newStatus == 'FULFILLED'){
                            let newProcured = parseInt($('#procured').text()) + 1;
                            let newToProcure = parseInt($('#toProcure').text()) - 1;
                            $('#procured').text(newProcured);
                            $('#toProcure').text(newToProcure);
                            $('#procuredPercent').text((newProcured/total*100).toFixed(2));
                            $('#toProcurePercent').text((newToProcure/total*100).toFixed(2));
                            $('#avgProcured').text((newProcured/12).toFixed(2));
                        }
                        else if (oldStatus == 'FULFILLED'){
                            let newProcured = parseInt($('#procured').text()) - 1;
                            let newToProcure = parseInt($('#toProcure').text()) + 1;
                            $('#procured').text(newProcured);
                            $('#toProcure').text(newToProcure);
                            $('#procuredPercent').text((newProcured/total*100).toFixed(2));
                            $('#toProcurePercent').text((newToProcure/total*100).toFixed(2));
                            $('#avgProcured').text((newProcured/12).toFixed(2));
                        }
                        $('#badge_'+id)[0].innerHTML = data.badge;
                        Toast.fire({
                            icon: 'success',
                            title: 'Status of this item has been updated successfully'
                        });
                    },
                    error: function(data) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Unable to update status'
                        });                                            
                    }
                });
            });

        });

    });
</script>

<script>
    const chart1 = new Chartisan({
      el: '#chart1',
      url: "@chart('daily_procurement')",
      hooks: new ChartisanHooks()
                .colors(['#388299', '#ff9c9c'])
                .legend({ bottom: 0 })
                .datasets('line')
                .title({
                    textAlign: 'center',
                    left: '50%',
                    text: 'Monthly orders',
                })
                .tooltip(),
    });
</script>
@endsection
