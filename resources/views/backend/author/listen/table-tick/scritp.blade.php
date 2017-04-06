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
                ' placeholder="Cập nhật đề bài" required>' +
                '</div>' +
                '</div>' +

                '<div class="form-group">' +
                '<label>Upload Audio</label>' +
                '<input name="listen_table_ticks[' + j + '][url_audio]" ' +
                ' required type="file">' +
                '</div>' +

                '<div class="form-group" style="width:100%; float:left;" >' +
                ' <div class="span-numb-question" id="id-numb-question-1" >' +
                '1' +
                '</div>' +

                '<div class="span-choose-listen-table-tick">' +
                '<table id="listen_table_ticks_' + j + '" class="table table-bordered">' +
                '<tr>' +
                '<td>' +
                '<input type="text"' +
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

//    $("[id^='listen_table_ticks_']").each(function () {
//        console.log(this.id);
//    });

</script>