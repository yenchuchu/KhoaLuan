@extends('layouts.app-backend')

@section('style')
    @include('backend.author.answer_question.style')
    @include('backend.author.style-common')
@stop

@section('header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                    href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>
        <li class="breadcrumb-item ">
                <a href="{{route('backend.manager.author.answer-question')}}">
                    {{ trans('label.backend.author.reading.grade_menu.answer_question')  }}</a>
        </li>
        <li class="breadcrumb-item ">
            <span class="bread-active">
                  {{trans('label.backend.create.title')}}
                <p class="alert-note">Hướng dẫn</p>
            </span>

        </li>
    </ol>

@stop

@section('content')

    {{ Form::open(['route' => 'backend.manager.author.answer-question.store', 'method' => 'post']) }}

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-answer-question-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="answer-question-class">
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
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
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
        {{--<input type="hidden" value="{{$class_code}}" name="class_code">--}}
    </div>
    <div class="row" id="wrap_add_answer_question">
        <div class="col-lg-12 col_add_answer_question">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">

                        <div class="col-lg-12" style="padding-left: 0; padding-right: 0px">
                            <div class="form-group">
                                <input type="text" name="answer_question[1][title-answer-question]" required
                                       class="form-control" placeholder="{{trans('label.backend.create.title-question')}}">
                            </div>
                        </div>

                        <div class="form-group">
                                <textarea type="text" class="form-control"
                                          name="answer_question[1][content-answer-question]" required
                                          placeholder="{{trans('label.backend.create.content-question')}}"></textarea>
                        </div>
                        <div class="form-group" style="width:100%; float:left;">
                            <div class="span-numb-question" id="id-numb-question-1">
                                1
                                <input type="hidden" name="answer_question[1][content-choose-ans-question][1][id]" value="1">
                            </div>
                            <div class="form-group" style="width:98%; float:left;">
                                <div class="span-text-question">
                                    <textarea type="text" class="form-control"
                                              name="answer_question[1][content-choose-ans-question][1][content]"
                                              placeholder="{{trans('label.backend.create.item-content-question')}}" required></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12" style="padding-left: 0;margin-left: 17px;width: 100%">
                                <label class="col-lg-1" style="padding-right: 0px;">Đáp án: </label>
                                <div class="form-group col-lg-11" style="padding-left: 0; padding-right: 0px; margin-left: 0">
                                    <input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}"
                                    name="answer_question[1][content-choose-ans-question][1][answer]" required>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="form-group">
                    <span id="add_item_question_1" item_this="1" item="1"
                       class="add-question" onclick="add_item_question_AQ(this.id)" title="Add">+</span>
                </div>

            </div>
        </div>
            <!--End Advanced Tables -->
    </div>

    <div class="row">

        <div class="" style="float: right">
            <button class="save-answer-questions btn style-save" title="Save" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>
        <div class="" style="float:right; margin-right: 17px;margin-left: 18px;">
            <span class="add-item">+</span>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    <script>
        swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                'Mỗi bài bao gồm đề bài, 1 đoạn văn, đặt các câu hỏi cho học sinh và kèm đáp án. ' +
                'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong.' +
                ' Bài của bạn sẽ dược quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        $('.alert-note').click(function () {
            swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                    'Mỗi bài bao gồm đề bài, 1 đoạn văn, đặt các câu hỏi cho học sinh và kèm đáp án. ' +
                    'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                    'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong.' +
                    ' Bài của bạn sẽ dược quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        });
    </script>

    @include('backend.author.answer_question.scritp')
    @include('backend.author.script-common')
@stop
