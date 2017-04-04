@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">
        Listen Ticks for {{$name_code}}
    </h1>
@stop
@section('content')
    <div class="row">
        <!-- Welcome -->
        <div class="col-lg-12">
            <div class="alert alert-info">
                <i class="fa fa-folder-open"></i><b>&nbsp;Hello ! </b>Welcome Back <b>Jonny Deen </b>
                <i class="fa  fa-pencil"></i><b>&nbsp;2,000 </b>Support Tickets Pending to Answere. nbsp;
            </div>
        </div>
        <!--end  Welcome -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listen Ticks's Students Tables
                    <a href="{{route('backend.manager.author.listen.listen_ticks.create', ['ST' , $class_code])}}" target="_blank">Add Student Test</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" id="reload_table_ans_for_students">
                        @include('backend.author.listen.listen-tick.table-students-index')
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>

@stop

@section('script')
    <script>
        setTableInit('manager_listen_ticks_students');

    </script>
@stop
