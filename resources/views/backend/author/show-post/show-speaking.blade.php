<div class="row" id="wrap_add_speaking">
    <div class="col-lg-12 col_add_speaking">

        <!-- Advanced Tables -->
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="table-responsive" id="wrap-content-exam-{{$key_idx}}">

                    <div class="form-group">
                                <textarea type="text" class="form-control"
                                          name="speaking[{{$key_idx}}][content-speaking]"
                                          placeholder="{{trans('label.backend.author.speaking.create.placeholder')}}"
                                          required>{{$record->content}}</textarea>
                    </div>

                    @if($record->url_mp3 != null)
                        <audio controls>
                            <source src="/{{$record->url_mp3}}" type="audio/mpeg">
                        </audio>
                    @else
                        <p style="font-weight: 700;">{{trans('label.backend.post_details.default-audio-gg')}}</p>
                        {{--//Audio is created by GG API--}}
                    @endif

                    <div class="form-group">
                        <label>{{trans('label.backend.post_details.change-audio')}}: </label>
                        {{ Form::file('speaking['.$key_idx.'][audio]', array()) }}
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!--End Advanced Tables -->
</div>
