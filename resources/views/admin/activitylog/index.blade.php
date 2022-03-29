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

    .select2-close-mask {
        z-index: 2099;
    }

    .select2-dropdown {
        z-index: 3051;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Activitiy log
        </h3>

        <p class="mt-n2">
            <small>
                Review your activities
            </small>
        </p>

        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <table id="table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TIME</th>
                                    <th>ACTIVITY</th>
                                    <th>USER</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Activitys as $Activity)
                                <tr>
                                    <td>{{ $Activity->id }}</td>
                                    <td>{{$Activity->updated_at }}</td>
                                    <td>{{$Activity->description }}</td>
                                    <td>{{$Activity->log_name }}</td>

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
        $('#manager_id').select2({
            dropdownParent: $("#defaultModalPrimary .modal-body"),
            dropdownAutoWidth: false,
            placeholder: 'Select a manager'
        });
    });
    $(document).on('select2:open', (e) => {
        const selectId = e.target.id

        $(".select2-search__field[aria-controls='select2-" + selectId + "-results']").each(function(
            key,
            value,
        ) {
            value.focus();
        })
    })
</script>
@endsection