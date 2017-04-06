@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">Post Detail</h1>
@stop
@section('style')
    <style>
        .navbar-custom {
            padding: 10px 0;
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
        <div class="">
            <div class="row">
                <div class="main-body">

                        <?php
                        switch ($name_table) {
                        case "answer_questions": ?>

                            @foreach($records as $record)
                                @include('backend.author.show-post.show-answer-question')
                            @endforeach

                        <?php  break;

                        case "complete_words": ?>

                            @foreach($records as $record)
                                @include('backend.author.show-post.show-answer-question')
                            @endforeach

                        <?php  break;

                        case "find_errors": ?>

                            @foreach($records as $record)
                                @include('backend.author.show-post.show-answer-question')
                            @endforeach

                        <?php  break;

                        case "multiple_choices": ?>

                            @foreach($records as $record)
                                @include('backend.author.show-post.show-answer-question')
                            @endforeach

                        <?php break;

                        case "tick_circle_true_falses": ?>

                            @foreach($records as $record)
                                @include('backend.author.show-post.show-answer-question')
                            @endforeach

                        <?php break;
                        case "complete_tables": ?>

                            @foreach($records as $record)
                                @include('backend.author.show-post.show-answer-question')
                            @endforeach

                         <?php   break;

                        case "table_ticks":?>

                            @foreach($records as $record)
                                @include('backend.author.show-post.show-answer-question')
                            @endforeach

                        <?php break;

                        case "table_matchs":
                            echo "classify_words!";
                            break;

                        case "complete_sentences":
                            echo "classify_words!";
                            break;

                        case "listen_ticks":
                            echo "classify_words!";
                            break;

                        case "tick_crosses":
                            echo "classify_words!";
                            break;

                        case "fill_numbers":
                            echo "classify_words!";
                            break;
                        default:
                            echo "Your favorite color is neither red, blue, nor green!";
                        }
                        ?>

                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script>
        setTableInit('manager_own_posts_listen');
        setTableInit('manager_own_posts_speak');
        setTableInit('manager_own_posts_read');
    </script>

@stop
