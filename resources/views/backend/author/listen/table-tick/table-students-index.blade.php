<table class="table table-hover" id="manager_listen_table_ticks_students">
    <thead>
    <tr>
        <th>STT</th>
        <th>{{trans('label.backend.table.class')}}</th>
        <th>{{trans('label.backend.table.level')}}</th>
        <th>{{trans('label.backend.table.link')}}</th>
        <th>{{trans('label.backend.table.date')}}</th>
        <th>{{trans('label.backend.table.status')}}</th>
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
                <?php
                if(!empty($item['level_id'])) {
                    $level = \App\Level::where(['id' => $item['level_id'][0]])->first();
                    echo $level->title;
                } else { ?>
                <span class="huge-null">null</span>
                <?php } ?>
            </td>
            <td>

                <a href="{{route('backend.manager.author.get.detail', ['listen_table_ticks' , Auth::user()->id, $item['id']])}}">
                    {{trans('label.backend.table.go_to_link')}}</a>

            </td>
            <td>{{Carbon\Carbon::parse($item['created_at'][0])->format('d/m/Y - H:i')}}</td>
            <td><?php
                if($item['status'][0] == 0) { ?>
                <span class="huge-null">{{trans('label.backend.table.wait')}}</span>
                <?php } else if($item['status'][0] == 1) { ?>
                <span class="huge-done">{{trans('label.backend.table.done')}}</span>
                <?php } ?></td>
        </tr>
    @endforeach

    </tbody>
</table>