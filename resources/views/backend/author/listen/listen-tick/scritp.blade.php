<script>

    var j = 2;
    $('.add-item').click(function () {
        $("#wrap_add_listen_ticks").append('' +
                '<div class="col-lg-12" class="col_add_listen_ticks">' +

                '<i class="fa fa-times col-lg-2 col-lg-offset-10 i-remove-item" id="remove-item-' + j + '" ' +
                'aria-hidden="true" title="remove" onclick="remove_item(this.id)"></i>' +

                '<div class="panel panel-default">' +

                '<div class="panel-body" style="padding-top: 0px;">' +

                '<div class="table-responsive" id="wrap-content-exam-' + j + '">' +

                '<div class="col-lg-12" style="padding-left: 0;">' +
                '<div class="form-group">' +
                '<input type="text" name="listen_ticks[' + j + '][title-listen-complete-sentences] " class="form-control" required>' +
                '</div>' +
                '</div>' +

                '<div class="form-group" style="width:100%; float:left;" >' +
                ' <div class="span-numb-question" id="id-numb-question-1" >' +
                '1' +
                '<input type="hidden" name="listen_ticks[' + j + '][content-choose-ans-question][1][id]" value="1">' +
                '</div>' +

                '<div class="form-group">' +
                '<label>Upload Audio</label>' +
                '<input name="listen_ticks[' + j + '][content-choose-ans-question][1][url_audio]" ' +
                ' required type="file">' +
                '</div>' +

                '<div class="span-choose-listen-tick">' +
                '<span class="img-listen-tick">' +
                '<input type="radio" id="check-answer_' + j + '_1_A" required ' +
                'name="listen_ticks[' + j + '][content-choose-ans-question][1][answer]" value="A"' +
                'class="ans-true">' +
                '<label for="check-answer_' + j + '_1_A" style="cursor: pointer">' +
                '<img src="{{URL::asset('imgs-dashboard/avatar.png')}}" style="height: 180px;"' +
                'id="change_uploadListenImgOne_' + j + '_1_A" alt="image suggest">' +
                '</label>' +

                '<input type="file" id="uploadListenImgOne_' + j + '_1_A" onclick="choose_img_upload(this.id)"' +
                'name="listen_ticks[' + j + '][content-choose-ans-question][1][A]"' +
                'required style="margin-left: 17px; margin-top: 10px;">' +
                '</span>' +
                '<span class="img-listen-tick">' +
                '<input type="radio" id="check-answer_' + j + '_1_B" required ' +
                'name="listen_ticks[' + j + '][content-choose-ans-question][1][answer]" value="B"' +
                'class="ans-false">' +
                '<label for="check-answer_' + j + '_1_B" style="cursor: pointer">' +
                '<img src="{{URL::asset('imgs-dashboard/avatar.png')}}" style="height: 180px;"' +
                'id="change_uploadListenImgOther_' + j + '_1_B" alt="image suggest">' +
                '</label>' +

                '<input type="file" id="uploadListenImgOther_' + j + '_1_B" onclick="choose_img_upload(this.id)"' +
                'name="listen_ticks[' + j + '][content-choose-ans-question][1][B]"' +
                'required style="margin-left: 17px; margin-top: 10px;">' +
                '</span>' +
                '</div>' +
                '</div>' +

                '</div>' +
                '</div>' +

                '<div class="form-group">' +
                '<span id="add_item_question_' + j + '" item_this="1" item="' + j + '" ' +
                'class="add-question" onclick="add_item_question_LT(this.id)">+</span>' +
                '</div>' +

                '</div>' +
                '</div>');

        j++;
    });

    function add_item_question_LT(id) {

        item = $('#' + id).attr('item');
        item_this = $('#' + id).attr('item_this');

        item_this++;

        $("#wrap-content-exam-" + item).append('<div class="form-group" style="width:100%; float:left;">' +
                '<div class="span-numb-question" id="id-numb-question-' + item_this + '">' +
                item_this +
                '<input type="hidden" value="' + item_this + '"' +
                'name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][id]">' +
                '</div>' +

                '<div class="form-group">' +
                '<label>Upload Audio</label>' +
                '<input name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][url_audio]" ' +
                ' required type="file">' +
                '</div>' +

                '<div class="span-choose-listen-tick">' +
                '<span class="img-listen-tick">' +
                '<input type="radio" id="check-answer_' + item + '_' + item_this + '_A" required ' +
                'name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][answer]" value="A"' +
                'class="ans-true">' +
                '<label for="check-answer_' + item + '_' + item_this + '_A" style="cursor: pointer">' +
                '<img src="{{URL::asset('imgs-dashboard/avatar.png')}}" style="height: 180px;"' +
                'id="change_uploadListenImgOne_' + item + '_' + item_this + '_A" alt="image suggest">' +
                '</label>' +

                '<input type="file" id="uploadListenImgOne_' + item + '_' + item_this + '_A"' +
                        ' onclick="choose_img_upload(this.id)"' +
                'name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][A]"' +
                'required style="margin-left: 17px; margin-top: 10px;">' +
                '</span>' +

                '<span class="img-listen-tick">' +
                '<input type="radio" id="check-answer_' + item + '_' + item_this + '_B" required ' +
                'name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][answer]" value="B"' +
                'class="ans-false">' +
                '<label for="check-answer_' + item + '_' + item_this + '_B" style="cursor: pointer">' +
                '<img src="{{URL::asset('imgs-dashboard/avatar.png')}}" style="height: 180px;"' +
                'id="change_uploadListenImgOther_' + item + '_' + item_this + '_B" alt="image suggest">' +
                '</label>' +

                '<input type="file" id="uploadListenImgOther_' + item + '_' + item_this + '_B"' +
                        ' onclick="choose_img_upload(this.id)"' +
                'name="listen_ticks[' + item + '][content-choose-ans-question][' + item_this + '][B]"' +
                'required style="margin-left: 17px; margin-top: 10px;">' +
                '</span>' +

                '</div>' +
                '</div>' +

                '</div>'

        );

        $('#add_item_question_' + item).attr('item_this', item_this);
    }

    // change image when choose image.
    <!-- HTML5 Speech Recognition API -->
    function readURL_change_img(input, id_img) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#' + id_img).attr('src', e.target.result);
                $('#' + id_img).css('display', 'block');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function choose_img_upload(id_input) {
        console.log(id_input);
        $("#" + id_input).change(function () {
            readURL_change_img(this, 'change_' + id_input);
        });
    }
//    $("[id^='uploadListenImg']").on('click', function () {
//        console.log(this.id);
//        $("#" + this.id).change(function () {
//            readURL_change_img(this, 'change_' + this.id);
//        });
//    });

</script>