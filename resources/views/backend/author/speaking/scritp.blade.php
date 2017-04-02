<script>
    var j = 2;
    var placeholder = '{{trans('label.backend.author.speaking.create.placeholder')}}';
    var add_radio = '{{trans('label.backend.author.speaking.create.button.add-radio')}}';
    $('.add-item').click(function () {

        $("#wrap_add_speaking").append('' +
                '<div class="col-lg-12" class="col_add_speaking">' +

                '<i class="fa fa-times col-lg-2 col-lg-offset-10 i-remove-item" id="remove-item-' + j + '" ' +
                'aria-hidden="true" title="remove" onclick="remove_item(this.id)"></i>' +

                '<div class="panel panel-default">' +

                '<div class="panel-body" style="padding-top: 0px;">' +

                '<div class="table-responsive" id="wrap-content-exam-' + j + '">' +

                '<div class="form-group">' +
                '<textarea type="text" class="form-control" name="speaking[' + j + '][content-speaking]"' +
                'placeholder="'+placeholder +'" required></textarea>' +
                '</div>' +
                '<div class="form-group">' +
                '<input name="speaking['+j+'][audio]" type="file">' +
                '</div>' +

                '</div>' +
                '</div>' +
                '</div>' +

                '</div>');

        j++;
    });

    /**
     * hiển thị các unit khi chọn kiểm tra thường xuyên
     * @type {any}
     */
    var code_exam_type = $('#speaking-examtype').find(":selected").attr('code');
    if (code_exam_type == 'test_15') {
        $('#wrap_bookmap_form').show();
    } else {
        $('#wrap_bookmap_form').hide();
    }

    $('#speaking-examtype').change(function () {
        var code_exam_type = $('#speaking-examtype').find(":selected").attr('code');
        if (code_exam_type == 'test_15') {
            $('#wrap_bookmap_form').show();
        } else {
            $('#wrap_bookmap_form').hide();
        }
    });

</script>