<script>
    var j = 2;
    $('.add-item').click(function () {
        $("#wrap_add_find_errors").append('' +
                '<div class="col-lg-12" class="col_add_find_errors">' +

                '<i class="fa fa-times col-lg-2 col-lg-offset-10 i-remove-item" id="remove-item-' + j + '" ' +
                'aria-hidden="true" title="remove" onclick="remove_item(this.id)"></i>' +

                '<div class="panel panel-default">' +

                '<div class="panel-body" style="padding-top: 0px;">' +

                '<div class="table-responsive" id="wrap-content-exam-' + j + '">' +

                '<div class="col-lg-12" style="padding-left: 0;">' +
                '<div class="form-group">' +
                '<input type="text" name="find_errors[' + j + '][title-find-errors] " class="form-control" required>' +
                '</div>' +
                '</div>' +

                '<div class="form-group" style="width:100%; float:left;" >' +
                ' <div class="span-numb-question" id="id-numb-question-1" >' +
                '1' +
                '<input type="hidden" name="find_errors[' + j + '][content-choose-ans-question][1][id]" value="1">' +
                '</div>' +

                '<div class="form-group" style="width:98%; float:left;">' +
                '<div class="span-text-question">' +
                '<textarea type="text" class="form-control" ' +
                'name="find_errors[' + j + '][content-choose-ans-question][1][content]"' +
                'placeholder="enter content" required></textarea>' +
                '</div>' +
                '</div>' +


                '<div class="col-lg-12 div-wrap-option-answers" >' +

                '<div class="col-lg-8 option-as-details">' +
                '<label class="col-lg-2" style="padding-right: 0px;" for="find_errors_' + j + '_answer_1">Answer: </label>' +
                '<div class="form-group col-lg-10" style="width: 43%;padding-left: 0; margin-left: 0">' +
                '<input type="text" class="form-control" placeholder="enter answer" index="1"' +
                'name="find_errors[' + j + '][content-choose-ans-question][1][answer]"' +
                'id="find_errors_' + j + '_answer_1">' +
                ' </div>' +
                ' </div>' +

                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +

                '<div class="form-group">' +
                '<span id="add_item_question_' + j + '" item_this="1" item="' + j + '" ' +
                'class="add-question" onclick="add_item_question_find_error(this.id)">+</span>' +
                '</div>' +

                '</div>' +
                '</div>');

        j++;
    });

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

    /**
     * hiển thị các unit khi chọn kiểm tra thường xuyên
     * @type {any}
     */
    var code_exam_type = $('#find-errors-examtype').find(":selected").attr('code');
    if (code_exam_type == 'test_15') {
        $('#wrap_bookmap_form').show();
    } else {
        $('#wrap_bookmap_form').hide();
    }

    $('#find-errors-examtype').change(function () {
        var code_exam_type = $('#find-errors-examtype').find(":selected").attr('code');
        if (code_exam_type == 'test_15') {
            $('#wrap_bookmap_form').show();
        } else {
            $('#wrap_bookmap_form').hide();
        }
    });

</script>