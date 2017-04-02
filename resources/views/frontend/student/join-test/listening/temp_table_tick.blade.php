<div class="row wrap_question_details">
    <div class="col-lg-8 question-checkbox">
        <table class="table table-bordered">
            @foreach($suggest_choose as $idx => $sug)
                <?php
                $replace_sug = str_replace(" ", "_", $sug);
                ?>
                <tr>
                    @if(isset($detail->old_answer))

                        @if (!empty($detail->old_answer[0]['answer_student']) && in_array($sug, $detail->old_answer[0]['answer_student']))
                            <td><label for="your_answer_{{$table}}_{{$id_record}}_{{$replace_sug}}"
                                       id="your_answer_{{$table}}_{{$id_record}}_label_{{$replace_sug}}"
                                       id_record="{{$id_record}}" name_table="{{$table}}"
                                       number_title="{{$number_title}}">{{$sug}}</label></td>
                            <td><input type="checkbox" id="your_answer_{{$table}}_{{$id_record}}_{{$replace_sug}}"
                                       name="your_answer_{{$table}}_{{$id_record}}[]" value="{{$sug}}"
                                       id_record="{{$id_record}}" name_table="{{$table}}"
                                       number_title="{{$number_title}}" checked>
                            </td>
                        @else
                            <td><label for="your_answer_{{$table}}_{{$id_record}}_{{$replace_sug}}"
                                       id="your_answer_{{$table}}_{{$id_record}}_label_{{$replace_sug}}"
                                       id_record="{{$id_record}}" name_table="{{$table}}"
                                       number_title="{{$number_title}}">{{$sug}}</label></td>
                            <td><input type="checkbox" id="your_answer_{{$table}}_{{$id_record}}_{{$replace_sug}}"
                                       name="your_answer_{{$table}}_{{$id_record}}[]" value="{{$sug}}"
                                       id_record="{{$id_record}}" name_table="{{$table}}"
                                       number_title="{{$number_title}}">
                            </td>
                        @endif
                    @else
                        <td><label for="your_answer_{{$table}}_{{$id_record}}_{{$replace_sug}}"
                                   id="your_answer_{{$table}}_{{$id_record}}_label_{{$replace_sug}}" id_record="{{$id_record}}"
                                   name_table="{{$table}}"
                                   number_title="{{$number_title}}">{{$sug}}</label></td>
                        <td><input type="checkbox" id="your_answer_{{$table}}_{{$id_record}}_{{$replace_sug}}"
                                   name="your_answer_{{$table}}_{{$id_record}}[]" value="{{$sug}}"
                                   id_record="{{$id_record}}" name_table="{{$table}}"
                                   number_title="{{$number_title}}">
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
</div>