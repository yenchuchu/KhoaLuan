@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">All Notifications</h1>
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

                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script>
//        setTableInit('manager_own_posts_listen');
    </script>

@stop
