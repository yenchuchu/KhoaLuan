@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">
        Multiple choices for {{$name_code}}
        <a href="{{route('backend.manager.author.multiple-choice.create', ['ST' , $class_code])}}" target="_blank"
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
                        @include('backend.author.multiple_choice.table-students-index')
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>

@stop

@section('script')
    <script>
        setTableInit('manager_multiple_choices_students');
        setTableInit('manager_multiple_choices_teachers');

    </script>
@stop
