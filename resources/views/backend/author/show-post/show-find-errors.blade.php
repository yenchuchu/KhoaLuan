<div class="row" id="wrap_add_find_errors">
    <div class="col-lg-12 col_add_find_errors">

        <!-- Advanced Tables -->
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="table-responsive" id="wrap-content-exam-{{$key_idx}}">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group">
                            <input type="text" name="find_errors[{{$key_idx}}][title-find-errors]"
                                   class="form-control" placeholder="enter topic content" required  value="{{$record->title}}">
                        </div>
                    </div>

                    <div class="form-group" style="width:100%; float:left;">

                        <?php
                        $content_json = json_decode($record->content_json);
                        ?>

                        @foreach($content_json as $item_this => $sug)
                            <div class="span-numb-question" id="id-numb-question-1">
                                {{$item_this}}
                                <input type="hidden"
                                       name="find_errors[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][id]"
                                       value="{{$sug->id}}">
                            </div>
                            <div class="form-group" style="width:98%; float:left;">
                                <div class="span-text-question">
                                    <textarea type="text" class="form-control"
                                              name="find_errors[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][content]"
                                              placeholder="This <u>is</u> a <u>example</u> for <u>this</u> question format"
                                              required> {{$sug->content}} </textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 div-wrap-option-answers">
                                <div class="col-lg-8 option-as-details">
                                    <label class="col-lg-2" style="padding-right: 0px;"
                                           for="find_errors_{{$key_idx}}_answer_{{$item_this}}">Answer: </label>
                                    <div class="form-group col-lg-10"
                                         style="width: 43%;padding-left: 0; margin-left: 0">
                                        <input type="text" class="form-control" placeholder="enter answer" index="1"
                                               name="find_errors[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][answer]"
                                               id="find_errors_{{$key_idx}}_answer_{{$item_this}}" value="{{$sug->answer}}">
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

                <div class="form-group">
                        <span id="add_item_question_{{$key_idx}}" item_this="{{count((array)$content_json)}}" item="{{$key_idx}}"
                              class="add-question" onclick="add_item_question_find_error(this.id)" title="Add">+</span>
                </div>

            </div>
        </div>
        <!--End Advanced Tables -->
    </div>

</div>