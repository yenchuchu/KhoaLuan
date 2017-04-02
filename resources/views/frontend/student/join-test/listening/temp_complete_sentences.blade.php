<div class="row wrap_question_details" style="margin-bottom: 0px">
    <div class="col-lg-12" style="padding-left: 0px;margin-bottom: 7px;">
        <?php
//            dd($detail->old_answer);
        if (isset($detail->old_answer) && $detail->old_answer[$id_question]['id_question'] == $id_question) {
            $input_replace = '<input type="text" name="your_answer_['.$table.']['.$id_record.']['.$id_question.'][]"
                               id="your_answer_'.$table.'_'.$id_record.'_'.$id_question.'"
                               number_title="'.$j_title.'"
                               skill_name="'.$key.'" id_record="'.$id_record.'" id_question="'.$id_question.'"
                               name_table="'.$table.'" value="'.$detail->old_answer[$id_question]['answer_student'].'"
                               style="width: 7%; border: none; border-bottom: 1px solid gray; margin-left: 7px; color: gray;">';
        } else {
            $input_replace = '<input type="text" name="your_answer_['.$table.']['.$id_record.']['.$id_question.'][]"
                               id="your_answer_'.$table.'_'.$id_record.'_'.$id_question.'"
                               number_title="'.$j_title.'"
                               skill_name="'.$key.'" id_record="'.$id_record.'" id_question="'.$id_question.'"
                               name_table="'.$table.'"
                               style="width: 7%; border: none; border-bottom: 1px solid gray; margin-left: 7px; color: gray;">';
        }
        ?>
        <span class="content_question">
            <span class="huge-number">
                {{$k_question}}. <?php echo str_replace('___', $input_replace, $question_content); ?>
            </span>
        </span>
    </div>
    <div class="col-lg-3" style="text-align: left;"
         id="student_{{$table}}_{{$id_record}}_{{$id_question}}_answer">
    </div>
</div>