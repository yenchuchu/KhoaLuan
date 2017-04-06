@extends('layouts.app-backend')

@section('style')
    @include('backend.author.listen.table-tick.style')
    @include('backend.author.style-common')
@stop

@section('header')
    <h1 class="page-header">
        @if($code_user == 'ST')
            Tạo bài dạng "Nghe và chọn những đáp án đúng" cho học sinh.
        @elseif($code_user == 'TC')
            Add exam 'Listen Ticks' for Teacher
        @endif
    </h1>
@stop

@section('content')

    {{ Form::open(['route' => 'backend.manager.author.listen.listen_table_ticks.store',
    'method' => 'post', 'files'=>true,
    'enctype' => 'multipart/form-data']) }}

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-listen-table-ticks-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}} - {{$level->point}}  </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="listen-table-ticks-class">
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
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
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
    </div>
    <div class="row" id="wrap_add_listen_table_ticks">
        <div class="col-lg-12 col_add_listen_table_ticks">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">

                        <div class="col-lg-12" style="padding-left: 0;">
                            <div class="form-group">
                                <input type="text" name="listen_table_ticks[1][title-listen-table-ticks]"
                                       class="form-control" placeholder="Cập nhật đề bài" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Upload Audio</label>
                            {{ Form::file('listen_table_ticks[1][url_audio]', array()) }}
                        </div>

                        <div class="form-group" style="width:100%; float:left;">
                            <div class="span-numb-question" id="id-numb-question-1">
                                1
                            </div>

                            <div class="span-choose-listen-table-tick">

                                <table id="listen_table_ticks_1" class="table table-bordered">
                                    <tr>
                                        <td>
                                            <input type="text"
                                                   name="listen_table_ticks[1][content-choose-ans-question][1][suggest]">
                                        </td>
                                        <td><input type="checkbox"
                                                   name="listen_table_ticks[1][content-choose-ans-question][1][answer]">
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="form-group">
                    <span id="add_item_question_1" item_this="1" item="1"
                          class="add-question" onclick="add_item_question_LTT(this.id, 'listen_table_ticks_1')" title="Add">+</span>
                </div>

            </div>
        </div>
        <!--End Advanced Tables -->
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <span class="add-item">+</span>
        </div>
        <div class="col-lg-12 col-md-12">
            <button class="save-listen-table-ticks btn style-save" title="Save" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    @include('backend.author.listen.table-tick.scritp')
    @include('backend.author.script-common')
@stop
