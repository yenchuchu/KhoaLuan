@extends('layouts.app-backend')

@section('style')
    @include('backend.author.multiple_choice.style')
    @include('backend.author.style-common')
@stop

@section('header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                    href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.multiple-choice')}}">
                {{trans('label.backend.author.reading.grade_menu.multiple_choice')}}</a>
        </li>
        <li class="breadcrumb-item ">
            <span class="bread-active">
                  {{trans('label.backend.create.title')}}
            </span>
        </li>
    </ol>

@stop

@section('content')

    {{ Form::open(['route' => 'backend.manager.author.multiple-choice.store', 'method' => 'post']) }}

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-multiple-choice-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}}  </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="multiple-choice-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @elseif($code_user == 'TC')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="multiple-choice-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="exam_type_id" class="form-control" id="multiple-choice-examtype">
                        @foreach($exam_types as $types)
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3" id="wrap_bookmap_form">

                <select name="book_map_id" class="form-control" id="multiple-choice-bookmap">
                    @foreach($book_maps as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>

            </div>
        @endif

        <input type="hidden" value="{{$code_user}}" name="code_user">
        {{--<input type="hidden" value="{{$class_code}}" name="class_code">--}}
    </div>
    <div class="row" id="wrap_add_multiple_choice">
        <div class="col-lg-12 col_add_multiple_choice">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">

                        <div class="col-lg-12" style="padding-left: 0;">
                            <div class="form-group">
                                <input type="text" name="multiple_choice[1][title-multiple-choice]"
                                       class="form-control" required placeholder="{{trans('label.backend.create.title-question')}}">
                            </div>
                        </div>

                        <div class="form-group" style="width:100%; float:left;">
                            <div class="span-numb-question" id="id-numb-question-1">
                                1
                                <input type="hidden" name="multiple_choice[1][content-choose-ans-question][1][id]" value="1">
                            </div>
                            <div class="form-group" style="width:98%; float:left;">
                                <div class="span-text-question">
                                    <textarea type="text" class="form-control"
                                              name="multiple_choice[1][content-choose-ans-question][1][content]"
                                              placeholder="This is ... demo" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 div-wrap-option-answers" >
                                <div class="col-lg-4 option-as-details">
                                    <input type="radio" value="A"
                                           name="multiple_choice[1][content-choose-ans-question][1][answer]">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="1"
                                               name="multiple_choice[1][content-choose-ans-question][1][suggest_choose][A]">
                                    </div>
                                </div>

                                <div class="col-lg-4 option-as-details">
                                    <input type="radio" value="B"
                                           name="multiple_choice[1][content-choose-ans-question][1][answer]">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="2"
                                               name="multiple_choice[1][content-choose-ans-question][1][suggest_choose][B]">
                                    </div>
                                </div>

                                <div class="col-lg-4 option-as-details">
                                    <input type="radio" value="C"
                                           name="multiple_choice[1][content-choose-ans-question][1][answer]">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="3"
                                               name="multiple_choice[1][content-choose-ans-question][1][suggest_choose][C]">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <span id="add_item_question_1" item_this="1" item="1"
                           class="add-question" onclick="add_item_question_MT(this.id)" title="Add">+</span>
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
            <button class="save-multiple-choice btn style-save" title="Save" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    @include('backend.author.multiple_choice.scritp')
    @include('backend.author.script-common')
@stop
