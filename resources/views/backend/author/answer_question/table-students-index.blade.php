<table class="table table-hover" id="manager_answer_questions_students">
    <thead>
    <tr>
        <th>STT</th> 
        <th>Class</th>
        <th>Level</th>
        <th>Link</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($array_id_intypecode as $item)
        <tr class="odd gradeX">
            <td></td> 
             <td>
                 <?php
                 if(!empty($item['class_id'])) {
                     $class = \App\Classes::where(['id' => $item['class_id'][0]])->first();
                     echo $class->title;
                  } else { ?>
                 <span class="huge-null">null</span>
                 <?php } ?>
             </td>
             <td>
{{--                 <div id="array_item_id">{{json_encode}}</div>--}}
                 <?php
                 if(!empty($item['level_id'])) {
                     $level = \App\Level::where(['id' => $item['level_id'][0]])->first();
                     echo $level->title;
                 } else { ?>
                 <span class="huge-null">null</span>
                 <?php } ?>
                 </td>
            <td>
                 <?php
                $test = json_encode($item['id']);
                ?>
                <a id="" onclick="redirect_post_detail('answer_questions', '{{$test}}')"> Go to link</a>

            </td>
            <td>{{Carbon\Carbon::parse($item['created_at'][0])->format('d/m/Y - H:i')}}</td>
        </tr>
    @endforeach

    </tbody>
</table>