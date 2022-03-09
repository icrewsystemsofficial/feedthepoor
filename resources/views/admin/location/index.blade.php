@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script defer>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
</script>
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
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Locations
        </h3>

        <p class="mt-n2">
            <small>
                The places where our donation activities take place
            </small>
        </p>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
            <i class="fa-solid fa-plus"></i> &nbsp; Add new Location
        </button>

        <div x-data="createSettings()" class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adding new setting</h5>
                    </div>
                    <div class="modal-body m-3">

                        <form action="{{ route('admin.settings.create') }}" id="new_settings_form" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required="required">
                            </div>

                            <div class="form-group mb-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>




                            <div class="">
                                <div class="form-group mb-2" x-show="showValueInputs.showText">
                                    <label class="form-label">Value<span class="text-danger">*</span></label>

                                    <input
                                        x-model="settingValue"
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter value for this setting"
                                        required="required"
                                    />
                                </div>

                                <div class="form-group mb-2" x-show="showValueInputs.showTextArea">
                                    <label class="form-label">Value<span class="text-danger">*</span></label>
                                    <textarea
                                        x-model="settingValue"
                                        class="form-control"
                                        placeholder="Enter value for this setting"
                                        required="required"
                                    ></textarea>
                                </div>

                                <div class="form-check form-switch mb-2 mt-3" x-show="showValueInputs.showBoolean">
                                    <input
                                        x-model="settingValue"
                                        class="form-check-input"
                                        type="checkbox"
                                        id="value" />


                                    <label class="form-check-label" for="value">
                                        <strong>Enabled?</strong>
                                    </label>
                                </div>


                                {{-- Masking the inputs into this element --}}
                                <input type="hidden" x-model="settingValue" name="value"></span>
                            </div>

                            <div class="form-check form-switch mb-2 mt-3">
                                <input class="form-check-input" type="checkbox" id="core_setting" @click="updateCoreSettingValue">
                                <label class="form-check-label">
                                    <strong>Core Setting?</strong>
                                    <span class="text-muted">
                                        this will override default config values with same keys
                                    </span>
                                </label>

                                <input type="hidden" name="core_setting" x-bind:value="coreSettingValue" />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <span @click="submitForm">
                            <x-loadingbutton type="submit">Create</x-loadingbutton>
                        </span>
                    </div>

                    </form>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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
                                    <th>NAME</th>
                                    <th>MANAGER</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($locations as $location)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $location->location_name }}</td>
                                    <td><a href="">{{ $location->user->name }}</a> (TODO)</td>
                                    <td>
                                        {!! App\Helpers\LocationHelper::getStatus($location->location_status) !!}
                                        {{-- {{ App\Helpers\LocationHelper::getStatus($location->location_status) }} --}}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.location.manage', $location->id) }}" class="btn btn-primary btn-sm">
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
@endsection
