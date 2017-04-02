@extends('layouts.app-backend')

@section('style')
    @include('backend.author.complete_words.style')
    @include('backend.author.style-common')
@stop

@section('header')
    <h1 class="page-header">
        @if($code_user == 'ST')
            Add exam 'complete paragraph' for Student test online
        @elseif($code_user == 'TC')
            Add exam 'complete paragraph' for Teacher
        @endif
    </h1>
@stop

@section('content')

    {{ Form::open(['route' => 'backend.manager.author.complete-paragraph.store', 'method' => 'post']) }}

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-complete-paragraph-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}} - {{$level->point}}  </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="complete-paragraph-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @elseif($code_user == 'TC')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="complete-paragraph-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="exam_type_id" class="form-control" id="complete-paragraph-examtype">
                        @foreach($exam_types as $types)
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3" id="wrap_bookmap_form">

                <select name="book_map_id" class="form-control" id="complete-paragraph-bookmap">
                    @foreach($book_maps as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>

            </div>
        @endif

        <input type="hidden" value="{{$code_user}}" name="code_user">
        <input type="hidden" value="{{$class_code}}" name="class_code">
    </div>
    <div class="row" id="wrap_add_complete_paragraphs">
        <div class="col-lg-12 col_add_complete_paragraphs">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">

                        <div class="col-lg-12" style="padding-left: 0;">
                            <div class="form-group">
                                <input type="text" name="complete_paragraphs[1][title-complete-paragraph]"
                                       class="form-control" required>
                            </div>
                        </div>
                        {{--<div class="col-lg-2" style=" padding-right: 0;">--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="lable-point">Point: </label>--}}
                                {{--<input type="number" name="complete_paragraphs[1][point]"--}}
                                       {{--class="form-control input-point" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group" style="width:100%; float:left;">
                            <div class="span-numb-question" id="id-numb-question-1">
                                1
                                <input type="hidden" name="complete_paragraphs[1][content-choose-ans-question][1][id]" value="1">
                            </div>
                            <div class="form-group" style="width:98%; float:left;">
                                <div class="span-text-question">
                                    <textarea type="text" class="form-control"
                                              name="complete_paragraphs[1][content-choose-ans-question][1][content]"
                                              placeholder="enter content" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 div-wrap-option-answers" >
                                <div class="col-lg-4 option-as-details">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="enter suggest" index="1"
                                               name="complete_paragraphs[1][content-choose-ans-question][1][suggest_choose]">
                                    </div>
                                </div>

                                <div class="col-lg-8 option-as-details">
                                    <label class="col-lg-1" for="complete_paragraphs[1][content-choose-ans-question][1][answer]">Answer: </label>
                                    <div class="form-group col-lg-4" style="width: 43%;">
                                        <input type="text" class="form-control" placeholder="enter answer" index="2"
                                               name="complete_paragraphs[1][content-choose-ans-question][1][answer]"
                                               id="complete_paragraphs[1][content-choose-ans-question][1][answer]">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <span id="add_item_question_1" item_this="1" item="1"
                           class="add-question" onclick="add_item_question_complete_paragraph(this.id)" title="Add">+</span>
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <span class="add-item">+</span>
        </div>
        <div class="col-lg-12 col-md-12">
            <button class="save-complete-paragraph btn" title="Save" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    @include('backend.author.complete_paragraphs.scritp')
    @include('backend.author.script-common')
@stop
