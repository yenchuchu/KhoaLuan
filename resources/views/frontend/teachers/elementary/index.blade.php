@extends ('layouts.app')
@section('style')
    <style>
        @include('frontend.teachers.elementary.style')
    </style>
@stop

@section('content')
    <div class="col-lg-12 col-md-12 col-ms-12 col-xs-12 wrap-bread_scrumb">
        <div class="bread_crumb">
            <ul>
                <li><a href="{{ route('frontend.teacher.index') }}">Trang chủ &nbsp;›</a></li>
                <li><a href="{{ route('frontend.teacher.elementary') }}">Tiểu học&nbsp;›</a></li>
                <li><a href="{{ route('frontend.teacher.elementary.store') }}">Tạo đề thi</a></li>
            </ul>
        </div>
    </div>


    <div class="main-body col-lg-11 col-md-11 col-ms-11 col-xs-11">
        <div class="panel-body">

            {{ Form::open(['route' => 'frontend.teacher.elementary.store', 'method' => 'post']) }}

                <div class="list-group">
                    <div>
                        <button style="color: green;" id="btnSave" class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;Tạo
                        </button>
                    </div>
                    <input type="hidden" value="TC" name="code_user">
                    <div class="div-hr"></div>
                    <div>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <span class="control-label label-bold" style="line-height: 22px;"><b>CHỌN LỚP</b><span
                                            class="point-start">*</span></span>
                                <select class="form-control input-sm" id="slClass" name="class_id">
                                    <option value="0"> --- Chọn lớp ---</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <span class="control-label label-bold"
                                  style="line-height: 22px;"><b>CHỌN LOẠI BÀI KIỂM TRA</b><span
                                        class="point-start">*</span></span>
                                <select class="form-control input-sm" id="slExamType"  name="exam_type_id">
                                    <option value="0" code="none">--- Chọn loại kiểm tra----</option>
                                    @foreach($exam_types as $exam_type)
                                        <option value="{{$exam_type->id}}" code="{{$exam_type->code}}"
                                                id="{{$exam_type->code}}">{{$exam_type->title}} - {{$exam_type->time}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6" id="reload-unit">
                                @include('frontend.teachers.elementary.unit-reload')
                            </div>
                            <div class="col-sm-6" id="container_skill">
                                <span class="control-label label-bold"
                                      style="line-height: 22px;"><b>CHỌN KỸ NĂNG</b><span
                                            class="point-start">*</span></span>
                                <select class="form-control input-sm input-background-warning" id="slKyNang" name="skill_id">
                                    <option value="0" code="none">Chọn kỹ năng</option>
                                    @foreach($skills as $skill)
                                        <option value="{{$skill->id}}" code="{{$skill->code}}"
                                                id="skill_{{$skill->id}}">{{$skill->title}}</option>
                                    @endforeach
                                </select>
                                <div class="col-lg-12" id="reload_examtype_skill">
                                    @include('frontend.teachers.elementary.examtype-skill-reload')
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('script')
    <script>
        function get_unit_ofClass(class_id) {

            $.ajax({
                url: '{{route("frontend.teacher.elementary.get.unit")}}',
                type: "GET",
                data: {
                    'class_id': class_id
                },
                success: function (data) {
                    $('#reload-unit').html(data);
                },
                error: function () {
                    alert("Không lấy được thông tin này!");
                }
            });
        }

        function get_examtype_ofSkill(skill_code) {

            $.ajax({
                url: '{{route("frontend.teacher.elementary.get.examtype.ofSkill")}}',
                type: "GET",
                data: {
                    'skill_code': skill_code
                },
                success: function (data) {
                    $('#reload_examtype_skill').html(data);
                },
                error: function () {
                    alert("Không lấy được thông tin này!");
                }
            });
        }

        $(document).ready(function () {

            $('#slClass').on('change', function (e) {
                class_id = $('#slClass').val();
                get_unit_ofClass(class_id);
            });

            item_examtype = $('#slExamType').val();
            if(item_examtype == 0) {
                $('#container_skill').hide();
                $('#reload-unit').hide();
            }

            $('#slExamType').on('change', function (e) {
                var code_exam_type = $('#slExamType').find(":selected").attr('code');

                if (code_exam_type == 'test_15') {
                    $('#container_skill').show();
                    $('#reload-unit').show();
                } else {
                    $('#container_skill').hide();
                    $('#reload-unit').hide();
                }
            });

            $('#slKyNang').on('change', function (e) {
                skill_code =  $('#slKyNang').find(":selected").attr('code');
                if(skill_code != 'none') {
                    $('#reload_examtype_skill').show();
                    get_examtype_ofSkill(skill_code);
                } else {
                    $('#reload_examtype_skill').hide();
                }
            });

            $('#btnSave').click(function () {
                class_id = $('#slClass').val();
                if(class_id == 0) {
                    alert('Bạn phải chọn lớp');
                    return false;
                }

                var code_examType = $('#slExamType').find(":selected").attr('code');
                if (code_examType == 'none') {
                    alert('Bạn phải chọn loại bài kiểm tra');
                    return false;
                }

                if (code_examType == 'test_15') {
                    var unitOfChecked = $('input[name="book_map_id[]"]:checked').length;
                    if(unitOfChecked <= 2) {
                        alert('Bạn phải chọn ít nhất 3 Unit');
                        return false;
                    }

                    var skill = $('#slKyNang option:selected').val();
                    if (skill == 0) {
                        alert('Bạn phải chọn Kỹ Năng');
                        return false;
                    }

                }
            });

        });
    </script>
@stop