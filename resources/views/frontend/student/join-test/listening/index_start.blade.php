<div class="row wrap-test-class" id="title-level-testing">
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
//dd($list_question);
                    $k_question = 1;
                    ?>
                    <?php
                    switch ($detail->table) {
                    case "complete_tables":
                        echo "classify_words!";
                        break;

                    case "listen_table_ticks": ?>
                    <div class="audio_listen" style="margin-top: 10px; margin-bottom: 15px;">
                        <audio controls>
                            <source src="/{{$detail->url}}" type="audio/mpeg">
                        </audio>
                    </div>
                    @include('frontend.student.join-test.listening.temp_table_tick',
                    ['key' => $key, 'table' => $detail->table, 'number_title' =>$j_title,
                    'suggest_choose' =>$list_question->suggest_choose, 'id_record'=> $detail->id])
                    <?php break;

                    case "table_matchs":
                        echo "classify_words!";
                        break;

                    case "listen_complete_sentences": ?>
                    <div class="audio_listen" style="margin-top: 10px; margin-bottom: 15px;">
                        <audio controls>
                            <source src="/{{$detail->url}}" type="audio/mpeg">
                        </audio>
                    </div>

                    @foreach($list_question as $question)

                        @include('frontend.student.join-test.listening.temp_complete_sentences',
                        ['key' => $key, 'table' => $detail->table, 'number_title' =>$j_title,
                        'k_question' => $k_question, 'id_question' => $question->id,
                        'question_content' =>$question->content, 'id_record'=> $detail->id])

                        <?php $k_question++; ?>
                    @endforeach
                    <?php break;

                    case "listen_ticks": ?>

                    @foreach($list_question as $question)


                        @include('frontend.student.join-test.listening.temp_listen_tick',
                        ['key' => $key, 'table' => $detail->table, 'number_title' =>$j_title,
                        'k_question' => $k_question, 'id_question' => $question->id,
                        'question_content' =>$question->content, 'id_record'=> $detail->id])

                        <div class="audio_listen" style="margin-top: 10px; margin-bottom: 15px;">
                            <audio controls>
                                <source src="/{{$question->url_audio}}" type="audio/mpeg">
                            </audio>
                            <div id="show_result_{{$detail->table}}_{{$detail->id}}_{{$question->id}}" ></div>
                        </div>

                        <?php $k_question++; ?>

                    @endforeach

                    <?php break;

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
                    {{--@endforeach--}}
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

