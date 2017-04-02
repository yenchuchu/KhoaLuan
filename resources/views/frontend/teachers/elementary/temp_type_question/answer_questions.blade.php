<div class="row wrap_question_details content">
    <div class="col-lg-12" style="padding-left: 0px; margin-bottom: 15px;">
        <span class="">{{$contents_exam}}</span>
    </div>

    @foreach($content_json as $key => $question)
        <div class="col-lg-12" style="padding-left: 0px;">
            <span class="content_question"><span class="huge-number">{{$key}}.</span> {{$question->content}}</span>
        </div>

        <div class="col-lg-12 suggest_asnwer_questions">
            <div class="form-group">
                ................................................................................................................
            </div>
        </div>
    @endforeach

</div>
