@extends('layouts.app')

@section('style')

    <link rel="stylesheet" href="{{URL::asset('test_theme_dashboard/creative.min.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('test_theme_dashboard/magnific-popup.css')}}"/>

    <style>
        .navbar-custom {
            padding: 10px 0;
        }

        a > img {
            width: 100%;
        }

        .main-body {
            margin: 30px 15px 10px;
            overflow: hidden;
            padding: 10px 10px;
            margin-bottom: 90px;
        }

    </style>
@stop

@section('content')
<div class="container">
    <div class="row" style="margin-top: 80px;">
        <div class="col-md-8 col-md-offset-2" style="margin-top: 30px">
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('label.auth.login.title')}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{trans('label.auth.login.email')}}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{trans('label.auth.login.password')}}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>
                                        {{trans('label.auth.login.remember')}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('label.auth.login.title')}}
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    {{trans('label.auth.login.forgot_password')}}
                                </a>
                                <a class="btn btn-link" href="{{ url('login/facebook') }}">
                                    <i class="fa fa-facebook-square" style="font-size: 20px;" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
