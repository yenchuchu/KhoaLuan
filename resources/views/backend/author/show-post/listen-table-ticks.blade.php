<div class="row" id="wrap_add_listen_table_ticks">
    <div class="col-lg-12 col_add_listen_table_ticks">

        <!-- Advanced Tables -->
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="table-responsive" id="wrap-content-exam-{{$key_idx}}">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group">
                            <input type="text" name="listen_table_ticks[{{$key_idx}}][title-listen-table-ticks]"
                                   class="form-control" placeholder="Cập nhật đề bài" required
                                   value="{{$record->title}}">
                        </div>
                    </div>

                    <div class="audio_listen form-group" style="margin-top: 10px; margin-bottom: 15px;">
                       <label class="admin-lable-audio">Audio: </label>
                        <audio controls>
                            <source src="/{{$record->url}}" type="audio/mpeg">
                        </audio>
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.backend.post_details.change-audio')}}:</label>
                        {{ Form::file('listen_table_ticks['.$key_idx.'][url_audio]', array()) }}
                    </div>

                    <div class="form-group" style="width:100%; float:left;">

                        <div class="span-choose-listen-table-tick">

                            <?php
                            $content_json = json_decode($record->content_json);
                            $suggest_choose = $content_json->suggest_choose;
                            $answer = $content_json->answer;
                            ?>
                            <table id="listen_table_ticks_{{$key_idx}}" class="table table-bordered">
                                @foreach($suggest_choose as $item_this => $sug)
                                    <tr>
                                        <td>
                                            <input type="text" value="{{$sug}}" class="form-control"
                                                   name="listen_table_ticks[{{$key_idx}}][content-choose-ans-question][{{$item_this+1}}][suggest]">
                                        </td>
                                        <td>
                                            @if(in_array($sug, $answer))
                                                <input type="checkbox" checked
                                                       name="listen_table_ticks[{{$key_idx}}][content-choose-ans-question][{{$item_this+1}}][answer]">
                                            @else
                                                <input type="checkbox"
                                                       name="listen_table_ticks[{{$key_idx}}][content-choose-ans-question][{{$item_this+1}}][answer]">
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                        </div>
                    </div>

                </div>

            </div>

            <div class="form-group">
                    <span id="add_item_question_{{$key_idx}}" item_this="{{count($suggest_choose)}}" item="{{$key_idx}}"
                          class="add-question" onclick="add_item_question_LTT(this.id, 'listen_table_ticks_{{$key_idx}}')"
                          title="Add">+</span>
            </div>

        </div>
    </div>
    <!--End Advanced Tables -->
</div>
