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

        .block-12 a>label:active,
        .block-12 a>label:focus {
            background-color: #00b1b3;
            color: white !important;
        }

        .block-12 a:hover,
        .block-12 a:focus {
            text-decoration: none !important;
        }

        .block-12 .option .item {
            float: left;
            position: relative;
        }

        .block-12 .option .radio {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
        }

        .block-12 input, select, textarea {
            vertical-align: middle;
            font-family: inherit;
            font-size: inherit;
            border: 0;
            outline: 0;
            color: #1b2e3a;
        }

        .block-12 .option .radio:checked ~ label {
            background: #00b1b3;
            color: #fff;
        }

        .block-12 .option .radio:checked ~ label>a {
            color: white !important;
        }

        .block-12 .option .item:first-child label {
            border-radius: 3px 0 0 3px;
        }

        .block-12 .option label {
            display: block;
            width: 110px;
            height: 36px;
            line-height: 36px;
            text-align: center;
            background: #eee;
            cursor: pointer;
        }

        .block-12 .option .item {
            float: left;
            position: relative;
        }

        #class {
            width: 42%;
            box-shadow: none;
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
                        <label for="choose-object" class="col-sm-offset-3 col-md-2 control-label">Chọn đối tượng</label>
                        <div class="col-md-6 block-12">
                            <div class="option">
                                <div class="group nav nav-tabs" style="border-bottom: none">
                                    <div class="item objs">
                                        <input type="radio" id="student" name="office_type" value="ST"
                                               class="radio" checked>
                                        <label id="label-stdent-id" for="student">HỌC SINH</label>
                                    </div>
                                    <div class="item objt" style="color: #00b1b3">
                                        <input type="radio" id="author" name="office_type" value="AT"
                                               class="radio">
                                        <label id="label-author-id" for="author">TÁC GIẢ</label>
                                    </div>
                                    <input type="hidden" id="check_type_user">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div id="teacher-tabs" class="tab-pane fade ">
                        </div>
                        <div id="student-tabs" class="tab-pane fade in active">
                            <div class="form-group" style="padding-top: 30px;">
                                <label for="class" class="col-sm-offset-3 col-md-2 control-label">Chọn lớp</label>

                                <div class="col-md-6">
                                    <select name="class" id="class" class="form-control">
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
                    <button type="submit" id="btn-done-loginfb" class="btn btn-default" data-dismiss="modal">Xong</button>
                </div>

                {{ Form::close() }}

            </div>
        </div>
    </section>
@stop

@section('script')

    <script>
        $('#label-stdent-id').css('background-color', '#00b1b3');
        $('#label-stdent-id').css('color', 'white');

        $('#label-author-id').click(function () {
            $(this).css('background-color', '#00b1b3');
            $(this).css('color', 'white');

            $('#label-stdent-id').css('background-color', '#eeeeee');
            $('#label-stdent-id').css('color', '#00b1b3');

            $('#student-tabs').hide();
        });

        $('#label-stdent-id').click(function () {
            $(this).css('background-color', '#00b1b3');
            $(this).css('color', 'white');

            $('#label-author-id').css('background-color', '#eeeeee');
            $('#label-author-id').css('color', '#00b1b3');

            $('#student-tabs').show();
        });

        $( 'input[type="radio"]' ).on( "click", function() {
            $( "#check_type_user" ).html( $( "input:checked" ).val() + " is checked!" );
        });

    </script>
@endsection
