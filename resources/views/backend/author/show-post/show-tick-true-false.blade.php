<div class="row" id="wrap_add_tick_true_false">
    <div class="col-lg-12 col_add_tick_true_false">

        <!-- Advanced Tables -->
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="table-responsive" id="wrap-content-exam-{{$key_idx}}">

                    <div class="col-lg-12" style="padding-left: 0; padding-right: 0px">
                        <div class="form-group">
                            <input type="text" name="tick_true_false[{{$key_idx}}][title-tick-true-false]"
                                   class="form-control" required value="{{$record->title}}">
                        </div>
                    </div>

                    <div class="form-group">
                                <textarea type="text" class="form-control"
                                          name="tick_true_false[{{$key_idx}}][content-tick-true-false]"
                                          placeholder="enter content" required>{{$record->content}}</textarea>
                    </div>

                    <div class="form-group" style="width:100%; float:left;">
                        <?php
                        $content_json = json_decode($record->content_json);
                        ?>
                        @foreach($content_json as $item_this => $sug)
                            <div style="float:left; width: 100%;">

                                <div class="span-numb-question" style="float:left; width: 2%;"
                                 id="id-numb-question-{{$item_this}}">
                                {{$item_this}}
                                <input type="hidden"
                                       name="tick_true_false[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][id]"
                                       value="{{$sug->id}}">
                            </div>
                            <div class="span-text-question" style="width: 68%; float: left; margin-bottom: 10px;">
                                    <textarea type="text" class="form-control"
                                              name="tick_true_false[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][content]"
                                              placeholder="enter content" required>{{$sug->content}}</textarea>
                            </div>
                            <div class="span-choose-tick-true-false" style="float:left; width: 30%; text-align: center">
                                <span style="float: left; width: 50%;">
                                    <input type="radio" id="check-answer_{{$key_idx}}_{{$item_this}}_T"
                                           name="tick_true_false[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][answer]"
                                           value="T" <?php if($sug->answer == 'T') { echo ' checked ' ; } ?>
                                           class="ans-true">
                                    <label for="check-answer_{{$key_idx}}_{{$item_this}}_T" style="cursor: pointer">T</label>
                                </span>
                                <span>
                                     <input type="radio" id="check-answer_{{$key_idx}}_{{$item_this}}_F"
                                            name="tick_true_false[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][answer]"
                                            value="F" <?php if($sug->answer == 'F') { echo ' checked ' ; } ?>
                                            class="ans-false">
                                    <label for="check-answer_{{$key_idx}}_{{$item_this}}_F" style="cursor: pointer">F</label>
                                </span>
                            </div>
                            </div>
                        @endforeach

                    </div>

                </div>

                <div class="form-group">
                        <span id="add_item_question_{{$key_idx}}" item_this="{{count((array)$content_json)}}" item="{{$key_idx}}"
                              class="add-question" onclick="add_item_question_TF(this.id)" title="Add">+</span>
                </div>

            </div>
        </div>
        <!--End Advanced Tables -->
    </div>

</div>