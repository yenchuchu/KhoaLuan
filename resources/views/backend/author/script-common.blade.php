<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function remove_item(id) {
        $('#'+id).parent().remove();
    }

    // Listen Table Tick
    function add_item_question_LTT(id, table_id) {

        item = $('#' + id).attr('item');
        item_this = $('#' + id).attr('item_this');

        item_this++;

        var table = document.getElementById(table_id);
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = '<input type="text" placeholder="{{trans('label.backend.create.suggest_answer')}}" ' +
                ' name="listen_table_ticks[' + item + '][content-choose-ans-question][' + item_this + '][suggest]" required>';
        cell2.innerHTML = '<input type="checkbox"' +
                ' name="listen_table_ticks[' + item + '][content-choose-ans-question][' + item_this + '][answer]">';

        $('#add_item_question_' + item).attr('item_this', item_this);
    }

    // Listen Table Match
    function add_item_question_LTM(id, table_id) {
        alpha_order = [];
        <?php
                $alphab_order = config('constants.alphab');
                foreach ($alphab_order as $key_al => $val_al) { ?>
                    alpha_order['{{$key_al}}'] = '{{$val_al}}';
         <?php } ?>
//        console.log(alpha_order);
        item = $('#' + id).attr('item');
        item_this = $('#' + id).attr('item_this');

        item_this++;

        var table = document.getElementById(table_id);
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = '<label> ' + item_this + ' </label>' +
        ' <input type="text" placeholder="{{trans('label.backend.create.suggest_answer')}}"' +
                'name="listen_table_matchs[' + item + '][content-choose-ans-question][left][' + item_this + ']" required>' +
                '<div class="col-sm-3" style="padding-left: 0px; float:right;">' +
                '<label> Đáp án </label>' +
        ' <input type="text" maxlength="1" style="text-transform:uppercase" ' +
                'name="listen_table_matchs[' + item + '][answer][' + item_this + ']" required>' +
                '</div>';

        cell2.innerHTML = '<label> '+ alpha_order[item_this] +' </label>' +
                ' <input type="text"' +
        'name="listen_table_matchs[' + item + '][content-choose-ans-question][right][' + alpha_order[item_this] + ']" required>';

        $('#add_item_question_' + item).attr('item_this', item_this);
    }

    // Read: Answer Question
    function add_item_question_AQ(id) {

        item = $('#' + id).attr('item');
        item_this =  $('#' + id).attr('item_this');

        item_this++;

        $("#wrap-content-exam-" + item ).append('<div class="form-group" style="width:100%; float:left;">' +
                '<div class="span-numb-question" id="id-numb-question-'+ item_this +'">' +
                item_this +
                '<input type="hidden" value="'+ item_this +'" ' +
                'name="answer_question['+ item +'][content-choose-ans-question]['+ item_this +'][id]" >' +
                '</div>' +

                '<div class="form-group" style="width:98%; float:left;">'+
                '<div class="span-text-question">' +
                '<textarea type="text" class="form-control" ' +
                'name="answer_question['+ item +'][content-choose-ans-question]['+ item_this +'][content]"' +
                ' placeholder="{{trans('label.backend.create.item-content-question')}}" required></textarea>' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-12" style="padding-left: 0;margin-left: 17px;width: 100%">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" ' +
                'name="answer_question['+ item +'][content-choose-ans-question]['+ item_this +'][answer]" required>' +
                '</div>' +
                '</div>' +

                '</div>');

        $('#add_item_question_'+ item).attr('item_this', item_this);
    }

    // Read: Find Error
    function add_item_question_find_error(id) {

        item = $('#' + id).attr('item');
        item_this = $('#' + id).attr('item_this');

        item_this++;

        $("#wrap-content-exam-" + item).append('<div class="form-group" style="width:100%; float:left;">' +
                '<div class="span-numb-question" id="id-numb-question-' + item_this + '">' +
                item_this +
                '<input type="hidden"  value="' + item_this + '" ' +
                'name="find_errors[' + item + '][content-choose-ans-question][' + item_this + '][id]">' +
                '</div>' +

                '<div class="form-group" style="width:98%; float:left;">' +
                '<div class="span-text-question">' +
                '<textarea type="text" class="form-control" ' +
                'name="find_errors[' + item + '][content-choose-ans-question][' + item_this + '][content]"' +
                'placeholder="This <u>is</u> a <u>example</u> for <u>this</u> question format" required></textarea>' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-12 div-wrap-option-answers" >' +

                '<div class="col-lg-8 option-as-details">' +
                '<label class="col-lg-2" style="padding-right: 0px;" for="find_errors_' + item + '_answer_' + item_this + '">Answer: </label>' +
                '<div class="form-group col-lg-10" style="width: 43%;padding-left: 0; margin-left: 0">' +
                '<input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="1"' +
                'name="find_errors[' + item + '][content-choose-ans-question][' + item_this + '][answer]"' +
                'id="find_errors_' + item + '_answer_' + item_this + '" required>' +
                ' </div>' +
                ' </div>' +

                '</div>' +

                '</div>');

        $('#add_item_question_' + item).attr('item_this', item_this);
    }

    // Read: Multiple Choice
    function add_item_question_MT(id) {

        item = $('#' + id).attr('item');
        item_this = $('#' + id).attr('item_this');

        item_this++;

        $("#wrap-content-exam-" + item).append('<div class="form-group" style="width:100%; float:left;">' +
                '<div class="span-numb-question" id="id-numb-question-' + item_this + '">' +
                item_this +
                '<input type="hidden" value="' + item_this + '" ' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][id]">' +
                '</div>' +

                '<div class="form-group" style="width:98%; float:left;">' +
                '<div class="span-text-question">' +
                '<textarea type="text" class="form-control count-question-multiple" ' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][content]"' +
                'placeholder="This is ... demo" ></textarea>' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-12 div-wrap-option-answers" >' +

                '<div class="col-lg-4 option-as-details">' +
                '<input type="radio" value="A"' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][answer]">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="A"' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][suggest_choose][A]">' +
                ' </div>' +
                ' </div>' +

                ' <div class="col-lg-4 option-as-details">' +
                '<input type="radio" value="B"' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][answer]">' +
                '<div class="form-group">' +
                ' <input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="B"' +
                ' name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][suggest_choose][B]">' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-4 option-as-details">' +
                '<input type="radio" value="C"' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][answer]">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="C"' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][suggest_choose][C]">' +
                '</div>' +
                '</div>' +

                '</div>' +

                '</div>');

        $('#add_item_question_' + item).attr('item_this', item_this);


    }

    // Read: Tick True False
    function add_item_question_TF(id) {

        item = $('#' + id).attr('item');
        item_this = $('#' + id).attr('item_this');

        item_this++;

        $("#wrap-content-exam-" + item).append('<div class="form-group" style="width:100%; float:left;">' +
                '<div class="span-numb-question" id="id-numb-question-' + item_this + '">' +
                item_this +
                '<input type="hidden" value="' + item_this + '"' +
                'name="tick_true_false[' + item + '][content-choose-ans-question][' + item_this + '][id]">' +
                '</div>' +
                '<div class="span-text-question">' +
                '<textarea type="text" class="form-control count-question-true-false" ' +
                'name="tick_true_false[' + item + '][content-choose-ans-question][' + item_this + '][content]"' +
                ' placeholder="{{trans('label.backend.create.item-content-question')}}" required ></textarea>' +
                '</div>' +

                '<div class="span-choose-tick-true-false">' +
                '<span>' +
                '<input type="radio" id="check-answer_' + item + '_' + item_this + '_T"' +
                'name="tick_true_false[' + item + '][content-choose-ans-question][' + item_this + '][answer]" value="T"' +
                'class="ans-true">' +
                '<label for="check-answer_' + item + '_' + item_this + '_T" style="cursor: pointer">T</label>' +
                ' </span>' +
                '<span>' +
                '<input type="radio" id="check-answer_' + item + '_' + item_this + '_F"' +
                'name="tick_true_false[' + item + '][content-choose-ans-question][' + item_this + '][answer]" value="F"' +
                'class="ans-false"> ' +
                '<label for="check-answer_' + item + '_' + item_this + '_F" style="cursor: pointer">F</label>' +
                '</span>' +
                '</div>' +

                '</div>');

        $('#add_item_question_' + item).attr('item_this', item_this);
    }

    // Listen: Listen Complete Sentences
    function add_item_question_LCS(id) {

        item = $('#' + id).attr('item');
        item_this =  $('#' + id).attr('item_this');

        item_this++;

        $("#wrap-content-exam-" + item ).append('<div class="form-group" style="width:100%; float:left;">' +
                '<div class="span-numb-question" id="id-numb-question-'+ item_this +'">' +
                item_this +
                '<input type="hidden" value="'+ item_this +'"' +
                'name="listen_complete_sentences['+ item +'][content-choose-ans-question]['+ item_this +'][id]">' +
                '</div>' +

                '<div class="form-group" style="width:98%; float:left;">'+
                '<div class="span-text-question">' +
                '<textarea type="text" class="form-control" ' +
                'name="listen_complete_sentences['+ item +'][content-choose-ans-question]['+ item_this +'][content]"' +
                'placeholder="this is ___ a kind. there are three character _" required ></textarea>' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-12" style="padding-left: 0;margin-left: 17px;width: 100%">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" ' +
                'name="listen_complete_sentences['+ item +'][content-choose-ans-question]['+ item_this +'][answer]" required>' +
                '</div>' +
                '</div>' +

                '</div>');

        $('#add_item_question_'+ item).attr('item_this', item_this);
    }

    // Listen: Tick
    function add_item_question_LT(id) {

        item = $('#' + id).attr('item');
        item_this = $('#' + id).attr('item_this');

        item_this++;

        $("#wrap-content-exam-" + item).append('<div class="form-group" style="width:100%; float:left;">' +
                '<div class="span-numb-question" id="id-numb-question-' + item_this + '">' +
                item_this +
                '<input type="hidden" value="' + item_this + '"' +
                'name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][id]">' +
                '</div>' +

                '<div class="span-choose-listen-tick">' +
                '<span class="img-listen-tick">' +
                '<input type="radio" id="check-answer_' + item + '_' + item_this + '_A" required ' +
                'name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][answer]" value="A"' +
                'class="ans-true">' +
                '<label for="check-answer_' + item + '_' + item_this + '_A" style="cursor: pointer">' +
                '<img src="/imgs-dashboard/avatar.png" style="height: 180px;"' +
                'id="change_uploadListenImgOne_' + item + '_' + item_this + '_A" alt="image suggest">' +
                '</label>' +

                '<input type="file" id="uploadListenImgOne_' + item + '_' + item_this + '_A"' +
                ' onclick="choose_img_upload(this.id)"' +
                'name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][content][A]"' +
                'required style="margin-left: 17px; margin-top: 10px;">' +
                '</span>' +

                '<span class="img-listen-tick">' +
                '<input type="radio" id="check-answer_' + item + '_' + item_this + '_B" required ' +
                'name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][answer]" value="B"' +
                'class="ans-false">' +
                '<label for="check-answer_' + item + '_' + item_this + '_B" style="cursor: pointer">' +
                '<img src="/imgs-dashboard/avatar.png" style="height: 180px;"' +
                'id="change_uploadListenImgOther_' + item + '_' + item_this + '_B" alt="image suggest">' +
                '</label>' +

                '<input type="file" id="uploadListenImgOther_' + item + '_' + item_this + '_B"' +
                ' onclick="choose_img_upload(this.id)"' +
                'name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][content][B]"' +
                'required style="margin-left: 17px; margin-top: 10px;">' +
                '</span>' +

                '</div>' +
                '</div>' +

                '</div>'

        );

        $('#add_item_question_' + item).attr('item_this', item_this);
    }


</script>