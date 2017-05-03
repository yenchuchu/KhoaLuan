<div class="row" id="wrap_add_listen_ticks">
    <div class="col-lg-12 col_add_listen_ticks">

        <!-- Advanced Tables -->
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="table-responsive" id="wrap-content-exam-{{$key_idx}}">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group">
                            <input type="text" name="listen_ticks[{{$key_idx}}][title-listen-ticks]"
                                   class="form-control" placeholder="Cập nhật đề bài" required value="{{$record->title}}">
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
                                       name="listen_ticks[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][id]">
                            </div>

                            <div class="audio_listen form-group" style="margin-top: 10px; margin-bottom: 15px;">
                                <label class="admin-lable-audio">Audio: </label>
                                <audio controls>
                                    <source src="/{{$sug->url_audio}}" type="audio/mpeg">
                                </audio>
                            </div>
                            <div class="form-group">
                                <label>{{trans('label.backend.post_details.change-audio')}}: </label>
                                {{ Form::file('listen_ticks['.$key_idx.'][content-choose-ans-question]['.$item_this.'][url_audio]', array()) }}
                            </div>

                            <div class="span-choose-listen-tick">
                                @foreach($sug->content as $key_cont => $cont)
                                    <span class="img-listen-tick">
                                    <input type="radio" id="check-answer_{{$key_idx}}_{{$item_this}}_{{$key_cont}}" required
                                           name="listen_ticks[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][answer]"
                                           value="{{$key_cont}}"
                                           class="ans-true" <?php if($sug->answer == $key_cont) { echo ' checked '; } ?> >
                                    <label for="check-answer_{{$key_idx}}_{{$item_this}}_{{$key_cont}}" style="cursor: pointer">
                                        <img src="/{{$cont}}" style="height: 180px;"
                                             id="change_uploadListenImgOne_{{$key_idx}}_{{$item_this}}_{{$key_cont}}"
                                             alt="image suggest">
                                    </label>

                                    <input type="file" id="uploadListenImgOne_{{$key_idx}}_{{$item_this}}_{{$key_cont}}"
                                           onclick="choose_img_upload(this.id)"
                                           name="listen_ticks[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][content][{{$key_cont}}]"
                                            style="margin-left: 17px; margin-top: 10px;">
                                </span>
                                @endforeach

                            </div>
                        @endforeach

                    </div>

                </div>

            </div>
            @if($status == 0)
            <div class="form-group">
                    <span id="add_item_question_{{$key_idx}}" item_this="{{count((array)$content_json)}}"
                          item="{{$key_idx}}"
                          class="add-question" onclick="add_item_question_LT(this.id)" title="Add">+</span>
            </div>
@endif
        </div>
    </div>
    <!--End Advanced Tables -->
</div>
