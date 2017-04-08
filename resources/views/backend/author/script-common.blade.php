<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function remove_item(id) {
        $('#'+id).parent().remove();
    }

    function add_item_question_LTT(id, table_id) {

        item = $('#' + id).attr('item');
        item_this = $('#' + id).attr('item_this');

        item_this++;

        var table = document.getElementById(table_id);
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = '<input type="text"' +
                'name="listen_table_ticks[' + item + '][content-choose-ans-question][' + item_this + '][suggest]">';
        cell2.innerHTML = '<input type="checkbox"' +
                'name="listen_table_ticks[' + item + '][content-choose-ans-question][' + item_this + '][answer]">';

        $('#add_item_question_' + item).attr('item_this', item_this);
    }

    function add_item_question_AQ(id) {

        item = $('#' + id).attr('item');
        item_this =  $('#' + id).attr('item_this');

        item_this++;

        $("#wrap-content-exam-" + item ).append('<div class="form-group" style="width:100%; float:left;">' +
                '<div class="span-numb-question" id="id-numb-question-'+ item_this +'">' +
                item_this +
                '<input type="hidden" value="'+ item_this +'"' +
                'name="answer_question['+ item +'][content-choose-ans-question]['+ item_this +'][id]">' +
                '</div>' +

                '<div class="form-group" style="width:98%; float:left;">'+
                '<div class="span-text-question">' +
                '<textarea type="text" class="form-control" ' +
                'name="answer_question['+ item +'][content-choose-ans-question]['+ item_this +'][content]"' +
                'placeholder="enter content" ></textarea>' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-12" style="padding-left: 0;margin-left: 17px;width: 100%">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="enter answer" ' +
                'name="answer_question['+ item +'][content-choose-ans-question]['+ item_this +'][answer]">' +
                '</div>' +
                '</div>' +

                '</div>');

        $('#add_item_question_'+ item).attr('item_this', item_this);
    }

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
                'placeholder="enter content" ></textarea>' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-12 div-wrap-option-answers" >' +

                '<div class="col-lg-8 option-as-details">' +
                '<label class="col-lg-2" style="padding-right: 0px;" for="find_errors_' + item + '_answer_' + item_this + '">Answer: </label>' +
                '<div class="form-group col-lg-10" style="width: 43%;padding-left: 0; margin-left: 0">' +
                '<input type="text" class="form-control" placeholder="enter answer" index="1"' +
                'name="find_errors[' + item + '][content-choose-ans-question][' + item_this + '][answer]"' +
                'id="find_errors_' + item + '_answer_' + item_this + '">' +
                ' </div>' +
                ' </div>' +

                '</div>' +

                '</div>');

        $('#add_item_question_' + item).attr('item_this', item_this);
    }

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
                '<textarea type="text" class="form-control" ' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][content]"' +
                'placeholder="enter content" ></textarea>' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-12 div-wrap-option-answers" >' +

                '<div class="col-lg-4 option-as-details">' +
                '<input type="radio" value="A"' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][answer]">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="enter answer" index="A"' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][suggest_choose][A]">' +
                ' </div>' +
                ' </div>' +

                ' <div class="col-lg-4 option-as-details">' +
                '<input type="radio" value="B"' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][answer]">' +
                '<div class="form-group">' +
                ' <input type="text" class="form-control" placeholder="enter answer" index="B"' +
                ' name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][suggest_choose][B]">' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-4 option-as-details">' +
                '<input type="radio" value="C"' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][answer]">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="enter answer" index="C"' +
                'name="multiple_choice[' + item + '][content-choose-ans-question][' + item_this + '][suggest_choose][C]">' +
                '</div>' +
                '</div>' +

                '</div>' +

                '</div>');

        $('#add_item_question_' + item).attr('item_this', item_this);
    }

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
                'placeholder="this is ___ a kind. there are three character _" ></textarea>' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-12" style="padding-left: 0;margin-left: 17px;width: 100%">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="enter answer" ' +
                'name="listen_complete_sentences['+ item +'][content-choose-ans-question]['+ item_this +'][answer]">' +
                '</div>' +
                '</div>' +

                '</div>');

        $('#add_item_question_'+ item).attr('item_this', item_this);
    }

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

                '<div class="form-group">' +
                '<label>Upload Audio</label>' +
                '<input name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][url_audio]" ' +
                ' required type="file">' +
                '</div>' +

                '<div class="span-choose-listen-tick">' +
                '<span class="img-listen-tick">' +
                '<input type="radio" id="check-answer_' + item + '_' + item_this + '_A" required ' +
                'name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][answer]" value="A"' +
                'class="ans-true">' +
                '<label for="check-answer_' + item + '_' + item_this + '_A" style="cursor: pointer">' +
                '<img src="{{URL::asset('imgs-dashboard/avatar.png')}}" style="height: 180px;"' +
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
                '<img src="{{URL::asset('imgs-dashboard/avatar.png')}}" style="height: 180px;"' +
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