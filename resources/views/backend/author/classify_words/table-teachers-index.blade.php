<table class="table table-hover" id="manager_multiple_choices_teachers">
    <thead>
    <tr>
        <th>STT</th>
        <th>Skill</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ans_for_teachers as $item)
        <tr class="odd gradeX">
            <td></td>
            <td>{{$item->skills->title}}</td>
            <td>
                <!-- nút hiện form sửa -->
                <button class="btn btn-sm btn-primary" id="btn-edit-school">
                    <a href="#" target="_blank" title="Edit">
                        <i class="fa fa-pencil" style="color: white" data-toggle="tooltip"
                           data-placement="top" title="Edit"></i>
                    </a>
                </button>

                <button class="btn btn-sm btn-danger" id="answer_question_{{$item->id}}" title="Delete"
                        onclick="deleteQuestion({{$item->id}})">
                    <i class="fa fa-times" data-toggle="tooltip" data-placement="top"
                       title="Delete"> </i>
                </button>

            </td>
        </tr>
    @endforeach

    </tbody>
</table>