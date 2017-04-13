@extends('layouts.app-backend')

@section('style')
    @include('backend.author.find_errors.style')
    @include('backend.author.style-common')
@stop

@section('header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                    href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.find-errors')}}">
                {{ trans('label.backend.author.reading.grade_menu.find_error')  }}</a>
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

    {{ Form::open(['route' => 'backend.manager.author.find-errors.store', 'method' => 'post']) }}

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-find-errors-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="find-errors-class">
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
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
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
        {{--<input type="hidden" value="{{$class_code}}" name="class_code">--}}
    </div>
    <div class="row" id="wrap_add_find_errors">
        <div class="col-lg-12 col_add_find_errors">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">

                        <div class="col-lg-12" style="padding-left: 0;">
                            <div class="form-group">
                                <input type="text" name="find_errors[1][title-find-errors]"
                                       class="form-control" placeholder="{{trans('label.backend.create.title-question')}}" required>
                            </div>
                        </div>

                        <div class="form-group" style="width:100%; float:left;">
                            <div class="span-numb-question" id="id-numb-question-1">
                                1
                                <input type="hidden" name="find_errors[1][content-choose-ans-question][1][id]" value="1">
                            </div>
                            <div class="form-group" style="width:98%; float:left;">
                                <div class="span-text-question">
                                    <textarea type="text" class="form-control"  required
                                              name="find_errors[1][content-choose-ans-question][1][content]"
                                              placeholder="This <u>is</u> a <u>example</u> for <u>this</u> question format"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 div-wrap-option-answers" >
                                <div class="col-lg-8 option-as-details">
                                    <label class="col-lg-2" style="padding-right: 0px;" for="find_errors_1_answer_1">Answer: </label>
                                    <div class="form-group col-lg-10" style="width: 43%;padding-left: 0; margin-left: 0">
                                        <input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="1"
                                               name="find_errors[1][content-choose-ans-question][1][answer]"
                                               id="find_errors_1_answer_1">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <span id="add_item_question_1" item_this="1" item="1"
                           class="add-question" onclick="add_item_question_find_error(this.id)" title="Add">+</span>
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
            <button class="save-find-errors btn style-save" title="Save" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    <script>
        swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                'Mỗi bài bao gồm đề bài, các câu chứa 3 đáp án được gợi ý và kèm đáp án bằng chữ. ' +
                'Mỗi đáp án gợi ý được bọc bởi thẻ <u> </u>. ' +
                'Ví dụ: trong câu có 3 gợi ý lỗi sai: <u>house</u>, <u>was</u>, <u>day</u>. ' +
                'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        $('.alert-note').click(function () {
            swal('Mỗi bài bao gồm đề bài, các câu chứa 3 đáp án được gợi ý và kèm đáp án bằng chữ. ' +
                    'Mỗi đáp án gợi ý được bọc bởi thẻ <u> </u>. ' +
                    'Ví dụ: trong câu có 3 gợi ý lỗi sai: <u>house</u>, <u>was</u>, <u>day</u>. ' +
                    'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                    'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                    ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        });
    </script>

    @include('backend.author.find_errors.scritp')
    @include('backend.author.script-common')
@stop
