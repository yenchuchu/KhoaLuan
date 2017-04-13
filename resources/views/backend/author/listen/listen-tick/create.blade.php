@extends('layouts.app-backend')

@section('style')
    @include('backend.author.listen.listen-tick.style')
    @include('backend.author.style-common')
@stop

@section('header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                    href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.listen.listen_ticks')}}">
                {{trans('label.backend.author.listening.grade_menu.listen_ticks')}}</a>
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

    {{ Form::open(['route' => 'backend.manager.author.listen.listen_ticks.store',
    'method' => 'post', 'files'=>true,
    'enctype' => 'multipart/form-data']) }}

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-listen-ticks-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}}  </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="listen-ticks-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @elseif($code_user == 'TC')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="listen-ticks-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="exam_type_id" class="form-control" id="listen-ticks-examtype">
                        @foreach($exam_types as $types)
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3" id="wrap_bookmap_form">

                <select name="book_map_id" class="form-control" id="listen-ticks-bookmap">
                    @foreach($book_maps as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>

            </div>
        @endif

        <input type="hidden" value="{{$code_user}}" name="code_user">
{{--        <input type="hidden" value="{{$class_code}}" name="class_code">--}}
    </div>
    <div class="row" id="wrap_add_listen_ticks">
        <div class="col-lg-12 col_add_listen_ticks">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">

                        <div class="col-lg-12" style="padding-left: 0;">
                            <div class="form-group">
                                <input type="text" name="listen_ticks[1][title-listen-ticks]"
                                       class="form-control" placeholder="{{trans('label.backend.create.title-question')}}" required>
                            </div>
                        </div>
                        <div class="form-group" style="width:100%; float:left;">
                            <div class="span-numb-question" id="id-numb-question-1">
                                1
                                <input type="hidden" name="listen_ticks[1][content-choose-ans-question][1][id]" value="1">
                            </div>

                            <div class="form-group">
                                <label>{{trans('label.backend.create.upload_audio')}}</label>
                                {{ Form::file('listen_ticks[1][content-choose-ans-question][1][url_audio]', array()) }}
                            </div>

                            <div class="span-choose-listen-tick">
                                <span class="img-listen-tick">
                                    <input type="radio" id="check-answer_1_1_A" required
                                           name="listen_ticks[1][content-choose-ans-question][1][answer]" value="A"
                                           class="ans-true">
                                    <label for="check-answer_1_1_A" style="cursor: pointer">
                                        <img src="{{URL::asset('imgs-dashboard/avatar.png')}}" style="height: 180px;"
                                             id="change_uploadListenImgOne_1_1_A" alt="image suggest">
                                    </label>

                                    <input type="file" id="uploadListenImgOne_1_1_A" onclick="choose_img_upload(this.id)"
                                           name="listen_ticks[1][content-choose-ans-question][1][content][A]"
                                           required style="margin-left: 17px; margin-top: 10px;">
                                </span>
                                <span class="img-listen-tick">
                                     <input type="radio" id="check-answer_1_1_B" required
                                            name="listen_ticks[1][content-choose-ans-question][1][answer]" value="B"
                                            class="ans-false">
                                    <label for="check-answer_1_1_B" style="cursor: pointer">
                                         <img src="{{URL::asset('imgs-dashboard/avatar.png')}}" style="height: 180px;"
                                              id="change_uploadListenImgOther_1_1_B" alt="image suggest">
                                    </label>

                                    <input type="file" id="uploadListenImgOther_1_1_B" onclick="choose_img_upload(this.id)"
                                           name="listen_ticks[1][content-choose-ans-question][1][content][B]"
                                           required style="margin-left: 17px; margin-top: 10px;">
                                </span>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="form-group">
                    <span id="add_item_question_1" item_this="1" item="1"
                          class="add-question" onclick="add_item_question_LT(this.id)" title="Add">+</span>
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
            <button class="save-listen-ticks btn style-save" title="Save" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    <script>
        swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                'Mỗi bài bao gồm đề bài, mỗi câu trong bài bao gồm một audio, hai ảnh cho học sinh chọn kèm đáp án.  ' +
                ' Sau khi tác giả thêm audio và thêm ảnh, phải kích chọn vào ảnh đúng. ' +
                'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        $('.alert-note').click(function () {
            swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                    'Mỗi bài bao gồm đề bài, mỗi câu trong bài bao gồm một audio, hai ảnh cho học sinh chọn kèm đáp án.  ' +
                    ' Sau khi tác giả thêm audio và thêm ảnh, phải kích chọn vào ảnh đúng. ' +
                    'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                    'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                    ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        });
    </script>

    @include('backend.author.listen.listen-tick.scritp')
    @include('backend.author.script-common')
@stop
