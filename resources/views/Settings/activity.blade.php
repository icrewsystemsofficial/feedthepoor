@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<style>
    /* Your Custom Styles Here*/
</style>
@endsection
@section('js')
 <script>
        $(document).ready( function () {
            $('#activity_table').DataTable({
                //Sort the activities based on the ID.
                "order": [[ 1, "asc" ]]
            });
        });
    </script>
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script src="{{ asset('vuexy_theme/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vuexy_theme/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('vuexy_theme/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vuexy_theme/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('vuexy_theme/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('vuexy_theme/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vuexy_theme/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset('vuexy_theme/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>


@endsection
@section('main-content')

<div class="content-header row">
    <div class="content-header col-md-12 col-12 py--1">
        <div class="card">
            <div class="card-body">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">
                            Activity Logs
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                </li>
                                
                                <li class="breadcrumb-item active">
                                Activity Logs
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-12 col-12 py--1">

            <div class="card">
            @if(count($activities) > 0)
                <div class="card-body">

                    <div class="alert alert-info">
                        <div class="alert-body">
                            <strong>
                                Information
                            </strong>
                            All logged activities will be deleted after {{ config('activitylog.delete_records_older_than_days') }} days.
                        </div>
                    </div>

                    <div class="mb-2">
                    <table id="activity_table" class="table table-hover">
                        <thead>
                            <th>Log #</th>
                            <th>Logged By</th>
                            <th>Activity</th>
                            <th>When</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                            <tr>
                                    <td>{{ $activity->id }}</td>

                                    <td>
                                        @if($activity->causer_id)
                                            <a class="btn btn-sm btn-primary" href="" target="_blank">
                                                {{ App\User::find($activity->causer_id)['name'] }}
                                                <i data-feather="user"></i> 
                                            </a>
                                        @else
                                            <span class="">
                                                {{ $activity->subject_type }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($activity->causer_id)
                                            {{ $activity->description }}
                                        @else
                                            Model instance with ID {{ $activity->subject_id }} was {{ $activity->description }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                                    </td>
                                    <td>
                                        <span class="day">
                                            {{\Carbon\Carbon::parse($activity->created_at)->format('g:i A, d/m/Y')  }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                            <div class="alert alert-danger">
                                <div class="alert-body">
                                    <strong>WHOOPS!</strong> No Activity logs
                                </div>
                            </div>
                            @endif
                </div>
        </div>
    </div>
@endsection
