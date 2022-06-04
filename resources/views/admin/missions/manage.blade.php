@extends('layouts.admin')

@section('js')
<script>
    $(document).ready(function() {
        $('#table').DataTable();
        $('.volunteers_select').select2({
            placeholder: 'Select available volunteers to assign to this mission'
        });
        $('#field_manager_id').select2({
            placeholder: 'Select a field manager'
        });
        const picker = new Litepicker({ 
            element: document.getElementById('execution_date'),
            resetButton: true,
            minDate: new Date(),
        });
    } );
</script>
@endsection

@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>Missions</strong> Create</h1>

    <div class="row">
        <div class="col-12">
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

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.missions.store') }}" id="mission_create_form" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="execution_date" class="form-label">Mission Execution Date</label>
                            <input type="date" name="execution_date" id="execution_date" class="form-control" value="{{ $mission->execution_date }}"/>
                        </div>

                        <div class="form-group mb-3">
                            <label for="field_manager_id" class="form-label">Field Manager</label>
                            <select name="field_manager_id" id="field_manager_id" class="form-control select2" style="width: 100%;">
                                @foreach ($field_managers as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $mission->field_manager_id ? 'selected':'' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <div class="px-3">
                                <div class="table-responsive card p-3">
                                    <div class="alert alert-info">
                                        Procurement Item(s) that are marked "READY FOR DISPATCH" in {{ $location }}
                                    </div>
                                    <table class="table table-borderless" id="table">
                                        <thead>
                                            <th>ID</th>
                                            <th>CAUSE/CAMPAIGN</th>
                                            <th>QTY</th>
                                            <th>ADD TO MISSION</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($procurement_items as $list)
                                                <tr>
                                                    <td>
                                                        {{ $list->id }}
                                                    </td>
                                                    <td>
                                                        {{ $list->procurement_item }}
                                                    </td>
                                                    <td>
                                                        {{ $list->procurement_quantity }}
                                                    </td>
                                                    <td>
                                                        <label class="switch mb-2">
                                                            <input
                                                                type="checkbox"
                                                                name="procurement_item_{{ $list->id }}"
                                                                {{-- id="id_{{ Str::snake($list->procurement_item) }}" --}}
                                                                id="{{ $list->id }}"
                                                                {{in_array($list->id,$procurement_items) ? 'checked="checked"':''}}
                                                            />
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                        <div class="form-group mb-3">
                            <label for="assigned_volunteers">
                                Volunteers
                            </label>
                            <select name="assigned_volunteers[]" id="volunteers_id" multiple class="volunteers_select form-control">
                                @foreach ($active_volunteers as $volunteer)
                                    <option value="{{ $volunteer->id }}" {{ in_array($volunteer->id,$volunteers) 'selected':'' }}>
                                        {{ $volunteer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">
                                Description
                            </label>
                            <textarea name="description" id="description" class="form-control" rows="3" value="{{ $mission->description }}"></textarea>
                            <input name="id" type="hidden" value="{{ $mission->id }}">
                            <input name="location" type="hidden" value="{{ $location }}">
                        </div>

                        <div class="modal-footer">
                            <span onclick="document.getElementById('mission_create_form').submit()">
                                <x-loadingbutton type="submit">Create</x-loadingbutton>
                            </span>
                        </div>

                </form>
                </div>
            </div>
@endsection