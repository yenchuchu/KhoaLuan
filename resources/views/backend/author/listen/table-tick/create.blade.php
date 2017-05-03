@extends('layouts.app-backend')

@section('style')
    @include('backend.author.listen.table-tick.style')
    @include('backend.author.style-common')
@stop

@section('header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                    href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.listen.listen_table_ticks')}}">
                {{trans('label.backend.author.listening.grade_menu.listen_table_ticks')}}</a>
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

    {{ Form::open(['route' => 'backend.manager.author.listen.listen_table_ticks.store',
    'method' => 'post', 'files'=>true,
    'enctype' => 'multipart/form-data']) }}

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-listen-table-ticks-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}}  </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="listen-table-ticks-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @elseif($code_user == 'TC')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="listen-table-ticks-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="exam_type_id" class="form-control" id="listen-table-ticks-examtype">
                        @foreach($exam_types as $types)
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3" id="wrap_bookmap_form">

                <select name="book_map_id" class="form-control" id="listen-table-ticks-bookmap">
                    @foreach($book_maps as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>

            </div>
        @endif

        <input type="hidden" value="{{$code_user}}" name="code_user">
        {{--<input type="hidden" value="{{$class_code}}" name="class_code">--}}
    </div>
    <div class="row" id="wrap_add_listen_table_ticks">
        <div class="col-lg-12 col_add_listen_table_ticks">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">

                        <div class="col-lg-12" style="padding-left: 0;">
                            <div class="form-group">
                                <input type="text" name="listen_table_ticks[1][title-listen-table-ticks]"
                                       class="form-control" placeholder="{{trans('label.backend.create.title-question')}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{trans('label.backend.create.upload_audio')}}</label>
                            {{ Form::file('listen_table_ticks[1][url_audio]', array('required')) }}
                        </div>

                        <div class="form-group" style="width:100%; float:left;">

                            <div class="span-choose-listen-table-tick">

                                <table id="listen_table_ticks_1" class="table table-bordered">
                                    <tr>
                                        <td>
                                            <input type="text" placeholder="{{trans('label.backend.create.suggest_answer')}}"
                                                   name="listen_table_ticks[1][content-choose-ans-question][1][suggest]" required>
                                        </td>
                                        <td><input type="checkbox"
                                                   name="listen_table_ticks[1][content-choose-ans-question][1][answer]">
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="form-group">
                    <span id="add_item_question_1" item_this="1" item="1"
                          class="add-question" onclick="add_item_question_LTT(this.id, 'listen_table_ticks_1')" title="Add">+</span>
                </div>

            </div>
        </div>
        <!--End Advanced Tables -->
    </div>

    <div class="row">
        <div style="float: right">
            <button class="save-listen-table-ticks btn style-save" title="Save" type="submit">
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
        $('.save-listen-table-ticks').click(function () {
            var total_question = [];
            var i = 0;
            $('[id^="add_item_question_"]').each(function () {
                item = $('#' + this.id).attr('item');
                item_this = $('#' + this.id).attr('item_this');

                total_question[i] = [item, item_this];
                i++;
            });

            var count_question = total_question.length;
            var order_q = 0;
            var item_order = 0;
            var order_item_this_next = 0;
            var order_item_this = 0;
            var atLeastOneIsChecked = 0;

            for(order_q = 0; order_q< count_question; order_q++) {
                item_order = order_q + 1;
                for (order_item_this = 0; order_item_this < total_question[order_q][1]; order_item_this++) {
                    order_item_this_next = order_item_this + 1;
                    atLeastOneIsChecked+= $('input[name="listen_table_ticks['+item_order+'][content-choose-ans-question]['+order_item_this_next+'][answer]"]:checked').length;
                }
            }

            if(atLeastOneIsChecked < count_question ) {
                swal('', 'Bạn phải chọn đáp án!', 'info');
            }
        });

        swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                'Mỗi bài bao gồm đề bài, một đoạn audio chứa toàn bộ thông tin của các câu trong bài,' +
                ' Một bảng gồm các gợi ý đáp án có trong đoạn audio đấy. ' +
                ' Tác giả phải tích chọn các đáp án đúng trong bảng. ' +
                'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        $('.alert-note').click(function () {
            swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                    'Mỗi bài bao gồm đề bài, một đoạn audio chứa toàn bộ thông tin của các câu trong bài,' +
                    ' Một bảng gồm các gợi ý đáp án có trong đoạn audio đấy. ' +
                    ' Tác giả phải tích chọn các đáp án đúng trong bảng. ' +
                    'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                    'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                    ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        });
    </script>

    @include('backend.author.listen.table-tick.scritp')
    @include('backend.author.script-common')
@stop
