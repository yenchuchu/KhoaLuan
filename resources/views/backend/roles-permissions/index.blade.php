@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">Manager Roles</h1>
@stop
@section('content')

    <div class="row">
        <div class="col-lg-6">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Roles Tables
                </div>
                <div class="panel-body">
                    <div class="table-responsive" id="reload-table-manager-roles">
                        @include('backend.roles-permissions.table-roles-index')
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
        <div class="col-lg-6">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Permission Tables
                </div>
                <div class="panel-body">
                    <div class="table-responsive" id="reload-table-manager-permissions">
                        @include('backend.roles-permissions.table-permissions-index')
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>

@stop

@section('script')
    <script>
        setTableInit('manager_roles');
        setTableInit('manager_permissions');
    </script>

    @include('backend.roles-permissions.script-roles')
    @include('backend.roles-permissions.script-permissions')
@stop
