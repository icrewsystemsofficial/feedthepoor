@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Settings > Activity logs
        </h3>

        <p class="mt-n2">
            <small>
                Application logs for all the activities that happened within the app.
            </small>
        </p>

        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <table id="table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ACTIVITY</th>
                                    <th>USER</th>
                                    <th>TIME</th>
                                    <th>TIMESTAMP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $activity)
                                <tr>
                                    <td>{{ $activity->description }}</td>
                                    <td>{{ ($activity->causer_id == null) ? 'No user associated' : App\Models\User::find($activity->causer_id)->name }} (WIP)</td>
                                    <td>{{ $activity->created_at->format('d/m/Y H:i A ') }}</td>
                                    <td>{{ $activity->created_at->diffForHumans() }}</td>
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
