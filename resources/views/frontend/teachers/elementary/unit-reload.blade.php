<div class="form-group">
    <span class="control-label label-bold" style="line-height: 22px;"><b>CHỌN UNIT</b>
        <span class="point-start">*</span></span>
</div>

@if(count($book_maps) == 0)
    <p style="font-size: 14px; color: red;">Chưa cập nhật unit</p>
@else

    @foreach($book_maps as $book_map)

        <div class="form-group bookmap_form">
            <input type="checkbox" name="book_map_id[]" id="bookmap_{{$book_map->id}}" value="{{$book_map->id}}">
            <label for="bookmap_{{$book_map->id}}">{{$book_map->title}}</label>
        </div>

    @endforeach

@endif
