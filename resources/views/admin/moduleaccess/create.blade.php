@extends('layouts.admin')

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
                            'Location is being deleted..',
                            'success'
                        );

                        document.getElementById('delete_location_form').submit();
                    }, 1500);
                }
            });
        }
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h3>
                Module Access <span class="text-muted">></span> Create
            </h3>
            {{-- <p class="mt-n2">--}}
            {{--                <small>--}}
            {{--                    Edit/delete existing locations--}}
            {{--                </small>--}}
            {{--            </p> --}}
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <div class="flex d-flex">
                <div>
                    <a href="{{ route('admin.access.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-angle-left me-2"></i> Back
                    </a>
                </div>

            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="row">
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

                    <form action="{{ route('admin.access.store') }}" id="update_form" method="POST" autocomplete="off">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="name" class="form-label">Module name</label>
                            <input type="text" id="location_name" name="module_name" class="form-control"/>
                        </div>
                        <div class="form-group mb-2">
                            <label for="address" class="form-label">Module Controller Class</label>
                            <select name="module_controller_class" id="contr_id" class="form-control">
                                <option selected disabled>Choose Controller Class</option>
                                @foreach ($controllers as $key => $value)

                                    <option value="{{ $value[0] }}">{{ $value[0] }}</option>
                                    {{--                                    <option value="{{ $route->uri() }}">{{ $route->uri() }}</option>--}}
                                @endforeach
                            </select>
                        </div>
{{--                        {{ dd($routes[20]->action['as']) }}--}}
                        <div class="form-group mb-2">
                            <label for="description" class="form-label">Module Routes </label>
                            {{--<input type="text" class="form-control" id="description" name="module_route_path" value="">--}}
                            <select name="module_route_path[]" id="routes_id" class="form-control" multiple>
                                <option  disabled>Choose Routes</option>

                                @foreach ($routes as $key => $value)

                                    <option value="{{ $key }}">{{ $key }}</option>
{{--                                    <option value="{{ $route->uri() }}">{{ $route->uri() }}</option>--}}
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group mb-5">
                            <label for="manager_id" class="form-label">Module Permissions</label>
                            <select name="permissions_that_can_access[]" id="manager_id" class="form-control" multiple>
                                <option disabled>Choose Permissions</option>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                        <span onclick="document.getElementById('update_form').submit();">
                            <x-loadingbutton>Save</x-loadingbutton>
                        </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            $('#manager_id, #contr_id,#routes_id').select2();
            // $().select2();
        });
    </script>
@endsection
