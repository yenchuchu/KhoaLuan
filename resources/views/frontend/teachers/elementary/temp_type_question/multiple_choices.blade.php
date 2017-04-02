@foreach($content_json as $key => $question)
<div class="row wrap_question_details content">
    <div class="col-lg-12" style="padding-left: 0px;">
        <span class="content_question"><span class="huge-number">{{$key}}.</span> {{$question->content}}</span>
    </div>

    <div class="col-lg-12 suggest_asnwer_questions">
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
</div>
@endforeach
