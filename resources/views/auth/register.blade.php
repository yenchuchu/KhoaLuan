@extends('layouts.app')

@section('style')
    <style>

        /*.block-12 label>a {*/
            /*color: #1b2e3a;*/
            /*padding: 10px 23px;*/
        /*}*/

        .block-12 a>label:active,
        .block-12 a>label:focus {
            background-color: #00b1b3;
            color: white !important;
        }

        .block-12 a:hover,
        .block-12 a:focus {
            text-decoration: none !important;
        }

        .block-12 .option .item {
            float: left;
            position: relative;
        }

        .block-12 .option .radio {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
        }

        .block-12 input, select, textarea {
            vertical-align: middle;
            font-family: inherit;
            font-size: inherit;
            border: 0;
            outline: 0;
            color: #1b2e3a;
        }

        .block-12 .option .radio:checked ~ label {
            background: #00b1b3;
            color: #fff;
        }

        .block-12 .option .radio:checked ~ label>a {
            color: white !important;
        }

        .block-12 .option .item:first-child label {
            border-radius: 3px 0 0 3px;
        }

        .block-12 .option label {
            display: block;
            width: 110px;
            height: 36px;
            line-height: 36px;
            text-align: center;
            background: #eee;
            cursor: pointer;
        }

        .block-12 .option .item {
            float: left;
            position: relative;
        }


    </style>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="margin-top: 30px">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('label.auth.register.title')}}</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                                <label for="full_name" class="col-md-4 control-label">
                                    {{trans('label.auth.register.full_name')}}
                                </label>

                                <div class="col-md-6">
                                    <input id="full_name" type="text" class="form-control" name="full_name"
                                           value="{{ old('full_name') }}" required autofocus>

                                    @if ($errors->has('full_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                                <label for="user_name" class="col-md-4 control-label">{{trans('label.auth.register.user_name')}}</label>

                                <div class="col-md-6">
                                    <input id="user_name" type="text" class="form-control" name="user_name"
                                           value="{{ old('user_name') }}" required autofocus>

                                    @if ($errors->has('user_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">{{trans('label.auth.register.email')}}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">
                                    {{trans('label.auth.register.password')}}
                                </label>

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
                                <label for="password-confirm" class="col-md-4 control-label">
                                    {{trans('label.auth.register.confirm_password')}}
                                </label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="choose-object" class="col-md-4 control-label">{{trans('label.auth.register.choose_type')}}</label>
                                <div class="col-md-6 block-12">
                                    <div class="option">
                                        <div class="group nav nav-tabs" >
                                            <div class="item objs">
                                                <input type="radio" id="student" name="office_type" value="ST"
                                                       class="radio" checked>
                                                <label id="label-stdent-id" for="student">{{trans('label.auth.register.student_type')}}</label>
                                            </div>
                                            <div class="item objt" style="color: #00b1b3">
                                                <input type="radio" id="teacher" name="office_type" value="AT"
                                                       class="radio">
                                                <label id="label-author-id" for="teacher">{{trans('label.auth.register.author_type')}}</label>
                                            </div>
                                            <input type="hidden" id="check_type_user">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div id="teacher-tabs" class="tab-pane fade ">
                                </div>
                                <div id="student-tabs" class="tab-pane fade in active">
                                    <div class="form-group">
                                        <label for="class" class="col-md-4 control-label">{{trans('label.auth.register.class')}}</label>

                                        <div class="col-md-6">
                                            <select name="class" id="class" class="form-control">
                                                @foreach($classes as $class)
                                                    <option value="{{$class->id}}">{{$class->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{trans('label.auth.register.title')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

<script>
    $('#label-stdent-id').css('background-color', '#00b1b3');
    $('#label-stdent-id').css('color', 'white');

    $('#label-author-id').click(function () {
        $(this).css('background-color', '#00b1b3');
        $(this).css('color', 'white');

        $('#label-stdent-id').css('background-color', '#eeeeee');
        $('#label-stdent-id').css('color', '#00b1b3');

        $('#student-tabs').hide();
    });

    $('#label-stdent-id').click(function () {
        $(this).css('background-color', '#00b1b3');
        $(this).css('color', 'white');

        $('#label-author-id').css('background-color', '#eeeeee');
        $('#label-author-id').css('color', '#00b1b3');

        $('#student-tabs').show();
    });

    $( 'input[type="radio"]' ).on( "click", function() {
        $( "#check_type_user" ).html( $( "input:checked" ).val() + " is checked!" );
    });

</script>
@endsection
