@extends('layouts.app-backend')

@section('style')
    @include('backend.author.speaking.style')
    @include('backend.author.style-common')
@stop

@section('header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                    href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.speaking')}}">
                {{trans('label.backend.author.speaking.grade_menu.content')}}</a>
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

    {{ Form::open(['route' => 'backend.manager.author.speaking.store',
    'method' => 'post', 'files'=>true,
    'enctype' => 'multipart/form-data']) }}

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-speaking-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}}  </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="speaking-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @elseif($code_user == 'TC')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="speaking-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="exam_type_id" class="form-control" id="speaking-examtype">
                        @foreach($exam_types as $types)
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3" id="wrap_bookmap_form">

                <select name="book_map_id" class="form-control" id="speaking-bookmap">
                    @foreach($book_maps as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>

            </div>
        @endif

        <input type="hidden" value="{{$code_user}}" name="code_user">
        {{--<input type="hidden" value="{{$class_code}}" name="class_code">--}}
    </div>
    <div class="row" id="wrap_add_speaking">
        <div class="col-lg-12 col_add_speaking">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">
                        <div class="form-group">
                                <textarea type="text" class="form-control"
                                          name="speaking[1][content-speaking]"
                                          placeholder="{{trans('label.backend.author.speaking.create.placeholder')}}"
                                          required></textarea>
                        </div>
                        <div class="form-group">
                            <label>{{trans('label.backend.create.upload_audio')}}</label>
                            {{ Form::file('speaking[1][audio]', array()) }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!--End Advanced Tables -->
    </div>

    <div class="row">
        <div style="float: right">
            <button class="save-speaking btn style-save" title="Save" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>
            </button>
        </div>
        <div style="float:right; margin-right: 17px;margin-left: 18px;">
            <span class="add-item">+</span>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    <script>
        swal("Nhập câu hoặc đoạn văn để học sinh đọc lại theo mức độ khó cho từng lớp. Thêm audio nếu có. " +
                "Kích vào nút cộng nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong." +
                " Bài của bạn sẽ dược quản trị kiểm duyệt và gửi thông báo khi đã được đăng.");
        $('.alert-note').click(function () {
            swal("Nhập câu hoặc đoạn văn để học sinh đọc lại theo mức độ khó cho từng lớp. Thêm audio nếu có. " +
                    "Kích vào nút cộng nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong." +
                    " Bài của bạn sẽ dược quản trị kiểm duyệt và gửi thông báo khi đã được đăng.");
        });
    </script>

    @include('backend.author.speaking.scritp')
    @include('backend.author.script-common')


@stop
