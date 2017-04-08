<div class="row" id="wrap_add_listen_ticks">
    <div class="col-lg-12 col_add_listen_ticks">

        <!-- Advanced Tables -->
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="table-responsive" id="wrap-content-exam-{{$key_idx}}">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group">
                            <input type="text" name="listen_ticks[{{$key_idx}}][title-listen-ticks]"
                                   class="form-control" placeholder="Cập nhật đề bài" required>
                        </div>
                    </div>
                    {{dd($record)}}
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
                                    <source src="{{URL::asset($record->url)}}" type="audio/mpeg">
                                </audio>
                            </div>
                            <div class="form-group">
                                <label>Change Audio: </label>
                                {{ Form::file('listen_ticks['.$key_idx.'][content-choose-ans-question][{{$item_this}}
                                ][url_audio]', array()) }}
                            </div>

                            <div class="span-choose-listen-tick">
                                <span class="img-listen-tick">
                                    <input type="radio" id="check-answer_{{$key_idx}}_{{$item_this}}_A" required
                                           name="listen_ticks[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][answer]"
                                           value="A"
                                           class="ans-true">
                                    <label for="check-answer_{{$key_idx}}_{{$item_this}}_A" style="cursor: pointer">
                                        <img src="{{URL::asset('imgs-dashboard/avatar.png')}}" style="height: 180px;"
                                             id="change_uploadListenImgOne_{{$key_idx}}_{{$item_this}}_A"
                                             alt="image suggest">
                                    </label>

                                    <input type="file" id="uploadListenImgOne_{{$key_idx}}_{{$item_this}}_A"
                                           onclick="choose_img_upload(this.id)"
                                           name="listen_ticks[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][content][A]"
                                           required style="margin-left: 17px; margin-top: 10px;">
                                </span>
                                <span class="img-listen-tick">
                                     <input type="radio" id="check-answer_{{$key_idx}}_{{$item_this}}_B" required
                                            name="listen_ticks[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][answer]"
                                            value="B"
                                            class="ans-false">
                                    <label for="check-answer_{{$key_idx}}_{{$item_this}}_B" style="cursor: pointer">
                                         <img src="{{URL::asset('imgs-dashboard/avatar.png')}}" style="height: 180px;"
                                              id="change_uploadListenImgOther_{{$key_idx}}_{{$item_this}}_B"
                                              alt="image suggest">
                                    </label>

                                    <input type="file" id="uploadListenImgOther_{{$key_idx}}_{{$item_this}}_B"
                                           onclick="choose_img_upload(this.id)"
                                           name="listen_ticks[{{$key_idx}}][content-choose-ans-question][{{$item_this}}][content][B]"
                                           required style="margin-left: 17px; margin-top: 10px;">
                                </span>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

            <div class="form-group">
                    <span id="add_item_question_{{$key_idx}}" item_this="{{count((array)$content_json)}}"
                          item="{{$key_idx}}"
                          class="add-question" onclick="add_item_question_LT(this.id)" title="Add">+</span>
            </div>

        </div>
    </div>
    <!--End Advanced Tables -->
</div>
