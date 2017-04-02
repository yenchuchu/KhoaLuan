@extends('layouts.app-backend')

@section('style')
    @include('backend.author.speaking.style')
    @include('backend.author.style-common')
@stop

@section('header')
    <h1 class="page-header">
        @if($code_user == 'ST')
            {{trans('label.backend.author.speaking.index.title')}}
            <i class="fa fa-exclamation-circle alert-note" aria-hidden="true" title="Hướng dẫn"></i>
        @elseif($code_user == 'TC')
            Add exam 'answer question' for Teacher
        @endif
    </h1>
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
                            <option value="{{$level->id}}">{{$level->title}} - {{$level->point}}  </option>
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
        <input type="hidden" value="{{$class_code}}" name="class_code">
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
                            {{ Form::file('speaking[1][audio]', array()) }}
                        </div>

                    </div>
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
{{--            {{ Form::submit('', array(--}}
            {{--'class' => 'save-speaking btn',--}}
            {{--'title' => 'Save')) }}--}}
            <button class="save-speaking btn" title="Save" type="submit">
            <i class="fa fa-floppy-o" aria-hidden="true"></i>
{{--                            {{trans('label.backend.author.speaking.create.button.add-radio')}}--}}
            </button>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    <script>
        swal("Nhập câu hoặc đoạn văn. Thêm audio nếu có!");
        $('.alert-note').click(function () {
            swal("Nhập câu hoặc đoạn văn. Thêm audio nếu có!");
        });
    </script>

    @include('backend.author.speaking.scritp')
    @include('backend.author.script-common')


@stop
