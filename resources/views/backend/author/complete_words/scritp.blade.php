<script>
    var j = 2;
    $('.add-item').click(function () {
        $("#wrap_add_complete_words").append('' +
                '<div class="col-lg-12" class="col_add_complete_words">' +

                '<i class="fa fa-times col-lg-2 col-lg-offset-10 i-remove-item" id="remove-item-' + j + '" ' +
                'aria-hidden="true" title="remove" onclick="remove_item(this.id)"></i>' +

                '<div class="panel panel-default">' +

                '<div class="panel-body" style="padding-top: 0px;">' +

                '<div class="table-responsive" id="wrap-content-exam-' + j + '">' +

                '<div class="col-lg-12" style="padding-left: 0;">' +
                '<div class="form-group">' +
                '<input type="text" name="complete_words[' + j + '][title-complete-word] " class="form-control" required>' +
                '</div>' +
                '</div>' +

                '<div class="form-group" style="width:100%; float:left;" >' +
                ' <div class="span-numb-question" id="id-numb-question-1" >' +
                '1' +
                '<input type="hidden" name="complete_words[' + j + '][content-choose-ans-question][1][id]" value="1">' +
                '</div>' +

                '<div class="form-group" style="width:98%; float:left;">' +
                '<div class="span-text-question">' +
                '<textarea type="text" class="form-control" ' +
                'name="complete_words[' + j + '][content-choose-ans-question][1][content]"' +
                'placeholder="enter content" required></textarea>' +
                '</div>' +
                '</div>' +


                '<div class="col-lg-12 div-wrap-option-answers" >' +

                '<div class="col-lg-4 option-as-details">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="enter suggest" index="1"' +
                'name="complete_words[' + j + '][content-choose-ans-question][1][suggest_choose]">' +
                ' </div>' +
                ' </div>' +

                ' <div class="col-lg-8 option-as-details">' +
                '<label class="col-lg-1" for="complete_words[1][content-choose-ans-question][1][answer]">Answer: </label>' +
                '<div class="form-group col-lg-4" style="width: 43%;">' +
                ' <input type="text" class="form-control" placeholder="enter answer" index="2"' +
                ' name="complete_words[' + j + '][content-choose-ans-question][1][answer]">' +
                '</div>' +
                '</div>' +

                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +

                '<div class="form-group">' +
                '<span id="add_item_question_' + j + '" item_this="1" item="' + j + '" ' +
                'class="add-question" onclick="add_item_question_complete_word(this.id)">+</span>' +
                '</div>' +

                '</div>' +
                '</div>');

        j++;
    });

    function add_item_question_complete_word(id) {

        item = $('#' + id).attr('item');
        item_this = $('#' + id).attr('item_this');

        item_this++;

        $("#wrap-content-exam-" + item).append('<div class="form-group" style="width:100%; float:left;">' +
                '<div class="span-numb-question" id="id-numb-question-' + item_this + '">' +
                item_this +
                '<input type="hidden"  value="' + item_this + '"' +
                'name="complete_words[' + item + '][content-choose-ans-question][' + item_this + '][id]">' +
                '</div>' +

                '<div class="form-group" style="width:98%; float:left;">' +
                '<div class="span-text-question">' +
                '<textarea type="text" class="form-control" ' +
                'name="complete_words[' + item + '][content-choose-ans-question][' + item_this + '][content]"' +
                'placeholder="enter content" ></textarea>' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-12 div-wrap-option-answers" >' +

                '<div class="col-lg-4 option-as-details">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="enter suggest" index="1"' +
                'name="complete_words[' + item + '][content-choose-ans-question][' + item_this + '][suggest_choose]">' +
                ' </div>' +
                ' </div>' +

                ' <div class="col-lg-8 option-as-details">' +
                '<label class="col-lg-1" for="complete_words[1][content-choose-ans-question][1][answer]">Answer: </label>' +
                '<div class="form-group col-lg-4" style="width: 43%;">' +
                ' <input type="text" class="form-control" placeholder="enter answer" index="2"' +
                ' name="complete_words[' + item + '][content-choose-ans-question][' + item_this + '][answer]">' +
                '</div>' +
                '</div>' +

                '</div>' +

                '</div>');

        $('#add_item_question_' + item).attr('item_this', item_this);
    }

    /**
     * hiển thị các unit khi chọn kiểm tra thường xuyên
     * @type {any}
     */
    var code_exam_type = $('#complete-word-examtype').find(":selected").attr('code');
    if (code_exam_type == 'test_15') {
        $('#wrap_bookmap_form').show();
    } else {
        $('#wrap_bookmap_form').hide();
    }

    $('#complete-word-examtype').change(function () {
        var code_exam_type = $('#complete-word-examtype').find(":selected").attr('code');
        if (code_exam_type == 'test_15') {
            $('#wrap_bookmap_form').show();
        } else {
            $('#wrap_bookmap_form').hide();
        }
    });

</script>