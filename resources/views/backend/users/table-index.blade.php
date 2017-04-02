<table class="table table-hover" id="manager_users">
    <thead>
    <tr>
        <th>STT</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th>Class</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr class="odd gradeX">
            <td></td>
            <td>{{$user->full_name}}</td>
            <td>{{$user->email}}</td>
            <td class="center">
                <?php
                $roles = $user->roles()->get();
                foreach ($roles as $role) {
                    echo $role->name . '<br>';
                }
                ?>
            </td>
            <td class="center">
                <?php
                $class = $user->classes()->first();
                echo $class->title;
                ?>
            </td>
            <td>
                <!-- nút hiện form sửa -->
                <button class="btn btn-sm btn-primary" id="btn-edit-school">
                    <a href="#" target="_blank" title="Edit">
                        <i class="fa fa-pencil" style="color: white" data-toggle="tooltip"
                           data-placement="top" title="Edit"></i>
                    </a>
                </button>

                <!-- Thêm user manager/admin cho schools -->

                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-users" data-toggle="tooltip" data-placement="top"
                           style="color: white" title="Add managers"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="#" title="Add roles " data-toggle="modal"
                               data-target="#connect-user-admin"
                               onclick="">Add User
                                Admin
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- nút xóa gửi ajax lên sau đó remove cả dòng role này đi (thẻ tr) -->
                <button class="btn btn-sm btn-danger" id="user_{{$user->id}}" title="Delete"
                        onclick="deleteUser({{$user->id}})">
                    <i class="fa fa-times" data-toggle="tooltip" data-placement="top"
                       title="Delete"> </i>
                </button>

            </td>
        </tr>
    @endforeach

    </tbody>
</table>