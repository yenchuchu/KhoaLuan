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
                    switch ($record->table) {
                    case "answer_questions": ?>

                    @include('backend.author.show-post.show-answer-question')
                    <?php  break;

                    case "complete_words": ?>
                    @include('frontend.student.join-test.temp_complete_word',
                 ['key' => $key, 'j_title' => $j_title, 'k_question' => $k_question, 'id_question' => $question->id,
                 'question_content' =>$question->content, 'id_record'=> $detail->id, 'table' => $detail->table])
                    <?php  break;

                    case "find_errors": ?>

                    @include('frontend.student.join-test.temp_find_error',
                    ['key' => $key, 'j_title' => $j_title, 'k_question' => $k_question, 'id_question' => $question->id,
                    'question_content' =>$question->content, 'id_record'=> $detail->id, 'table' => $detail->table,
                    'suggest_answer' => $question->suggest_choose])
                    <?php  break;

                    case "multiple_choices": ?>

                    @include('frontend.student.join-test.temp_multiple_choice',
                ['key' => $key, 'id_record'=> $detail->id, 'table' => $detail->table, 'k_question' => $k_question,
                'id_question' => $question->id, 'question_content' =>$question->content, 'j_title' => $j_title,
                'suggest_answer' => $question->suggest_choose])
                    <?php break;

                    case "tick_circle_true_falses": ?>

                    @include('frontend.student.join-test.temp_tick_circle_true_false',
                    ['key' => $key, 'table' => $detail->table, 'k_question' => $k_question, 'id_question' => $question->id,
                    'question_content' =>$question->content, 'id_record'=> $detail->id])
                    <?php break;
                    case "complete_tables":
                        echo "classify_words!";
                        break;

                    case "table_ticks":?>

                    @include('frontend.student.join-test.listening.temp_table_tick',
                    ['key' => $key, 'table' => $detail->table, 'k_question' => $k_question, 'id_question' => $question->id,
                    'question_content' =>$question->content, 'id_record'=> $detail->id])
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
