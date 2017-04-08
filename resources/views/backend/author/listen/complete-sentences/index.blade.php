@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">
        Listen Complete Sentences for {{$name_code}}
    </h1>
@stop
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listen Complete Sentences's Students Tables
                    <a href="{{route('backend.manager.author.listen.listen_complete_sentences.create', ['ST' , $class_code])}}" target="_blank">Add Student Test</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" id="reload_table_ans_for_students">
                        @include('backend.author.listen.complete-sentences.table-students-index')
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>

@stop

@section('script')
    <script>
        setTableInit('manager_listen_complete_sentences_students');

    </script>
@stop
