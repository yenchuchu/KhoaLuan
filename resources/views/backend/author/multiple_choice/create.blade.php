@extends('layouts.app-backend')

@section('style')
    @include('backend.author.multiple_choice.style')
    @include('backend.author.style-common')
@stop

@section('header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                    href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>
        <li class="breadcrumb-item ">
            <a href="{{route('backend.manager.author.multiple-choice')}}">
                {{trans('label.backend.author.reading.grade_menu.multiple_choice')}}</a>
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

    {{ Form::open(['route' => 'backend.manager.author.multiple-choice.store', 'method' => 'post']) }}

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-multiple-choice-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}}  </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="multiple-choice-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @elseif($code_user == 'TC')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="multiple-choice-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="exam_type_id" class="form-control" id="multiple-choice-examtype">
                        @foreach($exam_types as $types)
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3" id="wrap_bookmap_form">

                <select name="book_map_id" class="form-control" id="multiple-choice-bookmap">
                    @foreach($book_maps as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>

            </div>
        @endif

        <input type="hidden" value="{{$code_user}}" name="code_user">
        {{--<input type="hidden" value="{{$class_code}}" name="class_code">--}}
    </div>
    <div class="row" id="wrap_add_multiple_choice">
        <div class="col-lg-12 col_add_multiple_choice">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">

                        <div class="col-lg-12" style="padding-left: 0; padding-right: 0px">
                            <div class="form-group">
                                <input type="text" name="multiple_choice[1][title-multiple-choice]" required
                                       class="form-control" required placeholder="{{trans('label.backend.create.title-question')}}">
                            </div>
                        </div>
                        <div class="form-group">
                                <textarea type="text" class="form-control"
                                          name="multiple_choice[1][content-multiple-choice]"
                                          placeholder="{{trans('label.backend.create.content-question')}}"></textarea>
                        </div>
                        <div class="form-group" style="width:100%; float:left;">
                            <div class="span-numb-question" id="id-numb-question-1">
                                1
                                <input type="hidden" name="multiple_choice[1][content-choose-ans-question][1][id]" value="1">
                            </div>
                            <div class="form-group" style="width:98%; float:left;">
                                <div class="span-text-question">
                                    <textarea type="text" class="form-control count-question-multiple"
                                              name="multiple_choice[1][content-choose-ans-question][1][content]"
                                              placeholder="This is ... demo" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 div-wrap-option-answers" >
                                <div class="col-lg-4 option-as-details">
                                    <input type="radio" value="A"
                                           name="multiple_choice[1][content-choose-ans-question][1][answer]">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="1"
                                               name="multiple_choice[1][content-choose-ans-question][1][suggest_choose][A]">
                                    </div>
                                </div>

                                <div class="col-lg-4 option-as-details">
                                    <input type="radio" value="B"
                                           name="multiple_choice[1][content-choose-ans-question][1][answer]">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="2"
                                               name="multiple_choice[1][content-choose-ans-question][1][suggest_choose][B]">
                                    </div>
                                </div>

                                <div class="col-lg-4 option-as-details">
                                    <input type="radio" value="C"
                                           name="multiple_choice[1][content-choose-ans-question][1][answer]">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="3"
                                               name="multiple_choice[1][content-choose-ans-question][1][suggest_choose][C]">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <span id="add_item_question_1" item_this="1" item="1"
                           class="add-question" onclick="add_item_question_MT(this.id)" title="Add">+</span>
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>

    </div>

    <input type="hidden" id="total-question">
    <div class="row">
        <div style="float: right">
            <button class="save-multiple-choice btn style-save" title="Save" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>
        <div  style="float:right; margin-right: 17px;margin-left: 18px;">
            <span class="add-item">+</span>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    <script>

        $('.save-multiple-choice').click(function () {
            var numItems = $('.count-question-multiple').length;
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
                    atLeastOneIsChecked+= $('input[name="multiple_choice['+item_order+'][content-choose-ans-question]['+order_item_this_next+'][answer]"]:checked').length;
                }
            }

            if(atLeastOneIsChecked < numItems) {
                swal('', 'Bạn phải chọn hết đáp án đúng!', 'info');
            }
        });

        swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                'Mỗi bài bao gồm đề bài (có thể có hoặc không), mỗi câu hỏi chứa 3 dấu chấm (.) liền nhau là vị trí cần chọn đáp án đúng dể điền vào.' +
                'Mỗi câu gồm 3 đáp án gợi ý, sau khi nhập 3 đáp án gợi ý, tác giả kích chọn đáp án đúng. ' +
                'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        $('.alert-note').click(function () {
            swal('Tạo bài luyện tập theo mức độ khó cho từng lớp. ' +
                    'Mỗi bài bao gồm đề bài, các câu chứa 3 dấu chấm (.) liền nhau là vị trí cần chọn đáp án đúng dể điền vào.' +
                    'Mỗi câu gồm 3 đáp án gợi ý, sau khi nhập 3 đáp án gợi ý, tác giả kích chọn đáp án đúng. ' +
                    'Nếu muốn thêm câu trong bài chọn nút cộng ngay dưới câu phía trước. ' +
                    'Kích vào nút cộng dưới cùng bên phải nếu muốn thêm bài mới. Kích vào nút lưu khi đã ra bài xong. ' +
                    ' Bài của bạn sẽ được quản trị kiểm duyệt và gửi thông báo khi đã được đăng.');
        });
    </script>

    @include('backend.author.multiple_choice.scritp')
    @include('backend.author.script-common')
@stop
