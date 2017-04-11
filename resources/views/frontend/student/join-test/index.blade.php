@extends('layouts.app')

@section('menu-main')
    @include('frontend.student.partials.menu-main')
@stop

@section('style-menu-main')
    @include('frontend.student.join-test.style')
@stop

@section('content')


    @if(empty($items))
        <div class="container">
            <div><h3>Testing {{$skill_code}}</h3></div>
            <div id="refresh-page-testing">
                <p>Chưa cập nhật dữ liệu</p>
            </div>
        </div>

    @else
        <a style="display: none;" href="{{route('frontend.dashboard.student.index')}}" id="href_goto_index"></a>
        <div class="wrap-clock">
            <div id='demnguoc' time_remaining="{{$time_remaining}}"><i class="fa fa-clock-o" aria-hidden="true"></i><span
                        id='dem'></span> <span id='donvi'></span>
            </div>
            <div class="reload-exam-btn">
                <button class="btn btn-default" style="width: 132%;" onclick="restart_test('{{$get_next_level}}', '{{$skill_code}}')">Restart</button>
            </div>
        </div>

        <div class="container">
            <div><h3>Testing {{$skill_code}}</h3></div>
            <div id="refresh-page-testing">
                @include('frontend.student.join-test.index_start')
            </div>
        </div>
    @endif

@stop


    @if(!empty($items))
        {{--test--}}
@section('script')
        @include('frontend.student.join-test.script')
@stop
@endif
