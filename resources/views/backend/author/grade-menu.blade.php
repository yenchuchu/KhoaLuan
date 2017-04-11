@extends('layouts.app-backend')

@section('style')
    <style>
        .navbar-custom {
            padding: 10px 0;
        }

        a > img {
            width: 100%;
        }

        .main-body {
            margin: 10px 15px 10px;
            overflow: hidden;
            padding: 10px 10px;
            margin-bottom: 20px;
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
            /*padding: 11% 17%;*/
        }

        .type-exam i {
            margin-right: 6px;
        }

        #grade-menu-wrap .title-skills {
            border-bottom: 1px solid #eeeeee;
            padding-bottom: 10px;
            color: black;
        }

        #grade-menu-wrap ul li a {
            border: none;
            padding: 14px 20px;
        }

        #grade-menu-wrap ul li {
            padding: 0px;
        }

        #grade-menu-wrap .title-span-skill {
            background-color: #eee;
            font-weight: 700;
            font-size: 16px;
            border-radius: 0px;
            border: none;
        }

    </style>
@stop

@section('header')
    <h1 class="page-header">{{ trans('label.backend.dashboard')  }}</h1>
    {{--<ol class="breadcrumb">--}}
        {{--<li class="breadcrumb-item"><a href="{{route('backend.manager.author.index')}}">{{ trans('label.backend.dashboard')  }}</a></li>--}}
        {{--<li class="breadcrumb-item ">--}}
            {{--<span class="bread-active">--}}
                    {{--{{ trans('label.backend.author.dashboard')  }}--}}
                {{--@if($name_code == 'Elementary')--}}
                  {{--học sinh cấp 1--}}
                {{--@elseif($name_code == 'Secondary')--}}
                   {{--học sinh cấp 2--}}
                {{--@else--}}
                    {{--học sinh cấp 3--}}
                {{--@endif--}}
            {{--</span>--}}
        {{--</li>--}}
    {{--</ol>--}}

@stop

@section('content')
    <section id="grade-menu-wrap">
        <div class="">
            <div class="row">
                <div class="col-lg-4">

                    <div class="main-body">

                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="title-span-skill list-group-item"> {{ trans('label.skills.reading') }}</span>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('backend.manager.author.answer-question')}}"
                                   class="list-group-item">
                                    {{trans('label.backend.author.reading.grade_menu.answer_question')}}
                                    <span class="badge">{{$tal_ans_question}}</span></a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('backend.manager.author.find-errors')}}"
                                   class="list-group-item">
                                    {{trans('label.backend.author.reading.grade_menu.find_error')}}
                                    <span class="badge">{{$tal_find_error}}</span></a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('backend.manager.author.multiple-choice')}}"
                                   class="list-group-item">
                                    {{trans('label.backend.author.reading.grade_menu.multiple_choice')}}
                                    <span class="badge">{{$tal_multiple}}</span></a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('backend.manager.author.tick-circle-true-false')}}"
                                   class="list-group-item">
                                    {{trans('label.backend.author.reading.grade_menu.tick_true_false')}}
                                    <span class="badge">{{$tal_tick_true_false}}</span></a>
                            </li>
                        </ul>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="main-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="title-span-skill list-group-item"> {{ trans('label.skills.listening') }}</span>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('backend.manager.author.listen.listen_complete_sentences')}}"
                                   class="list-group-item">
                                    {{trans('label.backend.author.listening.grade_menu.listen_complete_sentences')}}
                                    <span class="badge">{{$tal_listen_complete}}</span></a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('backend.manager.author.listen.listen_ticks')}}"
                                   class="list-group-item">
                                    {{trans('label.backend.author.listening.grade_menu.listen_ticks')}}
                                    <span class="badge">{{$tal_listen_ticks}}</span></a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('backend.manager.author.listen.listen_table_ticks')}}"
                                   class="list-group-item">
                                    {{trans('label.backend.author.listening.grade_menu.listen_table_ticks')}}
                                    <span class="badge">{{$tal_listen_table_ticks}}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="main-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="title-span-skill list-group-item"> {{ trans('label.skills.speaking') }}</span>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('backend.manager.author.speaking')}}"
                                   class="list-group-item">
                                    {{trans('label.backend.author.speaking.grade_menu.content')}}
                                    <span class="badge">{{$tal_speaks}}</span></a>
                            </li>
                        </ul>

                    </div>
                </div>


            </div>
        </div>
    </section>
@stop