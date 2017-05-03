
<div class="row" id="wrap_add_answer_question">
    <div class="col-lg-12 col_add_answer_question">

        <!-- Advanced Tables -->
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="table-responsive" id="wrap-content-exam-{{$key_idx}}">

                    <div class="col-lg-12" style="padding-left: 0; padding: 0px">
                        <div class="form-group">
                            <input type="text" name="answer_question[{{$key_idx}}][title-answer-question]"
                                   class="form-control" required value="{{$record->title}}">
                        </div>
                    </div>

                    <div class="form-group">
                                <textarea type="text" class="form-control"
                                          name="answer_question[{{$key_idx}}][content-answer-question]"
                                          placeholder="enter content" required>{{$record->content}}</textarea>
                    </div>
                    <div class="form-group" style="width:100%; float:left;">

                        <?php
                        $content_json = json_decode($record->content_json);
                        ?>

                            @foreach($content_json as $item_this => $sug)
                                <div class="span-numb-question" id="id-numb-question-{{$key_idx}}"  style="width: 2%; float:left;">
                                    {{$item_this}}
                                    <input name="answer_question[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][id]"
                                           type="hidden" value="{{$sug->id}}">
                                </div>
                                <div class="form-group" style="width:98%; float:left;">
                                    <div class="span-text-question">
                                    <textarea type="text" class="form-control"
                                              name="answer_question[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][content]"
                                              placeholder="enter content" required>{{$sug->content}}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12" style="padding-left: 0;margin-left: 17px;width: 100%">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="enter answer" value="{{$sug->answer}}"
                                               name="answer_question[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][answer]">
                                    </div>
                                </div>
                            @endforeach

                    </div>

                </div>

            </div>
        @if($status == 0)
            <div class="form-group">
                    <span id="add_item_question_{{$key_idx}}" item_this="{{count((array)$content_json)}}" item="{{$key_idx}}"
                          class="add-question" onclick="add_item_question_AQ(this.id)" title="Add">+</span>
            </div>
        @endif
        </div>
    </div>
    <!--End Advanced Tables -->
</div>