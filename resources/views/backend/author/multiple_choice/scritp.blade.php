<script>
    var j = 2;
    $('.add-item').click(function () {
        $("#wrap_add_multiple_choice").append('' +
                '<div class="col-lg-12" class="col_add_multiple_choice">' +

                '<i class="fa fa-times col-lg-2 col-lg-offset-10 i-remove-item" id="remove-item-' + j + '" ' +
                'aria-hidden="true" title="remove" onclick="remove_item(this.id)"></i>' +

                '<div class="panel panel-default">' +

                '<div class="panel-body" style="padding-top: 0px;">' +

                '<div class="table-responsive" id="wrap-content-exam-' + j + '">' +

                '<div class="col-lg-12" style="padding-left: 0; padding-right: 0px">' +
                '<div class="form-group">' +
                '<input type="text" name="multiple_choice[' + j + '][title-multiple-choice] " class="form-control" ' +
                'required  placeholder="{{trans('label.backend.create.title-question')}}" >' +
                '</div>' +
                '</div>' +

                '<div class="form-group">' +
                '<textarea type="text" class="form-control" name="multiple_choice[' + j + '][content-multiple-choice]" ' +
                ' placeholder="{{trans('label.backend.create.content-question')}}"></textarea>' +
                '</div>' +
                '<div class="form-group" style="width:100%; float:left;" >' +
                ' <div class="span-numb-question" id="id-numb-question-1" >' +
                '1' +
                '<input type="hidden" name="multiple_choice[' + j + '][content-choose-ans-question][1][id]" value="1">' +
                '</div>' +

                '<div class="form-group" style="width:98%; float:left;">' +
                '<div class="span-text-question">' +
                '<textarea type="text" class="form-control count-question-multiple" ' +
                'name="multiple_choice[' + j + '][content-choose-ans-question][1][content]"' +
                'placeholder="This is ... demo" required></textarea>' +
                '</div>' +
                '</div>' +


                '<div class="col-lg-12 div-wrap-option-answers" >' +

                '<div class="col-lg-4 option-as-details">' +
                '<input type="radio" value="A"' +
                'name="multiple_choice[' + j + '][content-choose-ans-question][1][answer]">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="A"' +
                'name="multiple_choice[' + j + '][content-choose-ans-question][1][suggest_choose][A]">' +
                ' </div>' +
                ' </div>' +

                ' <div class="col-lg-4 option-as-details">' +
                '<input type="radio" value="B"' +
                'name="multiple_choice[' + j + '][content-choose-ans-question][1][answer]">' +
                '<div class="form-group">' +
                ' <input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="B"' +
                ' name="multiple_choice[' + j + '][content-choose-ans-question][1][suggest_choose][B]">' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-4 option-as-details">' +
                '<input type="radio" value="C"' +
                'name="multiple_choice[' + j + '][content-choose-ans-question][1][answer]">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" index="C"' +
                'name="multiple_choice[' + j + '][content-choose-ans-question][1][suggest_choose][C]">' +
                '</div>' +
                '</div>' +

                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +

                '<div class="form-group">' +
                '<span id="add_item_question_' + j + '" item_this="1" item="' + j + '" ' +
                'class="add-question" onclick="add_item_question_MT(this.id)">+</span>' +
                '</div>' +

                '</div>' +
                '</div>');

        j++;
    });

    /**
     * hiển thị các unit khi chọn kiểm tra thường xuyên
     * @type {any}
     */
    var code_exam_type = $('#multiple-choice-examtype').find(":selected").attr('code');
    if (code_exam_type == 'test_15') {
        $('#wrap_bookmap_form').show();
    } else {
        $('#wrap_bookmap_form').hide();
    }

    $('#multiple-choice-examtype').change(function () {
        var code_exam_type = $('#multiple-choice-examtype').find(":selected").attr('code');
        if (code_exam_type == 'test_15') {
            $('#wrap_bookmap_form').show();
        } else {
            $('#wrap_bookmap_form').hide();
        }
    });

</script>