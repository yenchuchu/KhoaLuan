<script>
    var j = 2;
    $('.add-item').click(function () {
        $("#wrap_add_listen_complete_sentences").append('' +
                '<div class="col-lg-12" class="col_add_listen_complete_sentences">' +

                '<i class="fa fa-times col-lg-2 col-lg-offset-10 i-remove-item" id="remove-item-'+ j +'" ' +
                'aria-hidden="true" title="remove" onclick="remove_item(this.id)"></i>' +

                '<div class="panel panel-default">' +

                '<div class="panel-body" style="padding-top: 0px;">' +

                '<div class="table-responsive" id="wrap-content-exam-' + j + '">' +

                '<div class="col-lg-12" style="padding-left: 0;">' +
                '<div class="form-group">' +
                '<input type="text" name="listen_complete_sentences['+ j +'][title-listen-complete-sentences] " ' +
                'class="form-control" required placeholder="{{trans('label.backend.create.title-question')}}">' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<label>{{trans('label.backend.create.upload_audio')}}</label>' +
                '<input name="listen_complete_sentences['+j+'][audio]" type="file">' +
                '</div>' +
                '<div class="form-group" style="width:100%; float:left;" >' +
                ' <div class="span-numb-question" id="id-numb-question-1" >' +
                '1' +
                '<input type="hidden" name="listen_complete_sentences['+ j +'][content-choose-ans-question][1][id]" value="1">' +
                '</div>' +

                '<div class="form-group" style="width:98%; float:left;">'+
                '<div class="span-text-question">' +
                '<textarea type="text" class="form-control" ' +
                'name="listen_complete_sentences['+ j +'][content-choose-ans-question][1][content]"' +
                'placeholder="this is ___ a kind. there are three character _" required></textarea>' +
                '</div>' +
                '</div>' +

                '<div class="col-lg-12" style="padding-left: 0;margin-left: 17px;width: 100%">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" placeholder="{{trans('label.backend.create.answer-question')}}" ' +
                'name="listen_complete_sentences['+ j +'][content-choose-ans-question][1][answer]">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +

                '<div class="form-group">' +
                '<span id="add_item_question_' + j + '" item_this="1" item="' + j + '" ' +
                'class="add-question" onclick="add_item_question_LCS(this.id)">+</span>' +
                '</div>' +

                '</div>' +
                '</div>');

        j++;
    });

    /**
     * hiển thị các unit khi chọn kiểm tra thường xuyên
     * @type {any}
     */
    var code_exam_type = $('#listen-complete-sentences-examtype').find(":selected").attr('code');
    if(code_exam_type == 'test_15') {
        $('#wrap_bookmap_form').show();
    } else {
        $('#wrap_bookmap_form').hide();
    }

    $('#listen-complete-sentences-examtype').change(function(){
        var code_exam_type = $('#listen-complete-sentences-examtype').find(":selected").attr('code');
        if(code_exam_type == 'test_15') {
            $('#wrap_bookmap_form').show();
        } else {
            $('#wrap_bookmap_form').hide();
        }
    });

</script>