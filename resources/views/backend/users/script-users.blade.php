<script>

    // hàm gửi ajax và xóa role
    function deleteUser(id) {
        // tìm đến các thẻ có chứa id này để lấy thông tin gửi ajax lên

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }, function (isConfirm) {
            if (isConfirm == true) {
                document.getElementById('id-loader-css1').style.display = "block";
                $(".row button").prop('disabled', true);

                url = 'manager-users/delete';

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        user_id: id,
                    },
                    success: function (data) {
                        if (data.code == 404) {
                            document.getElementById('id-loader-css1').style.display = "none";
                            $(".row button").prop('disabled', false);

                            swal('', data.message, 'error');
                        } else {
                            document.getElementById('id-loader-css1').style.display = "none";
                            $(".row button").prop('disabled', false);

                            $('#reload-table-manager-users').html(data);
                            setTableInit('manager_users_student');

                            // Alert message success
                            swal('Xóa người dùng thành công!', '', 'success');
                        }

                    },
                    error: function () {
                        document.getElementById('id-loader-css1').style.display = "none";
                        $(".row button").prop('disabled', false);

                        swal('', 'Không thực hiện được hành động này!', 'error');
                    }
                });
            } else {
                return false;
            }
        });
    }

</script>