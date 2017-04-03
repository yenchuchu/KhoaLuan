@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">Posts</h1>
@stop
@section('style')
    <style>
        .navbar-custom {
            padding: 10px 0;
        }

        a > img {
            width: 100%;
        }

        .main-body {
            margin: 30px 15px 10px;
            overflow: hidden;
            padding: 10px 10px;
            margin-bottom: 90px;
        }

    </style>
@stop

@section('content')
    <section id="dashboard-index-wrap">
        <div class="">
            <div class="row">
                <div class="main-body">

                    @foreach($all_posts as $skill => $posts)
                        <div class="col-lg-6">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Manager {{$skill}} skill's posts
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive" id="reload-table-manager-own_posts_{{$skill}}">
                                        <table class="table table-hover" id="manager_own_posts_{{$skill}}">
                                            <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Date</th>
                                                <th>Link</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($posts as $post)
                                                <tr class="odd gradeX">
                                                    <td></td>
                                                    <td>{{Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</td>
                                                    <td>
                                                        <!-- nút xóa gửi ajax lên sau đó remove cả dòng role này đi (thẻ tr) -->
                                                        <a class="btn btn-sm btn-danger" id="post_{{$post->id}}"
                                                           target="_blank"
                                                           href="{{route('backend.manager.author.post.detail',[$post->table, $post->id])}}">
                                                            <i class="fa fa-eye" data-toggle="tooltip"
                                                               data-placement="top"
                                                               title="View"> </i>
                                                        </a>
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
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script>
        setTableInit('manager_own_posts_listen');
        setTableInit('manager_own_posts_speak');
        setTableInit('manager_own_posts_read');
    </script>

@stop
