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

        .form-group {
            overflow: hidden;
        }

        .point-start {
            color: red;
            margin-left: 5px;
        }


    </style>
@stop

@section('content')
    <div class="col-lg-12 col-md-12 col-ms-12 col-xs-12 wrap-bread_scrumb">
        <div class="bread_crumb">
            <ul>
                <li><a href="{{ route('frontend.teacher.index') }}">Trang chủ &nbsp;›</a></li>
                <li><a href="{{ route('frontend.teacher.secondary') }}">Trung Học Cơ Sở&nbsp;›</a></li>
                <li><a href="{{ route('frontend.teacher.secondary') }}">Tạo đề thi</a></li>
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
                <li class="list-group-item" style=" min-height: 206px;">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="control-label label-bold" style="line-height: 22px;"><b>CHỌN LỚP</b><span
                                        class="point-start">*</span></span>
                            <select class="form-control input-sm" id="slClass">
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" id="class_{{$class->id}}">{{$class->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <span class="control-label label-bold"
                                  style="line-height: 22px;"><b>CHỌN LOẠI BÀI KIỂM TRA</b></span> <span
                                    class="point-start">*</span>
                            <select class="form-control input-sm" id="slExamType">
                                <option value="0">Chọn loại kiểm tra</option>
                                @foreach($exam_types as $exam_type)
                                    <option value="{{$exam_type->id}}"
                                            id="{{$exam_type->description}}">{{$exam_type->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="container_unit_thcs" style="display: none;">
                        <span class="control-label label-bold col-sm-12"
                              style="line-height: 22px;"><b>CHỌN UNIT</b><span class="point-start">*</span></span>
                        <div class="col-sm-8" id="content_unit_thcs">

                            @foreach($book_maps as $book_map)
                                <span class="col-sm-6">
                                    <label style="line-height: 20px;">
                                        <input id="bookmap_{{$book_map->id}}" type="checkbox">{{$book_map->title}}
                                    </label>
                                </span>
                            @endforeach

                            {{--<span class="col-sm-6"><label style="line-height: 20px;">--}}
                            {{--<input id="62" type="checkbox">Unit 2: My home</label></span><span--}}
                            {{--class="col-sm-6"><label style="line-height: 20px;">--}}
                            {{--<input id="63" type="checkbox">Unit 3: My friends</label></span><span--}}
                            {{--class="col-sm-6"><label style="line-height: 20px;">--}}
                            {{--<input id="64" type="checkbox">Unit 4: My neighbourhood</label></span><span--}}
                            {{--class="col-sm-6"><label style="line-height: 20px;">--}}
                            {{--<input id="65"--}}
                            {{--type="checkbox">Unit 5: Natural wonders of the world</label></span><span--}}
                            {{--class="col-sm-6"><label style="line-height: 20px;">--}}
                            {{--<input id="66" type="checkbox">Unit 6: Our Tet holiday</label></span><span--}}
                            {{--class="col-sm-6"><label style="line-height: 20px;">--}}
                            {{--<input id="67" type="checkbox">Unit 7: Television</label></span><span--}}
                            {{--class="col-sm-6"><label style="line-height: 20px;">--}}
                            {{--<input id="68" type="checkbox">Unit 8: Sports and games</label></span><span--}}
                            {{--class="col-sm-6"><label style="line-height: 20px;">--}}
                            {{--<input id="69" type="checkbox">Unit 9: Cities of the world</label></span><span--}}
                            {{--class="col-sm-6"><label style="line-height: 20px;">--}}
                            {{--<input id="70" type="checkbox">Unit 10: Our houses in the future</label></span><span--}}
                            {{--class="col-sm-6"><label style="line-height: 20px;">--}}
                            {{--<input id="71" type="checkbox">Unit 11: Our greener world</label></span><span--}}
                            {{--class="col-sm-6"><label style="line-height: 20px;">--}}
                            {{--<input id="72" type="checkbox">Unit 12: Robots</label></span>--}}
                        </div>
                    </div>

                    <div class="form-group" id="container_kynang_thcs" style="display: none;">
                        <span class="control-label label-bold col-sm-12" style="line-height: 22px;">
                            <b>CHỌN KỸ NĂNG</b><span class="point-start">*</span></span>

                        <div class="col-sm-8">
                            <select class="form-control input-sm" id="slKyNang">
                                <option value="0">Chọn kỹ năng</option>
                                @foreach($skills as $skill)
                                    <option value="{{$skill->id}}"
                                            id="skill_{{$skill->id}}">{{$skill->title}}</option>
                                @endforeach
                                {{--<option value="77">LISTENING</option>--}}
                                {{--<option value="90">READING</option>--}}
                                {{--<option value="103">WRITING</option>--}}
                                {{--<option value="116">SPEAKING</option>--}}
                                {{--<option value="408">LANGUAGE FOCUS</option>--}}
                                {{----}}
                            </select>
                        </div>

                        <div class="col-sm-8" id="content_kynang_thcs" style="margin-top: 10px;"></div>
                    </div>

                </li>
            </ul>

        </div>
    </div>
@stop

@section('add-script')
    <script>
        $(document).ready(function () {

            $('#slExamType').on('change', function (e) {
                var valueSelected = this.value;

                if (valueSelected == 11) {
                    $('#container_unit_thcs').css('display', 'block');
                    $('#container_kynang_thcs').css('display', 'block');
                } else {
                    $('#container_unit_thcs').css('display', 'none');
                    $('#container_kynang_thcs').css('display', 'none');
                }

            });

            $('#btnSave').click(function () {
                type_exam = $('#slExamType option:selected').val();
                if (type_exam == 0) {
                    alert('Bạn phải chọn loại bài kiểm tra');
                }
                if (type_exam == 2) {
                    unit = $('#slUnit option:selected').val();
                    skill = $('#slKyNang option:selected').val();

                    if (unit == 0) {
                        alert('Bạn phải chọn Unit');
                        return false;
                    }

                    if (skill == 0) {
                        alert('Bạn phải chọn Kỹ Năng');
                        return false;
                    }

                }
            });

        });


    </script>
@stop