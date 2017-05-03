<div class="row" id="wrap_add_listen_complete_sentences">
    <div class="col-lg-12 col_add_listen_complete_sentences">

        <!-- Advanced Tables -->
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="table-responsive" id="wrap-content-exam-{{$key_idx}}">

                    <div class="col-lg-12" style="padding-left: 0; padding-right: 0px">
                        <div class="form-group">
                            <input type="text" name="listen_complete_sentences[{{$key_idx}}][title-listen-complete-sentences]"
                                   class="form-control" required value="{{$record->title}}" placeholder="Nhập đề bài">
                        </div>
                    </div>

                    <div class="audio_listen form-group" style="margin-top: 10px; margin-bottom: 15px;">
                        <label class="admin-lable-audio">Audio: </label>
                        <audio controls>
                            <source src="/{{$record->url}}" type="audio/mpeg">
                        </audio>
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.backend.post_details.change-audio')}}: </label>
                        {{ Form::file('listen_complete_sentences['.$key_idx.'][audio]', array()) }}
                    </div>

                    <div class="form-group" style="width:100%; float:left;">
                        <?php
                        $content_json = json_decode($record->content_json);
                        ?>

                        @foreach($content_json as $item_this => $sug)
                            <div style="float:left; width: 100%;">
                                <div class="span-numb-question" id="id-numb-question-{{$item_this}}" style="float:left; width: 2%;">
                                    {{$item_this}}
                                    <input type="hidden" value="{{$sug->id}}"
                                           name="listen_complete_sentences[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][id]" >
                                </div>
                                <div class="form-group" style="width:98%; float:left;">
                                    <div class="span-text-question">
                                    <textarea type="text" class="form-control"
                                              name="listen_complete_sentences[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][content]"
                                              placeholder="this is ___ a kind. there are three character _" required>{{$sug->content}}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12" style="padding-left: 0;margin-left: 17px;width: 100%">
                                    <label style="width: 6%; float:left;">Answer: </label>
                                    <div class="form-group" style="width: 94%; float: left;">
                                        <input type="text" class="form-control" placeholder="Nhập đáp án" value="{{$sug->answer}}"
                                               name="listen_complete_sentences[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][answer]">
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>
            @if($status == 0)
            <div class="form-group">
                    <span id="add_item_question_{{$key_idx}}" item_this="{{count((array)$content_json)}}" item="{{$key_idx}}"
                          class="add-question" onclick="add_item_question_LCS(this.id)" title="Add">+</span>
            </div>
            @endif
        </div>
    </div>
    <!--End Advanced Tables -->
</div>