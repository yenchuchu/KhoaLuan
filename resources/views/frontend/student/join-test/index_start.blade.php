<div class="row wrap-test-class" id="title-level-testing">
    <h3>Testing {{$skill_code}}</h3>
    <input type="hidden" id="level-tesing-hidden" value="{{$get_next_level}}">
    <input type="hidden" id="skill-code-tesing-hidden" value="{{$skill_code}}">
</div>

<div class="row wrap-test-class" id="testing-id">

    <?php $i_skill = 1;
    $j_title = 1;
    ?>
    @foreach($items as $key => $item)

{{--        <h4>{{$i_skill}}. {{$key}}</h4>--}}
        @foreach($item as $key_item => $detail)
            @if(!empty($detail))

                <div class="col-lg-12 space-exam">
                    <div class="title-common">{{$lamas[$j_title]}}. {{$detail->title}}</div>
                    @if(isset($detail->content))
                        <article> {{$detail->content}} </article>
                    @endif
                    <?php $list_question = json_decode($detail->content_json);
                    $k_question = 1;

                    ?>
                    @foreach($list_question as $question)
                        <?php
                        switch ($detail->table) {
                        case "answer_questions": ?>

                        @include('frontend.student.join-test.temp_answer_question',
                        ['key' => $key, 'j_title' => $j_title, 'k_question' => $k_question, 'id_question' => $question->id,
                        'question_content' =>$question->content, 'id_record'=> $detail->id, 'table' => $detail->table])
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

//                        case "underlines":
//                            echo "underlines!";
//                            break;

//                            case "classify_words":
//                                echo "classify_words!";
//                                break;

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
//
//                                '' => 'Complete Table',
//            '' => 'Table Tick',
//            '' => 'Table Matchs',
//            '' => 'Complete Sentences',
//            '' => 'Listen and Tick',
//            '' => 'Tick Cross',
//            '' => 'Listen And Fill In One Number',

                        default:
                            echo "Your favorite color is neither red, blue, nor green!";
                        }
                        ?>

                        <?php $k_question++; ?>
                    @endforeach
                </div>
                <?php $j_title++; ?>
            @endif
        @endforeach


        <?php $i_skill++; ?>
        {{--@endif--}}
    @endforeach

    <div class="col-lg-offset-10 col-lg-2">
        <button type="submit" title="Submit" id="btn-submit-test" class="btn btn-success btn-submit-test">Submit
        </button>
    </div>

</div>

