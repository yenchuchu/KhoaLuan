<div class="row wrap_question_details">
    <div class="col-lg-8" style="padding-left: 0px;">
        <span class="content_question"><span class="huge-number">{{$k_question}}.</span> {{$question_content}}</span>
    </div>

    <div class="col-lg-4 question-checkbox">

        @if(isset($detail->old_answer) && $detail->old_answer[$id_question]['id_question'] == $id_question)

            @if($detail->old_answer[$id_question]['answer_student'] == 'T')

                <label class="checkbox-inline">
                    <input type="radio" name="your_answer_[{{$table}}][{{$id_record}}][{{$id_question}}][]"
                           id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_true" number_title="{{$j_title}}"
                           skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                           name_table="{{$table}}" value="T" checked>True
                </label>
                <label class="checkbox-inline">
                    <input type="radio" name="your_answer_[{{$table}}][{{$id_record}}][{{$id_question}}][]"
                           id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_false" number_title="{{$j_title}}"
                           skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                           name_table="{{$table}}" value="F">False
                </label>
            @elseif($detail->old_answer[$id_question]['answer_student'] == 'F')

                <label class="checkbox-inline">
                    <input type="radio" name="your_answer_[{{$table}}][{{$id_record}}][{{$id_question}}][]"
                           id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_true" number_title="{{$j_title}}"
                           skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                           name_table="{{$table}}" value="T">True
                </label>
                <label class="checkbox-inline">
                    <input type="radio" name="your_answer_[{{$table}}][{{$id_record}}][{{$id_question}}][]"
                           id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_false" number_title="{{$j_title}}"
                           skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                           name_table="{{$table}}" value="F" checked>False
                </label>
            @else
                <label class="checkbox-inline">
                    <input type="radio" name="your_answer_[{{$table}}][{{$id_record}}][{{$id_question}}][]"
                           id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_true" number_title="{{$j_title}}"
                           skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                           name_table="{{$table}}" value="T">True
                </label>
                <label class="checkbox-inline">
                    <input type="radio" name="your_answer_[{{$table}}][{{$id_record}}][{{$id_question}}][]"
                           id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_false" number_title="{{$j_title}}"
                           skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                           name_table="{{$table}}" value="F">False
                </label>
            @endif
        @else
            <label class="checkbox-inline">
                <input type="radio" name="your_answer_[{{$table}}][{{$id_record}}][{{$id_question}}][]"
                       id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_true" number_title="{{$j_title}}"
                       skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                       name_table="{{$table}}" value="T">True
            </label>
            <label class="checkbox-inline">
                <input type="radio" name="your_answer_[{{$table}}][{{$id_record}}][{{$id_question}}][]"
                       id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_false" number_title="{{$j_title}}"
                       skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                       name_table="{{$table}}" value="F">False
            </label>
        @endif
    </div>
</div>