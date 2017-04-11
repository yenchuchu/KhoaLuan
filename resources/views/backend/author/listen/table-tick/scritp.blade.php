<script>

    var j = 2;
    $('.add-item').click(function () {
        table_id = "listen_table_ticks_" + j;

        $("#wrap_add_listen_table_ticks").append('' +
                '<div class="col-lg-12 col_add_listen_table_ticks">' +

                '<i class="fa fa-times col-lg-2 col-lg-offset-10 i-remove-item" id="remove-item-' + j + '" ' +
                'aria-hidden="true" title="remove" onclick="remove_item(this.id)"></i>' +

                '<div class="panel panel-default">' +

                '<div class="panel-body" style="padding-top: 0px;">' +

                '<div class="table-responsive" id="wrap-content-exam-' + j + '">' +

                '<div class="col-lg-12" style="padding-left: 0;">' +
                '<div class="form-group">' +
                '<input type="text" name="listen_table_ticks[' + j + '][title-listen-table-ticks] " class="form-control"' +
                ' placeholder="{{trans('label.backend.create.title-question')}}" required>' +
                '</div>' +
                '</div>' +

                '<div class="form-group">' +
                ' <label>{{trans('label.backend.create.upload_audio')}}</label>' +
                '<input name="listen_table_ticks[' + j + '][url_audio]" ' +
                ' required type="file">' +
                '</div>' +

                '<div class="form-group" style="width:100%; float:left;" >' +

                '<div class="span-choose-listen-table-tick">' +
                '<table id="listen_table_ticks_' + j + '" class="table table-bordered">' +
                '<tr>' +
                '<td>' +
                '<input type="text" placeholder="{{trans('label.backend.create.suggest_answer')}}" ' +
                'name="listen_table_ticks[' + j + '][content-choose-ans-question][1][suggest]">' +
                '</td>' +
                '<td><input type="checkbox"' +
                'name="listen_table_ticks[' + j + '][content-choose-ans-question][1][answer]">' +
                '</td>' +
                '</tr>' +
                '</table>' +
                '</div>' +
                '</div>' +

                '</div>' +
                '</div>' +

                '<div class="form-group">' +
                '<span id="add_item_question_' + j + '" item_this="1" item="' + j + '" ' +
                'class="add-question" onclick="add_item_question_LTT(this.id, table_id)">+</span>' +
                '</div>' +

                '</div>' +
                '</div>');

        j++;
    });

</script>