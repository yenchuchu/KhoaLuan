@if(isset($examtype_skills))
    <div class="form-group">
    <span class="control-label label-bold" style="line-height: 22px;"><b>CHỌN DẠNG BÀI</b>
        <span class="point-start">*</span></span>
    </div>

    @if( count($examtype_skills) == 0)
        <p style="font-size: 14px; color: red;">Chưa cập nhật dạng bài</p>
    @else

        @foreach($examtype_skills as $key => $item)

            <div class="form-group examtype_skill_form">
                <input type="checkbox" name="examtype_skills[]" id="examtype_skills_{{$key}}" value="{{$key}}">
                <label for="examtype_skills_{{$key}}">{{$item}}</label>
            </div>

        @endforeach

    @endif
@endif