@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Set Password') }}</h1>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger border-left-danger" role="alert">
                                        <ul class="pl-4 my-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('user.create.password') }}" class="user">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="id" value="{{ $data->id }}" >
                                    <input type="hidden" name="role" value="{{ $data->role }}" >
                                    <input type="hidden" name="name" value="{{ $data->name }}" >

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" value="{{ $data->email }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="password" required>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
