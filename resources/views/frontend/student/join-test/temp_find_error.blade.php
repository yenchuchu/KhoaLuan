<div class="row wrap_question_details" style="margin-bottom: 0px">
    <div class="col-lg-12" style="padding-left: 0px;margin-bottom: 7px;">
        <span class="content_question"><span class="huge-number">{{$k_question}}.</span>
            <?php
            echo strip_tags($question_content, "<u>");
            ?>
        </span>
    </div>
    <div class="col-lg-12 suggest_find_error">
        @foreach($suggest_answer as $suggest)

            <div class="col-lg-3">
                <div class="form-group">

                    @if(isset($detail->old_answer) && $detail->old_answer[$id_question]['id_question'] == $id_question)

                    <label class="checkbox-inline">
                        <input type="radio" name="your_answer_[{{$table}}][{{$id_record}}][{{$id_question}}][]"
                               id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}" number_title="{{$j_title}}"
                               skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                               name_table="{{$table}}" value="{{$suggest}}"
                               style="margin-right: 10px; position: relative; top: 2px;"
                               <?php if(strcmp($detail->old_answer[$id_question]['answer_student'], $suggest) == 0) echo "checked" ?> >{{$suggest}}
                    </label>
                    @else
                        <label class="checkbox-inline">
                            <input type="radio" name="your_answer_[{{$table}}][{{$id_record}}][{{$id_question}}][]"
                                   id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}" number_title="{{$j_title}}"
                                   skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                                   name_table="{{$table}}" value="{{$suggest}}"
                                   style="margin-right: 10px; position: relative; top: 2px;" >{{$suggest}}
                        </label>
                    @endif
                </div>
            </div>

        @endforeach
        <div class="col-lg-3" style="text-align: left;" id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_answer"> </div>
    </div>

</div>