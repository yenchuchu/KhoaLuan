@extends('layouts.app-backend')

@section('header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                    href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>
        <li class="breadcrumb-item ">
            <span class="bread-active">
                  {{trans('label.backend.author.reading.grade_menu.tick_true_false')}}
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
                             <a href="{{route('backend.manager.author.tick-circle-true-false.create', 'ST')}}"
                                target="_blank" class="btn btn-success btn-create-new-test"
                                style="float:right;padding: 3px 10px;">
                                 {{trans('label.backend.author.speaking.index.add')}}
                             </a>
                        </div>
                    </span>
                </header>

                <div class="panel-body">
                    <div class="table-responsive" id="reload_table_ans_for_students">
                        @include('backend.author.tick-circle-true-false.table-students-index')
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
            </section>
    </div>

@stop

@section('script')
    <script>
        setTableInit('manager_tick_true_false_students');
        setTableInit('manager_tick_true_false_teachers');

    </script>
@stop
