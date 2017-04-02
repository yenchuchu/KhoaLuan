<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var interval = null;
    var timer = null;

    //thoi gian bắt đầu đếm lùi
    //    var thoigian = 3600;
    var thoigian = $('#demnguoc').attr('time_remaining');
    //đơn vị đếm là giây hoặc phút
    var donvi = "";
    //khoach cách giữa 2 lần giảm, đơn vị là ms
    var khoangcach = 1000; // =1s
    if (donvi == "phút") khoangcach = 60000; //=1 phút
    //cố định giá trị thời gian bằng biến bandau
    var bandau = thoigian;

    //đưa thời gian bắt đầu đếm vào button
    var minutes_st = Math.floor((thoigian / (60)));
    var seconds_st = Math.floor((thoigian % 60));
    document.getElementById("dem").innerHTML = " " + minutes_st.toString() + ":" + format_time(seconds_st.toString());


    // tự động cập nhật kết quả lên serve 15s 1 lần
    function auto_sent_answer(list_answer, level_id, time_remaning, submit) {
        url = '{{ route('frontend.student.testing.listen.handle') }}';
        $.ajax({
            url: url,
            type: "post",
            data: {
                list_answer: list_answer,
                level_id: level_id,
                time_remaning: time_remaning,
                submit: submit,
                _token: CSRF_TOKEN
            },
            success: function (data) {

                // hay trả về data mảng dạng {code, message, data};
                if (data.code == 200) {  // mặc định 200 là thành công
                    swal(data.message, '', 'success');

                    var fix_answer = data.data;
                    for (var key in fix_answer) {

                        // skip loop if the property is from prototype
                        if (!fix_answer.hasOwnProperty(key)) continue;

                        var obj = fix_answer[key];
                        for (var prop in obj) {
                            // skip loop if the property is from prototype
                            if (!obj.hasOwnProperty(prop)) continue;
                            var end_obj = obj[prop];
//                            console.log(end_obj['answer']);
                            for (var end in  end_obj) {
//                                console.log(end_obj);
//                                console.log(end);
                                if (!end_obj.hasOwnProperty(end)) continue;

                                if (key == 'listen_table_ticks') {
                                    var answer_correct = end_obj['answer'];
                                    for (var result_item_correct in answer_correct) {
                                        if (!answer_correct.hasOwnProperty(result_item_correct)) continue;
//                                    console.log(answer_correct[result_item_correct]);
                                        var replace_answer = answer_correct[result_item_correct].replace(/\ /g, '_');
                                        name_id = 'your_answer_' + key + '_' + prop + '_label_' + replace_answer;
//                                    console.log(name_id);
                                        $('#' + name_id).css('color', '#09e609');
                                    }

                                    var answer_error = end_obj['error'];

                                    for (var result_item_error in answer_error) {
//                                        console.log(answer_error);
                                        if (!answer_error.hasOwnProperty(result_item_error)) continue;
//                                        console.log(answer_error[result_item_error]);
                                        var replace_answer = answer_error[result_item_error].replace(/\ /g, '_');
                                        name_id = 'your_answer_' + key + '_' + prop + '_label_' + replace_answer;
//                                    console.log(name_id);
                                        $('#' + name_id).css('color', 'red');
                                    }
                                } else if (key == 'listen_complete_sentences') {
                                    name_id = 'your_answer_' + key + '_' + prop + '_' + end;
                                    $('#' + name_id).css('color', 'red');
                                    $('#' + name_id).parent().append('' +
                                            '<span style="color: red;padding-left: 12px;"><strong style="margin-right: 5px;">Anwer:</strong> ' + end_obj[end]['answer'] + '</sapn>');
//                                    console.log(key); // name tbale
//                                    console.log(prop); // 851
//                                    console.log('test teststet');
                                } else if(key == 'listen_ticks') {
                                    name_id = 'show_result_'+ key +'_' + prop + '_' + end;
                                    $('#' + name_id).append('' +
                                            '<label class="checkbox-inline" style="color: red;"><strong>Answer:</strong>'+ end_obj[end]['answer'] +'</label>');
//                                    console.log(name_id);
//                                    console.log(end_obj[end]);
                                }
                            }
                        }
                    }

                    clearInterval(timer); // stop the interval
                    clearInterval(interval); // stop the interval
                    $('#btn-submit-test').remove();

                    return false;
                }
                if (data.code == 404) {
                    swal('', data.message, 'error').catch(swal.noop);

                    return false;
                }
            },
            error: function () {
                swal('', 'Không thực hiện được hành động này!', 'error');
            }
        });
    }

    // nếu giây có 1 chữ số => thêm số 0 vào trước.
    function format_time(seconds) {

        if (seconds < 10) {
            seconds = "0" + seconds;
        }

        return seconds;
    }

    // lọc những phần tử giống nhau trong 1 mảng
    function unique(list) {
        var result = [];
        $.each(list, function (i, e) {
            if ($.inArray(e, result) == -1) result.push(e);
        });
        return result;
    }

    // lọc những object giống nhau trong 1 mảng
    function dedupe(arr) {
        return arr.reduce(function (p, c) {
            var key = [c.name_table, c.id_record, c.id_question, c.answer_student].join('|');
            if (p.temp.indexOf(key) === -1) {
                p.out.push(c);
                p.temp.push(key);
            }
            return p;
        }, {temp: [], out: []}).out;
    }

    function get_answer_consecutive(submit) {


        list_answer = [];
        list_answer_details = [];
        unique_list_answer = [];


        level_id = $('#level-tesing-hidden').val();
        skill_name = $('#skill-code-tesing-hidden').val();
        time_remaning = $('#demnguoc').attr('time_remaining');

        $("[id^='your_answer_']").each(function () {
            name_table = $(this).attr('name_table');
//            console.log(name_table);
            id_record = $(this).attr('id_record');
            number_title = $(this).attr('number_title');


            var answer_student = [];
            if (name_table == 'listen_table_ticks') {
                var  id_question = 0;
                $("input[name='your_answer_" + name_table + "_" + id_record + "[]']:checked").each(function () {
                    answer_student.push($(this).val());
                });

            } else if (name_table == 'listen_ticks') {
                id_question = $(this).attr('id_question');
                answer_student = $('input[name="your_answer_[' + name_table + '][' + id_record + '][' + id_question + '][]"]:checked').val();

//                $("input[name='your_answer_[" + name_table + "][" + id_record + "]["+ id_question +"][]']:checked").each(function () {
//                    answer_student.push($(this).val());
//                });
            } else {
                id_question = $(this).attr('id_question');
                answer_student = $(this).val();
            }

            list_answer.push({
                'name_table': name_table,
                'id_record': id_record,
                'id_question': id_question,
                'answer_student': answer_student,
                'number_title': number_title,
                'skill_name': skill_name
            });
            unique_list_answer = dedupe(list_answer);
        });

        auto_sent_answer(unique_list_answer, level_id, time_remaning, submit);
    }

    // khi chọn nút restart => gọi ajax xóa bản ghi có level_id và user_id.
    function restart_test(level_id, skill_code) {
        url = '{{ route('frontend.student.testing.restart.delete.item') }}';
        $.ajax({
            url: url,
            type: "post",
            data: {
                level_id: level_id,
                skill_code: skill_code,
                _token: CSRF_TOKEN
            },
            success: function (data) {
                if (data.code == 404) {
                    swal('', data.message, 'error').catch(swal.noop);
                    return false;
                } else if (data.code == 200) {
                    window.location = document.getElementById('href_' + skill_code).href;
                    // cứ 15s gửi đáp án lên serve 1 lần
                    interval = setInterval(function () {
                        get_answer_consecutive(0);
                    }, 1500);
                }
            },
            error: function () {
                swal('', 'Không thực hiện được hành động này!', 'error');
            }
        });
    }

</script>

{{-- có bản ghi trong bảng Items -> chưa làm xong --}}
@if($noti_not_complete == 1)
    <script type="text/javascript">

        swal({
                    title: "",
                    text: "Bạn muốn tiếp tục hay làm lại bài thi?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Restart",
                    cancelButtonText: "Continue",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function (isConfirm) {
                    if (isConfirm) { // true: restart
                        // xóa record gần nhất ( record của cái lần vừa được restart)
                        // bắt đầu thêm lại và update.
                        restart_test('{{$get_next_level}}', '{{$skill_code}}');


                        timer = setInterval(function () {
                            thoigian--;
                            $('#demnguoc').attr('time_remaining', thoigian);
                            if (thoigian == -1) {

                                clearInterval(timer); // stop the interval
                                clearInterval(interval); // stop the interval

                                // = 1: hết tgian thì tự động gán submit = 1.
                                get_answer_consecutive(1);
                            } else {
                                var minutes = Math.floor((thoigian / (60)));
                                var seconds = Math.floor((thoigian % 60));
                                //nếu chưa đếm xong thì đưa thoigian=thoigian-1 vào button
                                document.getElementById("dem").innerHTML = " " + minutes.toString() + ":" + format_time(seconds.toString());
                            }
                        }, khoangcach);
                    } else { // false: continue testing
                        // cập nhật tiếp dữ liệu ở bản ghi trong user_skill table.
                        // cứ 15s gửi đáp án lên serve 1 lần
                        // tgian: lay tu time trong bang item. chua set duoc time.

                        timer = setInterval(function () {
                            thoigian--;
                            $('#demnguoc').attr('time_remaining', thoigian);
                            if (thoigian == -1) {
                                clearInterval(timer); // stop the interval
                                clearInterval(interval); // stop the interval

                                // = 1: hết tgian thì tự động gán submit = 1.
                                get_answer_consecutive(1);
                            } else {
                                var minutes = Math.floor((thoigian / (60)));
                                var seconds = Math.floor((thoigian % 60));
                                //nếu chưa đếm xong thì đưa thoigian=thoigian-1 vào button
                                document.getElementById("dem").innerHTML = " " + minutes.toString() + ":" + format_time(seconds.toString());
                            }
                        }, khoangcach);

                        interval = setInterval(function () {
                            get_answer_consecutive(0);
                        }, 1500);

                    }
                });
    </script>
@else
    <script>

        timer = setInterval(function () {
            thoigian--;
            $('#demnguoc').attr('time_remaining', thoigian);
            if (thoigian == -1) {

                clearInterval(timer); // stop the interval
                clearInterval(interval); // stop the interval

                // = 1: hết tgian thì tự động gán submit = 1.
                get_answer_consecutive(1);
            } else {
                var minutes = Math.floor((thoigian / (60)));
                var seconds = Math.floor((thoigian % 60));
                //nếu chưa đếm xong thì đưa thoigian=thoigian-1 vào button
                document.getElementById("dem").innerHTML = " " + minutes.toString() + ":" + format_time(seconds.toString());
            }
        }, khoangcach);

        interval = setInterval(function () {
            get_answer_consecutive(0);
        }, 1500);

    </script>
@endif

<script>

    $('#btn-submit-test').click(function () {
        submit = 1; // khi nút submit đc click hoặc tự động hết giờ. = 0 khi chưa hết giờ mà ngưng làm bài.

        clearInterval(timer); // stop the interval
        clearInterval(interval); // stop the interval

        get_answer_consecutive(submit);
    });
</script>