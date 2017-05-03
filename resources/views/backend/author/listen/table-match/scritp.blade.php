<script>

    var j = 2;

$('.add-item').click(function () {
        table_id = "listen_table_matchs_" + j;

        $("#wrap_add_listen_table_match").append('' +
                '<div class="col-lg-12 col_add_listen_table_matchs">' +

                '<i class="fa fa-times col-lg-2 col-lg-offset-10 i-remove-item" id="remove-item-' + j + '" ' +
                'aria-hidden="true" title="remove" onclick="remove_item(this.id)"></i>' +

                '<div class="panel panel-default">' +

                '<div class="panel-body" style="padding-top: 0px;">' +

                '<div class="table-responsive" id="wrap-content-exam-' + j + '">' +

                '<div class="col-lg-12" style="padding-left: 0; padding-right: 0px">' +
                '<div class="form-group">' +
                '<input type="text" name="listen_table_matchs[' + j + '][title-listen-table-match] " class="form-control"' +
                ' placeholder="{{trans('label.backend.create.title-question')}}" required>' +
                '</div>' +
                '</div>' +

                '<div class="form-group">' +
                ' <label>{{trans('label.backend.create.upload_audio')}}</label>' +
                '<input name="listen_table_matchs[' + j + '][url_audio]" ' +
                ' required type="file">' +
                '</div>' +

                '<div class="form-group" style="width:100%; float:left;" >' +

                '<div class="span-choose-listen-table-match">' +

                '<table id="listen_table_matchs_' + j + '" class="table-match table table-bordered">' +
                '<tr>' +
                '<td>' +
                '<label>1 </label>' +
                ' <input type="text" placeholder="{{trans('label.backend.create.suggest_answer')}}"' +
                'name="listen_table_matchs[' + j + '][content-choose-ans-question][left][1]" required>' +

                '<div class="col-sm-3" style="padding-left: 0px; float:right;">' +
                '<label>Đáp án </label>' +
                ' <input type="text" maxlength="1" style="text-transform:uppercase"' +
                'name="listen_table_matchs[' + j + '][answer][1]" required>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<label>{{$alphab_order[1]}} </label>' +
                ' <input type="text"' +
                'name="listen_table_matchs[' + j + '][content-choose-ans-question][right][{{$alphab_order[1]}}]" required>' +
                '</td>' +
                '</tr>' +
                '</table>' +

                '</div>' +
                '</div>' +

                '</div>' +
                '</div>' +

                '<div class="form-group">' +
                '<span id="add_item_question_' + j + '" item_this="1" item="' + j + '" ' +
                'class="add-question" onclick="add_item_question_LTM(this.id, table_id)">+</span>' +
                '</div>' +

                '</div>' +
                '</div>');

        j++;
    });

</script>