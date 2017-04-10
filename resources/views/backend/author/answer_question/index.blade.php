@extends('layouts.app-backend')

@section('header')
    @if($name_code == 'Elementary')
        <?php $name_grade = 'học sinh cấp 1'; $href_back = route('backend.author.grade', 1); ?>
    @elseif($name_code == 'Secondary')
        <?php $name_grade = 'học sinh cấp 2'; $href_back = route('backend.author.grade', 2); ?>
    @else
        <?php $name_grade = 'học sinh cấp 3'; $href_back = route('backend.author.grade', 3); ?>
    @endif

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                    href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>
        <li class="breadcrumb-item"><a
                    href="{{$href_back}}">{{ trans('label.backend.author.dashboard')  }} {{ $name_grade }}</a></li>
        <li class="breadcrumb-item ">
            <span class="bread-active">
                  {{trans('label.backend.author.reading.grade_menu.answer_question')}}
            </span>
        </li>
    </ol>

@stop
@section('content')

    <div class="row">
        <section class="col-lg-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                {{--<section class="panel">--}}

                <header class="panel-heading">
                    {{trans('label.backend.author.speaking.index.manage-table')}}
                    <span class="tools pull-right" style=" position: relative; top: -4px;">
                        <div class="btn-group">
                             <a href="{{route('backend.manager.author.answer-question.create', ['ST' , $class_code])}}"
                                target="_blank" class="btn btn-success btn-create-new-test"
                                style="float:right;padding: 3px 10px;">
                                 {{trans('label.backend.author.speaking.index.add')}}
                             </a>
                        </div>
                    </span>
                </header>

                <div class="panel-body">
                    <div class="table-responsive" id="reload_table_ans_for_students">
                        @include('backend.author.answer_question.table-students-index')
                    </div>

                </div>
                {{--</section>--}}
            </div>
        </section>
            <!--End Advanced Tables -->
    </div>

@stop

@section('script')
    <script>
        setTableInit('manager_answer_questions_students');

    </script>
@stop
