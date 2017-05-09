@extends('layouts.app')

@section('style-menu-main')
    <style>
        #home-id .col-lg-6 {
            margin-right: 20px;
        }

        #home-id .col-lg-6,
        #home-id .col-lg-5 {
            background: #fafaf3;
            padding-top: 16px;
            padding-bottom: 16px;
        }

        div#manager_results_users_filter label {
            text-align: right;
            width: 100%;
        }

        /*div#manager_results_users_filter input {*/
            /*margin-left: 10px;*/
            /*width: 65%;*/
        /*}*/

        .dataTables_filter input {
            width: 59% !important;
        }

        .table {
            margin-top: 10px;
        }

    </style>
@stop

@section('menu-main')
    @include('frontend.student.partials.menu-main')
@stop

@section('content')
    <div class="container" style="padding-left: 0">
        <div><h3>{{ trans('label.frontend.heading.result')  }}</h3></div>
        <div class="row">
            <div class="col-lg-4">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('label.skills.title.read')  }} / {{ trans('label.skills.title.scale')  }} 30
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive" id="reload-table-results">
                            <table class="table table-hover" id="manager_results_users">
                                <thead>
                                <tr>
                                    <th>{{ trans('label.skills.title.order')  }}</th>
                                    <th align="center">{{ trans('label.skills.title.point')  }}</th>
                                    <th align="center">{{ trans('label.skills.title.date')  }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($all_results['Read'] as $results)
                                    <tr class="odd gradeX">
                                        <td>{{$results->test_id}}</td>
                                        <td>{{$results->point}}</td>
                                        <td>{{Carbon\Carbon::parse($results->created_at)->format('d/m/Y - H:i')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>

            {{--LISTENING--}}
            <div class="col-lg-4">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('label.skills.title.listen')  }} / {{ trans('label.skills.title.scale')  }} 30
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive" id="reload-table-listening-results">
                            <table class="table table-hover" id="manager_results_listening_users">
                                <thead>
                                <tr>
                                    <th>{{ trans('label.skills.title.order')  }}</th>
                                    <th align="center">{{ trans('label.skills.title.point')  }}</th>
                                    <th align="center">{{ trans('label.skills.title.date')  }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($all_results['Listen'] as $results)
                                    <tr class="odd gradeX">
                                        <td>{{$results->test_id}}</td>
                                        <td>{{$results->point}}</td>
                                        <td>{{Carbon\Carbon::parse($results->created_at)->format('d/m/Y - H:i')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>

            {{--Speaking--}}
            <div class="col-lg-4">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('label.skills.title.speak')  }} / {{ trans('label.skills.title.scale')  }} 10
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive" id="reload-table-speaking-results">
                            <table class="table table-hover" id="manager_results_speaking_users">
                                <thead>
                                <tr>
                                    <th>{{ trans('label.skills.title.order')  }}</th>
                                    <th align="center">{{ trans('label.skills.title.point')  }}</th>
                                    <th align="center">{{ trans('label.skills.title.date')  }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($all_results['Speak'] as $results)
                                    <tr class="odd gradeX">
                                        <td>{{$results->test_id}}</td>
                                        <td>{{$results->point}}</td>
                                        <td>{{Carbon\Carbon::parse($results->created_at)->format('d/m/Y - H:i')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>

    </div>
@stop

@section('script')

    <script type="text/javascript">
        setTableInitStudent('manager_results_users');
        setTableInitStudent('manager_results_listening_users');
        setTableInitStudent('manager_results_speaking_users');
    </script>

@stop
