@extends ('layouts.app')
@section('style')
    <style>
        .navbar-custom {
            padding: 10px 0;
        }

        #dashboard-index-wrap {
            padding: 100px 0 80px;
        }

        a > img {
            width: 100%;
        }

        .main-body {
            margin: 30px 15px 10px;
            overflow: hidden;
            padding: 10px 10px;
            margin-bottom: 90px;
        }

    </style>
@stop

@section('content')
    <section id="dashboard-index-wrap">
        <div class="container">
            <div class="row">
                {{ Form::open(['route' => 'post.setup.roles', 'method' => 'post']) }}
                {{--{{ Form::open(['route' => 'post.setup.roles', 'method' => 'POST']) }}--}}
                <div class="main-body">

                    <div class="form-group ">
                        <label for="choose-object" class="col-md-4 control-label">Chọn đối tượng</label>
                        <div class="col-md-6 block-12">
                            <div class="option">
                                <div class="group nav nav-tabs">
                                    <div class="item objs">
                                        <input type="radio" id="student" name="office_type" value="ST"
                                               class="radio"
                                               checked="">
                                        <label for="student"><a data-toggle="tab"
                                                                href="#student-tabs">Student</a></label>
                                    </div>
                                    <div class="item objt">
                                        <input type="radio" id="author" name="office_type" value="AT"
                                               class="radio">
                                        <label for="teacher"><a data-toggle="tab"
                                                                href="#teacher-tabs">Author</a></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div id="teacher-tabs" class="tab-pane fade">
                        </div>
                        <div id="student-tabs" class="tab-pane fade in active">
                            <div class="form-group">
                                <label for="class" class="col-md-4 control-label">Class</label>

                                <div class="col-md-6">
                                    <select name="class" id="class-choose">
                                        <option value="0">-- Chọn lớp --</option>
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-done-loginfb" class="btn btn-default" data-dismiss="modal">Done</button>
                </div>

                {{ Form::close() }}

            </div>
        </div>
    </section>
@stop