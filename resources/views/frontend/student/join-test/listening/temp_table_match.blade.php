<div class="row wrap_question_details" style="margin-bottom: 0px">
    <div class="col-lg-12" style="padding-left: 0px;margin-bottom: 7px;">

        <?php
            $decode_left = $question_content->left;

            $array_left = [];
            foreach ($decode_left as $key => $val_left) {
                $array_left[$key] = $val_left;
            }

            $total_row = count($array_left); // đếm số cột phải nối

            $decode_right = $question_content->right;
                $array_right = [];
                $array_key_right = [];
                $ind_right = 1;
                foreach ($decode_right as $key => $val_right) {
                    $array_right[$key] = $val_right;
                    $array_key_right[$ind_right] = $key;
                    $ind_right++;
                }
        ?>

        <table class="table table-bordered">
            @for($i = 1; $i <= $total_row; $i++)
                <tr>
                    <td><span>{{$i}}. </span>{{$array_left[$i]}}</td>
                    <td><span>{{$array_key_right[$i]}}. </span> {{$array_right[$array_key_right[$i]]}}</td>
                </tr>
            @endfor
        </table>

        <p>Your answer: </p>
        <div class="row">
            @if (isset($detail->old_answer))
                @foreach($detail->old_answer as $key_left => $val_right)
                    <div class="form-group col-md-2">

                        <label class="col-sm-3 control-label" style="padding-right: 0px; position: relative; top: 7px;"
                               for="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_{{$key}}_right_{{$key_left}}">{{$key_left}} - </label>
                        <div class="col-sm-8" style="padding-left: 0px">
                            <select id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_{{$key}}_right_{{$key_left}}"
                                    skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                                    name_table="{{$table}}" order_left="{{$key_left}}" left="{{$key_left}}" number_title="{{$j_title}}" class="form-control">
                                @for($i_right = 1; $i_right <= $total_row; $i_right++)
                                    <option <?php if( $val_right['answer_student'] == $array_key_right[$i_right]) { echo 'selected="selected"';} ?> >
                                        {{$array_key_right[$i_right]}}</option>
                                @endfor

    {{--                            <option>{{$val_right['answer_student']}}</option>--}}
                            </select>
                        </div>
                    </div>

                @endforeach

            @else
                @for($i = 1; $i <= $total_row; $i++)
                    <div class="form-group col-md-2">
                        <label class="col-sm-3 control-label" style="padding-right: 0px; position: relative; top: 7px;"
                               for="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_{{$key}}_right_{{$i}}">{{$i}} - </label>
                        <div class="col-sm-8" style="padding-left: 0px">
                                <select id="your_answer_{{$table}}_{{$id_record}}_{{$id_question}}_{{$key}}_right_{{$i}}"
                                    skill_name="{{$key}}" id_record="{{$id_record}}" id_question="{{$id_question}}"
                                    name_table="{{$table}}" order_left="{{$i}}" left="{{$i}}" number_title="{{$j_title}}" class="form-control">
                                @for($i_right = 1; $i_right <= $total_row; $i_right++)
                                    <option>{{$array_key_right[$i_right]}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                @endfor
            @endif
        </div>

        {{--
        $i: số thứ tự trong left.
        $array_key_right[$i_right]: thứ tự A, B, C ... trong right.

        --}}

    </div>
    <div class="row" id="show-result-table-match">
        <p id="title-show-result-table-match" style="padding-left: 15px;"></p>

    </div>
</div>