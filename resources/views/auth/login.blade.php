@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 col-lg-10">
        <div class="wrap d-md-flex">
            <div class="img">
            <img src="{{ asset('assets/img/logo_app.jpg') }}" style="width: 100%">
            </div>
            <div class="login-wrap p-4 p-md-5">
                <div class="d-flex">
                    <div class="w-100">
                        <h3 class="mb-4">{{ __('Login') }}</h3>
                    </div>
                </div>
                <form method="POST" action="{{ route('doLogin') }}">
                @csrf
                    <div class="form-group mb-3">
                        <label for="email">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! session('messages') !!}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! session('messages') !!}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary rounded px-3">{{ __('Login') }}</button>
                    </div>
                    <div class="form-group d-md-flex">
                        <div class="w-50 text-left">
                            <label class="checkbox-wrap checkbox-primary mb-0" for="remember">{{ __('Remember Me') }}
                                <input class="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
