@extends('layouts.app-backend')

@section('header')

    <h1 class="page-header">
        Answer questions for {{$name_code}}
        <a href="{{route('backend.manager.author.answer-question.create', ['ST' , $class_code])}}" target="_blank"
           class="btn btn-success btn-create-new-test" style="float:right;">
            {{trans('label.backend.author.speaking.index.add')}}
        </a>
    </h1>
@stop
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive" id="reload_table_ans_for_students">
                        @include('backend.author.answer_question.table-students-index')
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>

@stop

@section('script')
    <script>
        setTableInit('manager_answer_questions_students');

    </script>
@stop
