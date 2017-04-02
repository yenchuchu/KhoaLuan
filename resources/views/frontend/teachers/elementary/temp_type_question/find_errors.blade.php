<div class="row wrap_question_details content" style="margin-bottom: 0px">

    @foreach($content_json as $key => $question)
        <div class="col-lg-12" style="padding-left: 0px;margin-bottom: 7px;">
            <span class="content_question"><span class="huge-number">{{$key}}.</span>
                <?php
                echo strip_tags($question->content, "<u>");
                ?>
        </span>
        </div>
        <div class="col-lg-12">
            @foreach($question->suggest_choose as $suggest)
                <div class="col-lg-4">

                <div class="form-group">

                    <label class="checkbox-inline">
                        <input type="checkbox">{{$suggest}}
                    </label>
                </div>
                </div>

            @endforeach
        </div>

    @endforeach

</div>
