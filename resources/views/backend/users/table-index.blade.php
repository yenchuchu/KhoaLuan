<div class="col-lg-12">
    <!-- Advanced Tables -->
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ trans('label.backend.admin.manager_student')  }}
        </div>
        <div class="panel-body">
            <div class="table-responsive" id="reload-table-manager-users">
                <table class="table table-hover" id="manager_users_student">
                    <thead>
                    <tr>
                        <th>{{ trans('label.backend.admin.table.order')  }}</th>
                        <th>{{ trans('label.backend.admin.table.full_name')  }}</th>
                        <th>{{ trans('label.backend.admin.table.email')  }}</th>
                        <th>{{ trans('label.backend.admin.table.class')  }}</th>
                        <th>{{ trans('label.backend.admin.table.action')  }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user_student as $user)

                        <tr class="odd gradeX">
                            <td></td>
                            <td>{{$user->full_name}}</td>
                            <td>{{$user->email}}</td>
                            <td class="center">
                                <?php $class = $user->classes()->first();
                                if($class != null) { ?>
                                {{$class->title}}
                                <?php } else { ?>
                                <span class="huge-null">Lớp 3</span>
                                <?php } ?>
                            </td>
                            <td>

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
            </div>

        </div>
    </div>
    <!--End Advanced Tables -->
</div>

<div class="col-lg-12">
    <!-- Advanced Tables -->
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ trans('label.backend.admin.manager_author')  }}
        </div>
        <div class="panel-body">
            <div class="table-responsive" id="reload-table-manager-users">
                <table class="table table-hover" id="manager_users_author">
                    <thead>
                    <tr>
                        <th>{{ trans('label.backend.admin.table.order')  }}</th>
                        <th>{{ trans('label.backend.admin.table.full_name')  }}</th>
                        <th>{{ trans('label.backend.admin.table.email')  }}</th>
                        <th>{{ trans('label.backend.admin.table.action')  }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user_author as $user)

                        <tr class="odd gradeX">
                            <td></td>
                            <td>{{$user->full_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>

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
            </div>

        </div>
    </div>
    <!--End Advanced Tables -->
</div>

<div class="col-lg-12">
    <!-- Advanced Tables -->
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ trans('label.backend.admin.manager_admin')  }}
        </div>
        <div class="panel-body">
            <div class="table-responsive" id="reload-table-manager-users">
                <table class="table table-hover" id="manager_users_admin">
                    <thead>
                    <tr>
                        <th>{{ trans('label.backend.admin.table.order')  }}</th>
                        <th>{{ trans('label.backend.admin.table.full_name')  }}</th>
                        <th>{{ trans('label.backend.admin.table.email')  }}</th>
                        <th>{{ trans('label.backend.admin.table.action')  }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user_admin as $user)

                        <tr class="odd gradeX">
                            <td></td>
                            <td>{{$user->full_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
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
            </div>

        </div>
    </div>
    <!--End Advanced Tables -->
</div>