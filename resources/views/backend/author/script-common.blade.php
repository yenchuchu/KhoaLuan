<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function remove_item(id) {
        $('#'+id).parent().remove();
    }

</script>