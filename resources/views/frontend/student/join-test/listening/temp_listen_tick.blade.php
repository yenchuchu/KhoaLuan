<div class="row wrap_question_details" style="margin-bottom: 0px">
    <div class="col-lg-12" style="padding-left: 0px;margin-bottom: 7px;">

        <div class="col-lg-2">
            {{$k_question}}.
        </div>

        @if (isset($detail->old_answer) && $detail->old_answer[$id_question]['id_question'] == $id_question)
            @foreach($question_content as $key => $qts)
                <div class="col-lg-5">
                    <div class="img-question">
                        <img src="/{{$qts}}" alt="">
                    </div>
                    <div>
                        <label class="checkbox-inline">
                            <input type="radio" name="your_answer_[{{$table}}][{{$id_record}}][{{$id_question}}][]"
                                   id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_{{$key}}" number_title="{{$j_title}}"
                                   skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                                   name_table="{{$table}}" value="{{$key}}"
                            <?php if($detail->old_answer[$id_question]['answer_student'] == $key) { echo "checked"; } ?>
                            >{{$key}}
                        </label>
                    </div>
                </div>
            @endforeach
        @else
            @foreach($question_content as $key => $qts)
                <div class="col-lg-5">
                    <div class="img-question">
                        <img src="/{{$qts}}" alt="">
                    </div>
                    <div>
                        <label class="checkbox-inline">
                            <input type="radio" name="your_answer_[{{$table}}][{{$id_record}}][{{$id_question}}][]"
                                   id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_{{$key}}" number_title="{{$j_title}}"
                                   skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                                   name_table="{{$table}}" value="{{$key}}">{{$key}}
                        </label>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
    <div class="col-lg-3" style="text-align: left;"
         id="student_{{$table}}_{{$id_record}}_{{$id_question}}_answer">
    </div>
</div>