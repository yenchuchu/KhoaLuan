<div class="row" id="wrap_add_listen_table_match">
    <div class="col-lg-12 col_add_listen_table_match">

        {{--{{dd($record)}}--}}
        <!-- Advanced Tables -->
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="table-responsive" id="wrap-content-exam-{{$key_idx}}">

                    <div class="col-lg-12" style="padding-left: 0; padding-right: 0px">
                        <div class="form-group">
                            <input type="text" name="listen_table_matchs[{{$key_idx}}][title-listen-table-match]"
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
                        {{ Form::file('listen_table_matchs['.$key_idx.'][url_audio]', array()) }}
                    </div>

                    <div class="form-group" style="width:100%; float:left;">

                        <div class="span-choose-listen-table-tick">

                            <?php
                            $content_json = json_decode($record->content_json);
                            ?>

                            @foreach($content_json as $order_content => $content_details)
                                <?php

                                    $decode_answer = $content_details->answer;
                                    $array_answer = [];
                                    foreach ($decode_answer as $key_ans => $val_ans) {
                                        $array_answer[$key_ans] = $val_ans;
                                    }

                                    $decode_left = $content_details->content->left;

                                    $array_left = [];
                                    foreach ($decode_left as $key => $val_left) {
                                        $array_left[$key] = $val_left;
                                    }

                                    $total_row = count($array_left); // đếm số cột phải nối

                                    $decode_right = $content_details->content->right;
                                    $array_right = [];
                                    $array_key_right = [];
                                    $ind_right = 1;
                                    foreach ($decode_right as $key => $val_right) {
                                        $array_right[$key] = $val_right;
                                        $array_key_right[$ind_right] = $key;
                                        $ind_right++;
                                    }
                                ?>
                                    <table id="listen_table_matchs_{{$order_content}}" class="table-match table table-bordered">
                                        @for($i = 1; $i <= $total_row; $i++)
                                            <tr>
                                                <td width="50%">
                                                    <label>{{$i}} </label>
                                                    <input type="text" placeholder="{{trans('label.backend.create.suggest_answer')}}"
                                                           name="listen_table_matchs[{{$key_idx}}][content-choose-ans-question][left][{{$i}}]"
                                                           value="{{$array_left[$i]}}" required>

                                                    <div class="col-sm-3" style="padding-left: 0px; float:right;">
                                                        <label>Đáp án </label>
                                                        <input type="text" maxlength="1" style="text-transform:uppercase" value="{{$array_answer[$i]}}"
                                                               name="listen_table_matchs[{{$key_idx}}][answer][{{$i}}]">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label>{{$array_key_right[$i]}} </label>
                                                    <input type="text" value="{{$array_right[$array_key_right[$i]]}}"
                                                           name="listen_table_matchs[{{$key_idx}}][content-choose-ans-question][right][{{$alphab_order[$i]}}]" required>
                                                </td>
                                            </tr>
                                        @endfor
                                    </table>
                            @endforeach


                        </div>
                    </div>

                </div>

            </div>

            <div class="form-group">
                    <span id="add_item_question_{{$key_idx}}" item_this="{{$total_row}}" item="{{$key_idx}}"
                          class="add-question" onclick="add_item_question_LTM(this.id, 'listen_table_matchs_{{$key_idx}}')"
                          title="Add">+</span>
            </div>

        </div>
    </div>
    <!--End Advanced Tables -->
</div>
