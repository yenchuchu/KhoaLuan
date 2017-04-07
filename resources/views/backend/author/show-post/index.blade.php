@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">
        Post Detail
        @if($status == 1)
            <span class="pull-right text-muted small" style="color: #3dd41a">Confirmed</span>
        @endif
    </h1>
@stop

@section('style')
    @include('backend.author.style-common')
@stop

@section('style')
    <style>
        .navbar-custom {
            padding: 10px 0;
        }

        a > img {
            width: 100%;
        }

        .main-body {
            margin: 30px 15px 10px;
            overflow: hidden;
            padding: 10px 10px;
            margin-bottom: 90px;
        }

    </style>
@stop

@section('content')
    <section id="dashboard-index-wrap">
        <div class="">
            <div class="row">
                <div class="main-body">
                    <?php
                    switch ($name_table) {
                    case "answer_questions": ?>

                    @foreach($records as $record)
                        @include('backend.author.show-post.show-answer-question')
                    @endforeach

                    <?php  break;

                    case "complete_words": ?>

                    @foreach($records as $record)
                        @include('backend.author.show-post.show-answer-question')
                    @endforeach

                    <?php  break;

                    case "find_errors": ?>

                    @foreach($records as $record)
                        @include('backend.author.show-post.show-answer-question')
                    @endforeach

                    <?php  break;

                    case "multiple_choices": ?>

                    @foreach($records as $record)
                        @include('backend.author.show-post.show-answer-question')
                    @endforeach

                    <?php break;

                    case "tick_circle_true_falses": ?>

                    @foreach($records as $record)
                        @include('backend.author.show-post.show-answer-question')
                    @endforeach

                    <?php break;
                    case "complete_tables": ?>

                    @foreach($records as $record)
                        @include('backend.author.show-post.show-answer-question')
                    @endforeach

                    <?php   break;

                    case "table_matchs":
                        echo "classify_words!";
                        break;

                    case "complete_sentences":
                        echo "classify_words!";
                        break;

                    case "listen_ticks":
                        echo "classify_words!";
                        break;

                    case "listen_table_ticks": ?>
                    {{ Form::open(['route' => 'backend.manager.author.listen.listen_table_ticks.update',
                        'method' => 'post', 'files'=>true,
                        'enctype' => 'multipart/form-data']) }}

                    <div class="row">
                        @if($code_user == 'ST')
                            <div class="col-lg-3">
                                <div class="form-group">

                                    <select name="level_id" class="form-control" id="admin-levels">
                                        @foreach($levels as $level)
                                            <option value="{{$level->id}}">{{$level->title}}
                                                - {{$level->point}}  </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">

                                    <select name="class_id" class="form-control" id="admin-classes">
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @elseif($code_user == 'TC')
                            <div class="col-lg-3">
                                <div class="form-group">

                                    <select name="class_id" class="form-control" id="listen-table-ticks-class">
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">

                                    <select name="exam_type_id" class="form-control" id="listen-table-ticks-examtype">
                                        @foreach($exam_types as $types)
                                            <option value="{{$types->id}}"
                                                    code="{{$types->code}}">{{$types->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3" id="wrap_bookmap_form">

                                <select name="book_map_id" class="form-control" id="listen-table-ticks-bookmap">
                                    @foreach($book_maps as $book)
                                        <option value="{{$book->id}}">{{$book->title}}</option>
                                    @endforeach
                                </select>

                            </div>
                        @endif

                        <input type="hidden" value="{{$code_user}}" name="code_user">
                        <input type="hidden" value="{{$class_code}}" name="class_code">
                        <input type="hidden" value="{{$author_id}}" name="authorspost">
                    </div>

                    @foreach($records as $key => $record)
                        <?php $key_idx = $key + 1; ?>
                        <input type="hidden" value="{{$record->id}}" name="listen_table_ticks[{{$key_idx}}][id_record]">
                        @include('backend.author.show-post.listen-table-ticks')
                    @endforeach

                    <?php break;

                    case "tick_crosses":
                        echo "classify_words!";
                        break;

                    case "fill_numbers":
                        echo "classify_words!";
                        break;
                    default:
                        echo "Your favorite color is neither red, blue, nor green!";
                    }
                    ?>

                    <div class="row" style="margin-bottom: 30px">

                        @if($status == 0)

                            @if (Auth::user()->hasRole('AD'))

                                {{--<div class="col-lg-12 col-md-12">--}}
                                    {{--<span class="btn btn-success admin-confirm">Confirm</span>--}}
                                {{--</div>--}}

                                <div class="col-lg-12 col-md-12">
                                    <button class="btn btn-success admin-save-confirm">Save and Confirm</button>
                                </div>

                            @endif

                            @if (Auth::user()->hasRole('AT'))

                                <div class="col-lg-12 col-md-12">
                                    <button class="style-save" title="Save" type="submit">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                </div>

                            @endif

                        @endif
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script>
        setTableInit('manager_own_posts_listen');
        setTableInit('manager_own_posts_speak');
        setTableInit('manager_own_posts_read');

        $('#admin-classes').val('{{$class_id}}');
        $('#admin-levels').val('{{$level_id}}');

    </script>

    @include('backend.author.script-common')

@stop
