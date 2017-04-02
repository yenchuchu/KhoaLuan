@extends ('layouts.init-pdf')
@section('style')
    <link href="{{URL::asset('backend/assets/plugins/bootstrap/bootstrap.css')}}" rel="stylesheet" />
    <style>

        #wrap-content {
            padding-left: 0px;
            padding-right: 0px;
            font-size: 15px;
            font-weight: 700;
        }

        .content {
            font-size: 15px;
            font-weight: 500;
        }

        .suggest_asnwer_questions {
            margin-top: 8px;
        }

        .title {
            margin-bottom: 5px;
        }

    </style>
@stop

@section('content')

    <div class="row" style="padding-left: 15px; padding-right: 15px;">
        <div class="col-xs-12">
            <h4><strong>Skill: {{$code_skill}}</strong></h4>
        </div>
        <div class="col-xs-12">
            <div class="panel-body" id="wrap-content">
                <?php $order = 1; ?>
                @foreach($record_model as $key => $exams)
                       <div class="title">{{$lamas[$order]}}. {{$exams->title}}</div>

                            <?php
                            switch ($key) {
                            case "answer_questions": ?>

                            @include('frontend.teachers.elementary.temp_type_question.answer_questions',
                            ['contents_exam' => $exams->content, 'content_json' => $exams->content_json])
                            <?php  break;

                            case "complete_words": ?>
                            @include('frontend.teachers.elementary.temp_type_question.complete_words',
                            ['contents' => $exams->content, 'content_json' => $exams->content_json])
                            <?php  break;

                            case "find_errors": ?>

                            @include('frontend.teachers.elementary.temp_type_question.find_errors',
                            ['content_json' => $exams->content_json])
                            <?php  break;

                            case "multiple_choices": ?>

                            @include('frontend.teachers.elementary.temp_type_question.multiple_choices',
                            ['content_json' => $exams->content_json])
                            <?php break;

                            case "tick_circle_true_falses": ?>

                            @include('frontend.teachers.elementary.temp_type_question.tick_circle_true_falses',
                            ['contents' => $exams->content, 'content_json' => $exams->content_json])
                            <?php break;
                            case "complete_tables":
                                echo "classify_words!";
                                break;

                            case "table_ticks":
                                echo "classify_words!";
                                break;

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

                    <?php $order++; ?>
                @endforeach
            </div>
        </div>

    </div>

@stop

@section('script')
    <script>

    </script>
@stop