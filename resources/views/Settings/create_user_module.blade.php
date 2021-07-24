@extends('layouts.admin')


@section('css')
<style>
    /* Your Custom Styles Here*/
</style>
@endsection

@section('js')

@endsection


@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('User Management') }}</h1>

@if ($errors->any())
<div class="alert alert-danger border-left-danger" role="alert">
    <ul class="pl-4 my-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

                <form action="{{ route('user.create.new') }}"  method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">


                    <div class="form-group">
                        <label class="control-label col-sm2" for="name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="email">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm2" for="status">Role</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="role">
                                <option value="guest"  selected>Guest</option>
                                <option value="donor">Donor</option>
                                <option value="volunteer">Volunteer</option>
                                <option value="staff">Staff</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                   
                        <button type="submit" class="btn btn-success" data-dismiss="modal">
                            <span id="footer_action_button" class="glyphicon glyphicon">Create</span>
                        </button>

                </form>
@endsection
