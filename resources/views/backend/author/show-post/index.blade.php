@extends('layouts.app-backend')

@section('style')
    @include('backend.author.style-common')
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

        .title-confirm {
            float: right;
            position: relative;
            top: -8px;
        }

    </style>
@stop

@section('header')

    <ol class="breadcrumb">
        @if (Auth::user()->hasRole('AT'))
        <li class="breadcrumb-item"><a
                    href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>

    <?php
    switch ($name_table) {
    case "answer_questions": ?>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.answer-question')}}">
                {{trans('label.backend.author.reading.grade_menu.answer_question')}}</a>
        </li>
    <?php  break;

    case "find_errors": ?>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.find-errors')}}">
                {{trans('label.backend.author.reading.grade_menu.find_error')}}</a>
        </li>
    <?php  break;

    case "multiple_choices": ?>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.multiple-choice')}}">
                {{trans('label.backend.author.reading.grade_menu.multiple_choice')}}</a>
        </li>
    <?php break;

    case "tick_circle_true_falses": ?>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.tick-circle-true-false')}}">
                {{trans('label.backend.author.reading.grade_menu.tick_true_false')}}</a>
        </li>

    <?php  break;

    case "listen_complete_sentences": ?>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.listen.listen_complete_sentences')}}">
                {{trans('label.backend.author.listening.grade_menu.listen_complete_sentences')}}</a>
        </li>
    <?php break;

    case "listen_ticks": ?>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.listen.listen_ticks')}}">
                {{trans('label.backend.author.listening.grade_menu.listen_ticks')}}</a>
        </li>
    <?php break;

    case "listen_table_ticks": ?>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.listen.listen_table_ticks')}}">
                {{trans('label.backend.author.listening.grade_menu.listen_table_ticks')}}</a>
        </li>
    <?php break;

    case "speakings": ?>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.speaking')}}">
                {{trans('label.backend.author.speaking.grade_menu.content')}}</a>
        </li>
    <?php break;

    default:
        echo "Your favorite color is neither red, blue, nor green!";
    }
    ?>

        @endif
        <li class="breadcrumb-item ">
            <span class="bread-active">
                  {{trans('label.backend.post_details.title')}}
            </span>
        </li>
        <h2 class="title-confirm" >
            @if($status == 1)
                <span class="pull-right text-muted small" style="color: #3dd41a">{{trans('label.backend.post_details.confirmed')}}</span>
            @endif
        </h2>
    </ol>
@stop

@section('style')
    @include('backend.author.style-common')
@stop

@section('content')
    <section id="dashboard-index-wrap">
        <div class="">
            <div class="row">
                <div class="main-body">
                    <?php
                    switch ($name_table) {
                    case "answer_questions": ?>

                        {{ Form::open(['route' => 'backend.manager.author.read.answer_questions.update',
                            'method' => 'post']) }}

                        <div class="row">
                            @if($code_user == 'ST')
                                <div class="col-lg-3">
                                    <div class="form-group">

                                        <select name="level_id" class="form-control" id="admin-levels">
                                            @foreach($levels as $level)
                                                <option value="{{$level->id}}">{{$level->title}}  </option>
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

                                        <select name="class_id" class="form-control" id="answer-question-class">
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">

                                        <select name="exam_type_id" class="form-control" id="answer-question-examtype">
                                            @foreach($exam_types as $types)
                                                <option value="{{$types->id}}"
                                                        code="{{$types->code}}">{{$types->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3" id="wrap_bookmap_form">

                                    <select name="book_map_id" class="form-control" id="answer-question-bookmap">
                                        @foreach($book_maps as $book)
                                            <option value="{{$book->id}}">{{$book->title}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            @endif

                            <input type="hidden" value="{{$code_user}}" name="code_user">
{{--                            <input type="hidden" value="{{$class_code}}" name="class_code">--}}
                            <input type="hidden" value="{{$author_id}}" name="authorspost">
                        </div>

                    @foreach($records as $key => $record)

                            <?php $key_idx = $key + 1; ?>
                            <input type="hidden" value="{{$record->id}}" name="answer_question[{{$key_idx}}][id_record]">

                        @include('backend.author.show-post.show-answer-question')
                    @endforeach

                    <?php  break;

                    case "find_errors": ?>

                        {{ Form::open(['route' => 'backend.manager.author.read.find_errors.update',
                            'method' => 'post']) }}

                        <div class="row">
                            @if($code_user == 'ST')
                                <div class="col-lg-3">
                                    <div class="form-group">

                                        <select name="level_id" class="form-control" id="admin-levels">
                                            @foreach($levels as $level)
                                                <option value="{{$level->id}}">{{$level->title}} </option>
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

                                        <select name="class_id" class="form-control" id="find-errors-class">
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">

                                        <select name="exam_type_id" class="form-control" id="find-errors-examtype">
                                            @foreach($exam_types as $types)
                                                <option value="{{$types->id}}"
                                                        code="{{$types->code}}">{{$types->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3" id="wrap_bookmap_form">

                                    <select name="book_map_id" class="form-control" id="find-errors-bookmap">
                                        @foreach($book_maps as $book)
                                            <option value="{{$book->id}}">{{$book->title}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            @endif

                            <input type="hidden" value="{{$code_user}}" name="code_user">
{{--                            <input type="hidden" value="{{$class_code}}" name="class_code">--}}
                            <input type="hidden" value="{{$author_id}}" name="authorspost">
                        </div>

                    @foreach($records as $key => $record)

                            <?php $key_idx = $key + 1; ?>
                            <input type="hidden" value="{{$record->id}}" name="find_errors[{{$key_idx}}][id_record]">

                        @include('backend.author.show-post.show-find-errors')
                    @endforeach

                    <?php  break;

                    case "multiple_choices": ?>

                        {{ Form::open(['route' => 'backend.manager.author.read.multiple_choices.update',
                            'method' => 'post']) }}

                        <div class="row">
                            @if($code_user == 'ST')
                                <div class="col-lg-3">
                                    <div class="form-group">

                                        <select name="level_id" class="form-control" id="admin-levels">
                                            @foreach($levels as $level)
                                                <option value="{{$level->id}}">{{$level->title}} </option>
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

                                        <select name="class_id" class="form-control" id="find-errors-class">
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">

                                        <select name="exam_type_id" class="form-control" id="find-errors-examtype">
                                            @foreach($exam_types as $types)
                                                <option value="{{$types->id}}"
                                                        code="{{$types->code}}">{{$types->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3" id="wrap_bookmap_form">

                                    <select name="book_map_id" class="form-control" id="find-errors-bookmap">
                                        @foreach($book_maps as $book)
                                            <option value="{{$book->id}}">{{$book->title}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            @endif

                            <input type="hidden" value="{{$code_user}}" name="code_user">
{{--                            <input type="hidden" value="{{$class_code}}" name="class_code">--}}
                            <input type="hidden" value="{{$author_id}}" name="authorspost">
                        </div>

                    @foreach($records as $key => $record)

                            <?php $key_idx = $key + 1; ?>
                            <input type="hidden" value="{{$record->id}}" name="multiple_choice[{{$key_idx}}][id_record]">

                        @include('backend.author.show-post.show-multiple-choices')
                    @endforeach

                    <?php break;

                    case "tick_circle_true_falses": ?>
                        {{ Form::open(['route' => 'backend.manager.author.read.tick_circle_true_falses.update',
                            'method' => 'post']) }}

                        <div class="row">
                            @if($code_user == 'ST')
                                <div class="col-lg-3">
                                    <div class="form-group">

                                        <select name="level_id" class="form-control" id="admin-levels">
                                            @foreach($levels as $level)
                                                <option value="{{$level->id}}">{{$level->title}}  </option>
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

                                        <select name="class_id" class="form-control" id="find-errors-class">
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">

                                        <select name="exam_type_id" class="form-control" id="find-errors-examtype">
                                            @foreach($exam_types as $types)
                                                <option value="{{$types->id}}"
                                                        code="{{$types->code}}">{{$types->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3" id="wrap_bookmap_form">

                                    <select name="book_map_id" class="form-control" id="find-errors-bookmap">
                                        @foreach($book_maps as $book)
                                            <option value="{{$book->id}}">{{$book->title}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            @endif

                            <input type="hidden" value="{{$code_user}}" name="code_user">
{{--                            <input type="hidden" value="{{$class_code}}" name="class_code">--}}
                            <input type="hidden" value="{{$author_id}}" name="authorspost">
                        </div>
                        @foreach($records as $key => $record)

                            <?php $key_idx = $key + 1; ?>
                            <input type="hidden" value="{{$record->id}}" name="tick_true_false[{{$key_idx}}][id_record]">

                        @include('backend.author.show-post.show-tick-true-false')
                    @endforeach

                    <?php  break;

                    case "listen_complete_sentences": ?>
                        {{ Form::open(['route' => 'backend.manager.author.listen.listen_complete_sentences.update',
                            'method' => 'post', 'files'=>true,
                            'enctype' => 'multipart/form-data']) }}

                        <div class="row">
                            @if($code_user == 'ST')
                                <div class="col-lg-3">
                                    <div class="form-group">

                                        <select name="level_id" class="form-control" id="admin-levels">
                                            @foreach($levels as $level)
                                                <option value="{{$level->id}}">{{$level->title}} </option>
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
{{--                            <input type="hidden" value="{{$class_code}}" name="class_code">--}}
                            <input type="hidden" value="{{$author_id}}" name="authorspost">
                        </div>

                        @foreach($records as $key => $record)
                            <?php $key_idx = $key + 1; ?>
                            <input type="hidden" value="{{$record->id}}" name="listen_complete_sentences[{{$key_idx}}][id_record]">
                            @include('backend.author.show-post.show-listen-complete-sentences')
                        @endforeach

                        <?php break;

                    case "listen_ticks": ?>
                        {{ Form::open(['route' => 'backend.manager.author.listen.listen_ticks.update',
                            'method' => 'post', 'files'=>true,
                            'enctype' => 'multipart/form-data']) }}

                        <div class="row">
                            @if($code_user == 'ST')
                                <div class="col-lg-3">
                                    <div class="form-group">

                                        <select name="level_id" class="form-control" id="admin-levels">
                                            @foreach($levels as $level)
                                                <option value="{{$level->id}}">{{$level->title}}  </option>
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
{{--                            <input type="hidden" value="{{$class_code}}" name="class_code">--}}
                            <input type="hidden" value="{{$author_id}}" name="authorspost">
                        </div>

                        @foreach($records as $key => $record)
                            <?php $key_idx = $key + 1; ?>
                            <input type="hidden" value="{{$record->id}}" name="listen_ticks[{{$key_idx}}][id_record]">

                                @include('backend.author.show-post.show-listen-ticks')
                        @endforeach

                        <?php break;

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
                                            <option value="{{$level->id}}">{{$level->title}}  </option>
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
{{--                        <input type="hidden" value="{{$class_code}}" name="class_code">--}}
                        <input type="hidden" value="{{$author_id}}" name="authorspost">
                    </div>

                    @foreach($records as $key => $record)
                        <?php $key_idx = $key + 1; ?>
                        <input type="hidden" value="{{$record->id}}" name="listen_table_ticks[{{$key_idx}}][id_record]">
                        @include('backend.author.show-post.listen-table-ticks')
                    @endforeach

                    <?php break;

                    case "speakings": ?>
                    {{ Form::open(['route' => 'backend.manager.author.speakings.update',
                        'method' => 'post', 'files'=>true,
                        'enctype' => 'multipart/form-data']) }}

                    <div class="row">
                        @if($code_user == 'ST')
                            <div class="col-lg-3">
                                <div class="form-group">

                                    <select name="level_id" class="form-control" id="admin-levels">
                                        @foreach($levels as $level)
                                            <option value="{{$level->id}}">{{$level->title}}  </option>
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
                        {{--<input type="hidden" value="{{$class_code}}" name="class_code">--}}
                        <input type="hidden" value="{{$author_id}}" name="authorspost">
                    </div>

                    @foreach($records as $key => $record)
                        <?php $key_idx = $key + 1;?>
                        <input type="hidden" value="{{$record->id}}" name="speaking[{{$key_idx}}][id_record]">
                        @include('backend.author.show-post.show-speaking')
                    @endforeach

                    <?php break;

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
                                    <button class="btn btn-success admin-save-confirm">{{trans('label.backend.post_details.save-confirm')}}</button>
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
