<div class="row">
        <div class="col-lg-3">
            <div class="form-group">

                <select name="level_id" class="form-control" id="add-answer-question-level">
                    @foreach($levels as $level)
                        <option value="{{$level->id}}">{{$level->title}} - {{$level->point}}  </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">

                <select name="class_id" class="form-control" id="answer-question-class">
                    @foreach($classes as $class)
                        <option value="{{$class->id}}">{{$class->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

    {{--<input type="hidden" value="{{$code_user}}" name="code_user">--}}
    {{--<input type="hidden" value="{{$class_code}}" name="class_code">--}}
</div>
<div class="row" id="wrap_add_answer_question">
    <div class="col-lg-12 col_add_answer_question">

        <!-- Advanced Tables -->
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="table-responsive" id="wrap-content-exam-1">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group">
                            <input type="text" name="answer_question[1][title-answer-question]"
                                   class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                                <textarea type="text" class="form-control"
                                          name="answer_question[1][content-answer-question]"
                                          placeholder="enter content" required></textarea>
                    </div>
                    <div class="form-group" style="width:100%; float:left;">
                        <div class="span-numb-question" id="id-numb-question-1">
                            1
                            <input type="hidden" name="answer_question[1][content-choose-ans-question][1][id]" value="1">
                        </div>
                        <div class="form-group" style="width:98%; float:left;">
                            <div class="span-text-question">
                                    <textarea type="text" class="form-control"
                                              name="answer_question[1][content-choose-ans-question][1][content]"
                                              placeholder="enter content" required></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12" style="padding-left: 0;margin-left: 17px;width: 100%">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="enter answer"
                                       name="answer_question[1][content-choose-ans-question][1][answer]">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="form-group">
                    <span id="add_item_question_1" item_this="1" item="1"
                          class="add-question" onclick="add_item_question_AQ(this.id)" title="Add">+</span>
            </div>

        </div>
    </div>
    <!--End Advanced Tables -->
</div>