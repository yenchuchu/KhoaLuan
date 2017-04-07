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

</script>