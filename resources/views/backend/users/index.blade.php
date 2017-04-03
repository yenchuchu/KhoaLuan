@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">Dashboard</h1>
@stop
@section('content')
<a href="#" onclick="writeUserData('1', 'test')">Set up data</a>
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

    <script>
        // Get a reference to the database service
        var database = firebase.database();

        function writeUserData(notiId, name_table) {
            firebase.database().ref('notification/' + notiId).set({
                name_table: name_table,
                "id": "2",
                    "user_id": "3",
                    "name_table": "answer_questions",
                    "type_code": "2",
                    "id_item": ["3", "4"],
                    "status": "0"
            });
        }

        var starCountRef = firebase.database().ref('notification');
        starCountRef.on('value', function(snapshot) {
            console.log(snapshot.val());
        });
//        https://firebase.google.com/docs/database/web/read-and-write
        console.log(starCountRef);

    </script>
@stop
