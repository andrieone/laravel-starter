{{--@extends('auth.layouts.admin_app')--}}
@extends('auth.layouts.superadmin')

<!-- title -->
@section('title', 'Administrator Login Page | ' . env('APP_NAME',''))

@section('content')
    {{--    <div class="container">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-md-8 col-md-offset-2">--}}
    {{--                <div class="panel panel-default">--}}
    {{--                    <div class="panel-heading">Admin Login</div>--}}

    {{--                    <div class="panel-body">--}}
    {{--                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">--}}
    {{--                            @csrf--}}

    {{--                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
    {{--                                <label for="email" class="col-md-4 control-label">{{ __('E-Mail Address') }}</label>--}}

    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="email" type="email"--}}
    {{--                                           class="form-control @error('email') is-invalid @enderror" name="email"--}}
    {{--                                           value="{{ old('email') }}" required autocomplete="email"--}}
    {{--                                           placeholder="Enter Email Address" autofocus>--}}

    {{--                                    @error('email')--}}
    {{--                                    <span class="help-block" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
    {{--                                <label for="password" class="col-md-4 control-label ">{{ __('Password') }}</label>--}}

    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="password" type="password"--}}
    {{--                                           class="form-control @error('password') is-invalid @enderror" name="password"--}}
    {{--                                           required autocomplete="current-password" placeholder="Enter Password">--}}

    {{--                                    @error('password')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group">--}}
    {{--                                <div class="col-md-6 col-md-offset-4">--}}
    {{--                                    <div class="checkbox">--}}
    {{--                                        <label>--}}
    {{--                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}--}}
    {{--                                        </label>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group">--}}
    {{--                                <div class="col-md-8 col-md-offset-4">--}}
    {{--                                    <button type="submit" class="btn btn-primary">--}}
    {{--                                        <span>{{ __('Login') }}</span>--}}
    {{--                                    </button>--}}
    {{--                                    @if (Route::has('password.request'))--}}
    {{--                                        <a class="btn btn-link" href="{{ route('password.request') }}">--}}
    {{--                                            <span>{{ __('Forgot Your Password?') }}</span>--}}
    {{--                                        </a>--}}
    {{--                                    @endif--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </form>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">管理者ログイン</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3 {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input id="email" type="email" class="form-control @error('email')is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="@lang('label.enterEmailAddress')" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="help-block" role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
                <div class="input-group mb-3{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password"
                        class="form-control @error('password')is-invalid @enderror" name="password"
                        required autocomplete="current-password" placeholder="@lang('label.enterPassword')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} >
                            <label for="remember">
                                @lang('label.remember')
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">@lang('label.login')</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        {{--<div class="social-auth-links text-center mb-3">--}}
        {{--    <p>- OR -</p>--}}
        {{--    <a href="#" class="btn btn-block btn-primary">--}}
        {{--        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook--}}
        {{--    </a>--}}
        {{--    <a href="#" class="btn btn-block btn-danger">--}}
        {{--        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+--}}
        {{--    </a>--}}
        {{--</div>--}}
        <!-- /.social-auth-links -->

            {{--@if (Route::has('password.request'))--}}
            {{--    <p class="mb-1">--}}
            {{--        <a href="{{ route('password.request') }}">{{ __('I forgot my password') }}</a>--}}
            {{--    </p>--}}
            {{--@endif--}}
            {{--<p class="mb-0">--}}
            {{--    <a href="#" class="text-center">Register a new membership</a>--}}
            {{--</p>--}}
        </div>
        <!-- /.login-card-body -->
    </div>
@endsection
