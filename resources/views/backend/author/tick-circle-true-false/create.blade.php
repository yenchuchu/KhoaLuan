@extends('layouts.app-backend')

@section('style')
    @include('backend.author.tick-circle-true-false.style')
    @include('backend.author.style-common')
@stop

@section('header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                    href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.tick-circle-true-false')}}">
                {{trans('label.backend.author.reading.grade_menu.tick_true_false')}}</a>
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

    {{ Form::open(['route' => 'backend.manager.author.tick-circle-true-false.store', 'method' => 'post']) }}

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-tick-true-false-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="tick-true-false-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @elseif($code_user == 'TC')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="tick-true-false-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="exam_type_id" class="form-control" id="tick-true-false-examtype">
                        @foreach($exam_types as $types)
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3" id="wrap_bookmap_form">

                <select name="book_map_id" class="form-control" id="tick-true-false-bookmap">
                    @foreach($book_maps as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>

            </div>
        @endif

        <input type="hidden" value="{{$code_user}}" name="code_user">
{{--        <input type="hidden" value="{{$class_code}}" name="class_code">--}}
    </div>
    <div class="row" id="wrap_add_tick_true_false">
        <div class="col-lg-12 col_add_tick_true_false">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">

                        <div class="col-lg-12" style="padding-left: 0;">
                            <div class="form-group">
                                <input type="text" name="tick_true_false[1][title-tick-true-false]"
                                       class="form-control" required  placeholder="{{trans('label.backend.create.title-question')}}">
                            </div>
                        </div>

                        <div class="form-group">
                                <textarea type="text" class="form-control"
                                          name="tick_true_false[1][content-tick-true-false]"
                                          placeholder="{{trans('label.backend.create.content-question')}}" required></textarea>
                        </div>
                        <div class="form-group" style="width:100%; float:left;">
                            <div class="span-numb-question" id="id-numb-question-1">
                                1
                                <input type="hidden" name="tick_true_false[1][content-choose-ans-question][1][id]" value="1">
                            </div>
                            <div class="span-text-question">
                                    <textarea type="text" class="form-control"
                                              name="tick_true_false[1][content-choose-ans-question][1][content]"
                                              placeholder="{{trans('label.backend.create.item-content-question')}}" required></textarea>
                            </div>
                            <div class="span-choose-tick-true-false">
                                <span>
                                    <input type="radio" id="check-answer_1_1_T"
                                           name="tick_true_false[1][content-choose-ans-question][1][answer]" value="T"
                                           class="ans-true">
                                    <label for="check-answer_1_1_T" style="cursor: pointer">T</label>
                                </span>
                                <span>
                                     <input type="radio" id="check-answer_1_1_F"
                                            name="tick_true_false[1][content-choose-ans-question][1][answer]" value="F"
                                            class="ans-false">
                                    <label for="check-answer_1_1_F" style="cursor: pointer">F</label>
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <span id="add_item_question_1" item_this="1" item="1"
                           class="add-question" onclick="add_item_question_TF(this.id)" title="Add">+</span>
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>

    </div>

    <div class="row">
        <div  style="float: right">
            <button class="save-tick-true-false btn style-save" title="Save" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>
        <div style="float:right; margin-right: 17px;margin-left: 18px;">
            <spam class="add-item">+</spam>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    <script>
        swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                'Mỗi bài bao gồm đề bài, đoạn văn và các câu cho học sinh chọn đúng sai.' +
                ' Tác giả phải chọn đáp án đúng hoặc sai cho các câu của mình. ' +
                'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        $('.alert-note').click(function () {
            swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                    'Mỗi bài bao gồm đề bài, đoạn văn và các câu cho học sinh chọn đúng sai.' +
                    ' Tác giả phải chọn đáp án đúng hoặc sai cho các câu của mình. ' +
                    'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                    'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                    ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        });
    </script>

    @include('backend.author.tick-circle-true-false.scritp')
    @include('backend.author.script-common')
@stop
