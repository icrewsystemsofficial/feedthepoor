@extends('layouts.admin')
@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script defer>
        $(document).ready(function () {
            $('#table').DataTable({
                responsive: true
            });

        });
    </script>

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h3>
                <strong>Admin Tools</strong> Module Access
            </h3>

            {{--            <p class="mt-n2">--}}
            {{--                <small>--}}
            {{--                    Contributions to make someones life better--}}
            {{--                </small>--}}
            {{--            </p>--}}


            <a href="{{ route('admin.access.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> &nbsp; Add
            </a>

            <a href="{{ route('admin.users.index') }}" target="_blank" class="btn btn-primary">
                <i class="fa-solid fa-users"></i> &nbsp; View Users, their roles and permissions
            </a>


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

                            <div class="alert alert-info">
                                <h3 class="h4 text-info">
                                    <strong>
                                    <i class="fas fa-info-circle"></i> How to use?
                                    </strong>
                                </h3>
                                <p>
                                    This is a module from which you can centrally govern the access permissions of the entire app.
                                    You need basic understanding of Laravel Routes to manipulate this, hence, if you don't know what you're doing, please
                                    reachout to development team.
                                </p>
                            </div>

                            <table id="table" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Module Name</th>
{{--                                    <th>Module Controller</th>--}}
                                    <th>Module Routes</th>
                                    <th>Module Permissions</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($module_accesses as $module_access)
                                    <tr>
                                        <td>{{ ucfirst($module_access->module_name) }}</td>
{{--                                        <td>{{ $module_access->module_controller_class }}</td>--}}
                                        <td>
                                            @foreach (json_decode($module_access->module_route_path) as $key => $value)
                                                <span class="badge bg-success">{{ $value }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach (json_decode($module_access->permissions_that_can_access) as $key => $value)
                                                <span class="badge bg-info">{{ $value }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.access.edit',$module_access->id) }}" class="btn btn-primary btn-sm">
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
