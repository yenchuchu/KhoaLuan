@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">Dashboard</h1>
@stop
@section('content')

    <div class="row">
        @include('backend.users.table-index')
    </div>

@stop

@section('script')
    <script>
        setTableInit('manager_users_student')
        setTableInit('manager_users_author')
        setTableInit('manager_users_admin')
    </script>

    @include('backend.users.script-users')
@stop
