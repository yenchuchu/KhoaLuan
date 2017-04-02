@extends ('layouts.app')
@section('add-style')
    <style>
        .body-wrap-main {
            background: #DEF3FF url({{asset('/imgs-dashboard/gamepage_bg.png')}}) no-repeat bottom right;
        }

        .bread_crumb ul {
            display: inline-flex;
            list-style-type: none;
            margin-bottom: 0px;
        }

        .bread_crumb ul li {
            margin-right: 10px;
        }

        .main-body {
            background: #fff none repeat scroll 0 0;
            border: 1px solid #ddd;
            margin: 7px 15px 10px;
            overflow: hidden;
            padding: 10px 10px;
            margin-bottom: 100px;
        }

        .wrap-bread_scrumb {
            margin-bottom: 10px;
        }


    </style>
@stop

@section('content')
    <div class="col-lg-12 col-md-12 col-ms-12 col-xs-12 wrap-bread_scrumb">
        <div class="bread_crumb">
            <ul>
                <li><a href="{{ route('frontend.teacher.index') }}">Trang chủ &nbsp;›</a></li>
                <li><a href="{{ route('frontend.teacher.highschool') }}">Trung Học Phổ Thông&nbsp;›</a></li>
                <li><a href="{{ route('frontend.teacher.highschool.create') }}">Tạo đề thi</a></li>
            </ul>
        </div>
    </div>


    <div class="main-body col-lg-12 col-md-12 col-ms-12 col-xs-12">
        <div class="panel-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <button style="color: green;" id="btnSave" class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;Tạo
                    </button>
                    <button style="color: red;" class="btn btn-default" id="cancel-btn" type="button">
                        <span class="glyphicon glyphicon-remove"></span>Hủy
                    </button>
                </li>
                <li class="list-group-item" style="height: 206px;">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="control-label label-bold" style="line-height: 22px;"><b>CHỌN LỚP</b></span>
                            <select class="form-control input-sm" id="slClass">
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <span class="control-label label-bold"
                                  style="line-height: 22px;"><b>CHỌN LOẠI BÀI KIỂM TRA</b></span>
                            <select class="form-control input-sm" id="slExamType">
                                <option value="0">Chọn loại kiểm tra</option>
                                @foreach($exam_types as $exam_type)
                                    <option value="{{$exam_type->id}}"
                                            id="{{$exam_type->description}}">{{$exam_type->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="display: block;" id="container_Unit">
                        <div class="col-sm-4">
                            <span class="control-label label-bold" style="line-height: 22px;"><b>CHỌN UNIT</b></span>
                            <select class="form-control input-sm input-background-warning" id="slUnit">
                                <option value="0">Chọn Unit</option>
                                @foreach($book_maps as $book_map)
                                    <option value="{{$book_map->id}}"
                                            id="bookmap_{{$book_map->id}}">{{$book_map->title}}</option>
                                @endforeach
                                {{--<option value="1">Unit 1: Hello</option>--}}
                                {{--<option value="2">Unit 2: What is your name?</option>--}}
                                {{--<option value="3">Unit 3: This is Tony</option>--}}
                                {{--<option value="4">Unit 4: How old are you?</option>--}}
                                {{--<option value="5">Unit 5: Are they your friends?</option>--}}
                                {{--<option value="6">Unit 6: Stand up!</option>--}}
                                {{--<option value="7">Unit 7: That's my school</option>--}}
                                {{--<option value="8">Unit 8: This is my pen</option>--}}
                                {{--<option value="9">Unit 9: What colour is it?</option>--}}
                                {{--<option value="10">Unit 10: What do you do at break time?</option>--}}
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <span class="control-label label-bold" style="line-height: 22px;"><b>CHỌN KỸ NĂNG</b></span>
                            <select class="form-control input-sm input-background-warning" id="slKyNang">
                                <option value="0">Chọn kỹ năng</option>
                                @foreach($skills as $skill)
                                    <option value="{{$skill->id}}"
                                            id="skill_{{$skill->id}}">{{$skill->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@stop