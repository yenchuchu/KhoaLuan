@extends('layouts.app-backend')

@section('style')
    @include('backend.author.listen.table-match.style')
    @include('backend.author.style-common')
@stop

@section('header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                    href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.listen.listen_table_match')}}">
                {{trans('label.backend.author.listening.grade_menu.listen_table_match')}}</a>
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

    {{ Form::open(['route' => 'backend.manager.author.listen.listen_table_match.store',
    'method' => 'post', 'files'=>true,
    'enctype' => 'multipart/form-data']) }}

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-listen-table-matchs-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}}  </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="listen-table-matchs-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @elseif($code_user == 'TC')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="listen-table-matchs-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="exam_type_id" class="form-control" id="listen-table-matchs-examtype">
                        @foreach($exam_types as $types)
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3" id="wrap_bookmap_form">

                <select name="book_map_id" class="form-control" id="listen-table-matchs-bookmap">
                    @foreach($book_maps as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>

            </div>
        @endif

        <input type="hidden" value="{{$code_user}}" name="code_user">
{{--        <input type="hidden" value="{{$class_code}}" name="class_code">--}}
    </div>
    <div class="row" id="wrap_add_listen_table_match">
        <div class="col-lg-12 col_add_listen_table_match">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">

                        <div class="col-lg-12" style="padding-left: 0; padding-right: 0px">
                            <div class="form-group">
                                <input type="text" name="listen_table_matchs[1][title-listen-table-match]"
                                       class="form-control" placeholder="{{trans('label.backend.create.title-question')}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{trans('label.backend.create.upload_audio')}}</label>
                            {{ Form::file('listen_table_matchs[1][url_audio]', array('required')) }}
                        </div>

                        <div class="form-group" style="width:100%; float:left;">

                            <div class="span-choose-listen-table-match">

                                <table id="listen_table_matchs_1" class="table-match table table-bordered">
                                    <tr>
                                        <td>
                                            <label>1 </label>
                                            <input type="text" placeholder="{{trans('label.backend.create.suggest_answer')}}"
                                                   name="listen_table_matchs[1][content-choose-ans-question][left][1]" required>

                                            <div class="col-sm-3" style="padding-left: 0px; float:right;">
                                                <label>Đáp án </label>
                                                <input type="text" maxlength="1" style="text-transform:uppercase" required
                                                       name="listen_table_matchs[1][answer][1]">
                                            </div>
                                        </td>
                                        <td>
                                            <label>{{$alphab_order[1]}} </label>
                                            <input type="text"
                                                   name="listen_table_matchs[1][content-choose-ans-question][right][{{$alphab_order[1]}}]" required>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="form-group">
                    <span id="add_item_question_1" item_this="1" item="1"
                          class="add-question" onclick="add_item_question_LTM(this.id, 'listen_table_matchs_1')" title="Add">+</span>
                </div>

            </div>
        </div>
        <!--End Advanced Tables -->
    </div>

    <div class="row">
        <div style="float: right">
            <button class="save-listen_table_matchs btn style-save" title="Save" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>
        <div style="float:right; margin-right: 17px;margin-left: 18px;">
            <span class="add-item">+</span>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    <script>
        swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                'Mỗi bài bao gồm đề bài, một bảng bao gồm 1 cột bên trái là các vế cần nối và đáp án, cột bên phải là các vế tương ứng. ' +
                'Nếu muốn thêm câu trong bảng chọn nút cộng ngay dưới câu phía trước. ' +
                'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        $('.alert-note').click(function () {
            swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                    'Mỗi bài bao gồm đề bài, một bảng bao gồm 1 cột bên trái là các vế cần nối và đáp án, cột bên phải là các vế tương ứng. ' +
                    'Nếu muốn thêm câu trong bảng chọn nút cộng ngay dưới câu phía trước. ' +
                    'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                    ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        });
    </script>

    @include('backend.author.listen.table-match.scritp')
    @include('backend.author.script-common')
@stop
