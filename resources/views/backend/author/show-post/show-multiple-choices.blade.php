<div class="row" id="wrap_add_multiple_choice">
    <div class="col-lg-12 col_add_multiple_choice">

        <!-- Advanced Tables -->
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="table-responsive" id="wrap-content-exam-{{$key_idx}}">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group">
                            <input type="text" name="multiple_choice[{{$key_idx}}][title-multiple-choice]"
                                    value="{{$record->title}}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group" style="width:100%; float:left;">

                        <?php
                        $content_json = json_decode($record->content_json);
                        ?>
                        @foreach($content_json as $item_this => $sug)

                            <div class="span-numb-question" id="id-numb-question-{{$item_this}}">
                                {{$item_this}}
                                <input type="hidden" value="{{$sug->id}}"
                                       name="multiple_choice[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][id]">
                            </div>
                            <div class="form-group" style="width:98%; float:left;">
                                <div class="span-text-question">
                                    <textarea type="text" class="form-control"
                                              name="multiple_choice[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][content]"
                                              placeholder="enter content" required>{{$sug->content}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 div-wrap-option-answers">
                                <?php $i_s = 1; ?>
                                @foreach($sug->suggest_choose as $key_choose => $value_choose)

                                    <div class="col-lg-4 option-as-details">
                                        <input type="radio" value="{{$key_choose}}"
                                               <?php if (strcmp($value_choose, $sug->answer) == 0) { echo 'checked'; } ?>
                                               name="multiple_choice[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][answer]">
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="enter answer"
                                                   index="{{$i_s}}" value="{{$value_choose}}"
                                                   name="multiple_choice[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][suggest_choose][{{$key_choose}}]">
                                        </div>
                                    </div>
                                    <?php  $i_s++;?>
                                @endforeach

                            </div>
                        @endforeach

                    </div>

                </div>

                <div class="form-group">
                        <span id="add_item_question_{{$key_idx}}" item_this="{{count((array)$content_json)}}"
                              item="{{$key_idx}}"
                              class="add-question" onclick="add_item_question_MT(this.id)" title="Add">+</span>
                </div>

            </div>
        </div>
        <!--End Advanced Tables -->
    </div>

</div>