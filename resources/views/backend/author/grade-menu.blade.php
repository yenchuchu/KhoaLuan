@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">Create Exam For {{$name_code}}</h1>
@stop
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

        .type-exam {
            background: #04b173;
            padding: 18px;
            border-radius: 5px;
            margin-right: 15px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .type-exam:hover {
            background: rgba(10, 185, 122, 0.74);
        }

        .type-exam > a:hover {
            text-decoration: none;
        }

        .type-exam > a {
            color: white;
            padding: 11% 17%;
        }

    </style>
@stop

@section('content')
    <section id="grade-menu-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1>Reading</h1>

                    <div class="main-body">

                        <div class="col-lg-5 type-exam">
                            <a href="{{route('backend.manager.author.answer-question', $class_code)}}">
                                <i class="fa fa-dashboard fa-fw"></i>Answer Questions</a>
                        </div>
                        <div class="col-lg-5 type-exam">
                            <a href="{{route('backend.manager.author.complete-word', $class_code)}}">
                                <i class="fa fa-dashboard fa-fw"></i>Complete Words</a>
                        </div>
                        <div class="col-lg-5 type-exam">
                            <a href="{{route('backend.manager.author.find-errors', $class_code)}}">
                                <i class="fa fa-dashboard fa-fw"></i>Find Errors</a>
                        </div>
                        <div class="col-lg-5 type-exam">
                            <a href="{{route('backend.manager.author.multiple-choice', $class_code)}}">
                                <i class="fa fa-dashboard fa-fw"></i>Multiple Choices</a>
                        </div>
                        <div class="col-lg-5 type-exam">
                            <a href="{{route('backend.manager.author.tick-circle-true-false', $class_code)}}">
                                <i class="fa fa-dashboard fa-fw"></i>Tick Cricle True Flase</a>
                        </div>

                        {{--<div class="col-lg-5 type-exam">--}}
                            {{-------------------------------------------}}
                        {{--</div>--}}

                        {{--<div class="col-lg-5 type-exam">--}}

                            {{--<a href="{{route('backend.manager.author.classify-word', $class_code)}}">--}}
                                {{--<i class="fa fa-dashboard fa-fw"></i>Classify Words</a>--}}
                        {{--</div>--}}

                        {{--<div class="col-lg-5 type-exam">--}}
                            {{--<a href="{{route('backend.manager.author.underlines', $class_code)}}">--}}
                                {{--<i class="fa fa-dashboard fa-fw"></i>Underlines</a>--}}
                        {{--</div>--}}
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="main-body">
                        <h1>Listening</h1>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h1>Speaking</h1>
                    <div class="main-body">

                        <div class="col-lg-5 type-exam">
                            <a href="{{route('backend.manager.author.speaking', $class_code)}}">
                                <i class="fa fa-dashboard fa-fw"></i>
                                {{trans('label.backend.author.speaking.grade_menu.content')}}
                            </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@stop