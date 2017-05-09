@extends('layouts.app')

@section('menu-main')
    @include('frontend.student.partials.menu-main')
@stop

@section('style-menu-main')
    @include('frontend.student.join-test.style')

    <style>
        .input_complete_listen {
            width: 7%;
            border: none;
            border-bottom: 1px solid gray;
            margin-left: 7px;
            color: gray;
        }

        .audio_listen {
            margin-top: 10px;
            margin-bottom: 15px;
        }

    </style>
@stop

@section('content')
    <a style="display: none;" href="{{route('frontend.dashboard.student.index')}}" id="href_goto_index"></a>
    @if(empty($items))
        <div class="container">
            <div><h3>{{ trans('label.frontend.heading.test_listening')  }}</h3></div>
            <div id="refresh-page-testing">
                <p>{{ trans('label.frontend.no_data')  }}</p>
            </div>
        </div>

    @else

    <div class="wrap-clock">
        <div id='demnguoc' time_remaining="{{$time_remaining}}"><i class="fa fa-clock-o" aria-hidden="true"></i><span
                    id='dem'></span> <span id='donvi'></span>
        </div>
        <div class="reload-exam-btn">
            <button class="btn btn-default" style="width: 132%;" onclick="restart_test('{{$get_next_level}}', '{{$skill_code}}')">{{ trans('label.frontend.restart')  }}</button>
        </div>
    </div>
    <div class="container">
        <div><h3>{{ trans('label.frontend.heading.test_listening')  }}</h3></div>
    <div id="refresh-page-testing">

        @include('frontend.student.join-test.listening.index_start')
    </div>
    </div>

    @endif

@stop


@if(!empty($items))
@section('script')
    @include('frontend.student.join-test.listening.script')
@stop
@endif

