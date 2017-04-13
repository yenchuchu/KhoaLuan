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
            <a href="{{route('backend.manager.author.listen.listen_complete_sentences')}}">
                {{trans('label.backend.author.listening.grade_menu.listen_complete_sentences')}}</a>
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

    {{ Form::open(['route' => 'backend.manager.author.listen.listen_complete_sentences.store',
    'method' => 'post', 'files'=>true,
    'enctype' => 'multipart/form-data']) }}

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-listen-complete-sentences-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="listen-complete-sentences-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @elseif($code_user == 'TC')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="listen-complete-sentences-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="exam_type_id" class="form-control" id="listen-complete-sentences-examtype">
                        @foreach($exam_types as $types)
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3" id="wrap_bookmap_form">

                <select name="book_map_id" class="form-control" id="listen-complete-sentences-bookmap">
                    @foreach($book_maps as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>

            </div>
        @endif

        <input type="hidden" value="{{$code_user}}" name="code_user">
{{--        <input type="hidden" value="{{$class_code}}" name="class_code">--}}
    </div>
    <div class="row" id="wrap_add_listen_complete_sentences">
        <div class="col-lg-12 col_add_listen_complete_sentences">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">

                        <div class="col-lg-12" style="padding-left: 0;">
                            <div class="form-group">
                                <input type="text" name="listen_complete_sentences[1][title-listen-complete-sentences]"
                                       class="form-control" placeholder="{{trans('label.backend.create.title-question')}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('label.backend.create.upload_audio')}}</label>
                            {{ Form::file('listen_complete_sentences[1][audio]', array()) }}
                        </div>
                        <div class="form-group" style="width:100%; float:left;">
                            <div class="span-numb-question" id="id-numb-question-1">
                                1
                                <input type="hidden" name="listen_complete_sentences[1][content-choose-ans-question][1][id]" value="1">
                            </div>
                            <div class="form-group" style="width:98%; float:left;">
                                <div class="span-text-question">
                                    <textarea type="text" class="form-control"
                                              name="listen_complete_sentences[1][content-choose-ans-question][1][content]"
                                              placeholder="this is ___ a kind. there are three character _" required></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12" style="padding-left: 0;margin-left: 17px;width: 100%">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}"
                                    name="listen_complete_sentences[1][content-choose-ans-question][1][answer]">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="form-group">
                    <span id="add_item_question_1" item_this="1" item="1"
                       class="add-question" onclick="add_item_question_LCS(this.id)" title="Add">+</span>
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
            <button class="save-listen-complete-sentences btn style-save" title="Save" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')

    <script>
        swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                'Mỗi bài bao gồm đề bài, một đoạn audio chứa toàn bộ thông tin của các câu trong bài,' +
                ' các câu bao gồm phần trống cần điền được kí hiệu bằng 3 dấu gạch dưới ( _ ) viết liền nhau. ' +
                ' Tác giả phải nhập đáp án của từng câu trong bài. ' +
                'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        $('.alert-note').click(function () {
            swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                    'Mỗi bài bao gồm đề bài, một đoạn audio chứa toàn bộ thông tin của các câu trong bài,' +
                    ' các câu bao gồm phần trống cần điền được kí hiệu bằng 3 dấu gạch dưới ( _ ) viết liền nhau. ' +
                    ' Tác giả phải nhập đáp án của từng câu trong bài. ' +
                    'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                    'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                    ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        });
    </script>
    @include('backend.author.listen.complete-sentences.scritp')
    @include('backend.author.script-common')
@stop
