<script>
    /**
     * hiển thị các unit khi chọn kiểm tra thường xuyên
     * @type {any}
     */
    $('#slExamType').change(function(){
        var code_exam_type = $('#slExamTypee').find(":selected").attr('code');
        console.log(code_exam_type);
        if(code_exam_type == 'test_15') {
            $('#container_Unit').show();
        } else {
            $('#container_Unit').hide();
        }
    });
</script>