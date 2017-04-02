@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">{{trans('label.backend.author.speaking.index.title')}}
        <a href="{{route('backend.manager.author.speaking.create', ['ST' , $class_code])}}" target="_blank"
           class="btn btn-success btn-create-new-test">
            {{trans('label.backend.author.speaking.index.add')}}
        </a>
    </h1>

@stop

@section('style')
    @include('backend.author.speaking.style')
    @include('backend.author.style-common')
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('label.backend.author.speaking.index.table')}}
                </div>
                <div class="panel-body">
                    <div class="table-responsive" id="reload_table_ans_for_students">
                        @include('backend.author.speaking.table-students-index')
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
        {{--<div class="col-lg-12">--}}
            {{--<!-- Advanced Tables -->--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">--}}
                    {{--AnswerQuestion's Teacher Tables--}}
                    {{--<a href="{{route('backend.manager.author.speaking.create', ['TC', $class_code])}}" target="_blank">Add exam for teacher</a>--}}
                {{--</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<div class="table-responsive" id="reload_table_ans_for_teachers">--}}
                        {{--@include('backend.author.speaking.table-teachers-index')--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--<!--End Advanced Tables -->--}}
        {{--</div>--}}
    </div>

@stop

@section('script')
    <script>
        setTableInit('manager_answer_questions_students');
//        setTableInit('manager_answer_questions_teachers');

    </script>
@stop
