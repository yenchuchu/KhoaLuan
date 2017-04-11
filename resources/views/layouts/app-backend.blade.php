<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ config('app.name', 'English App - Free') }}</title>
    <!-- Core CSS - Include with every page cmt-->
    <link href="/backend/assets/plugins/bootstrap/bootstrap.css" rel="stylesheet"/>
    <!--remove asset-->
    <link href="/backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link href="/backend/assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet"/>
    <link href="/backend/assets/css/style.css" rel="stylesheet"/>
    <link href="/backend/assets/css/main-style.css" rel="stylesheet"/>

    <!-- sweet alert -->
    <link rel="stylesheet" href="/sweetalert/dist/sweetalert.css"/>
{{--    <link rel="stylesheet" href="/css/sweet-alert/loader.css"/>--}}
{{--    <link rel="stylesheet" href="/css/sweet-alert/page_loaders.css"/>--}}
{{--    <link rel="stylesheet" href="/css/sweet-alert/sweetalert2.min.css"/>--}}

<!-- Page-Level CSS -->
    <link href="/backend/assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet"/>

    @yield('style')

    <style>
        .menu-top-right > li > a {
            padding: 3px 15px !important;
        }

        #navbar {
            background-color: #4d545d;
            /*background-color: #007ee5;*/
            /*background-color: #27C0D8;*/
        }

        .navbar-default {
            border-color: #4d545d;
            /*border-color: #007ee5;*/
        }

        .menu-top-right {
            padding-top: 8px;
        }

        #page-wrapper {
            background-color: white;
        }

        .user-section {
            margin-top: 0px !important;
            font-size: 22px;
            background-color: rgb(83, 163, 163);
        }

        .splitter {
            display: block;
            background-color: #D6E6EC;
            height: 1px;
            margin: .25em 1em .25em 1em;
        }

        .dataTables_filter {
            float: right;
            margin-bottom: 10px;
        }

        .dataTables_length {
            margin-bottom: 10px;
        }

        .paging_simple_numbers {
            float: right;
        }

        .huge-null {
            background: #d9534f;
            padding: 3px 7px;
            border-radius: 6px;
            color: white;
            font-weight: 600;
        }

        .huge-done {
            background: #04b173;
            padding: 3px 7px;
            border-radius: 6px;
            color: white;
            font-weight: 600;
        }

        /* custom avatar */
        .dropbtn {
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        /*@media screen and (min-width: 769px){*/
        /*#dropdown-menu-top {*/
        /*position: relative;*/
        /*}*/
        /*}*/

        #dropdown-menu-top {
            position: relative;
            display: inline-block;
            left: 78%;
            margin-top: 15px;
        }

        .dropdown-content {
            margin-top: 4px;
            display: none;
            position: relative;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 100;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        #dropdown-menu-top:hover .dropdown-content {
            display: block;
        }

        #dropdown-menu-top:hover .dropbtn {
            text-decoration: none;
        }

        #avatar_img {
            width: 40px;
            height: 40px;
            position: relative;
            top: -2px;
            margin-right: 6px;
            border-radius: 14%;
        }

        .name_app_brand {
            color: white !important;
            font-weight: 700;
            font-size: 17px !important;;
        }

        .guest-app {
            background: #00b1b3;
            padding: 20px 31px;
            font-size: 16px;
        }

        .breadcrumb {
            background-color: transparent;
            border-bottom: 1px solid #eeeeee;
            margin-top: 30px;
        }

        .bread-active {
            font-size: 27px;
            color: black;
        }

        .bread-active:hover {
            text-decoration: none;
            color: black;
            cursor: text;
        }

    </style>

</head>
<body>
<!--  wrapper -->
<div id="wrapper">
    <!-- navbar top -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">

        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand name_app_brand" href="{{route('backend.manager.author.index')}}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <!-- end navbar-header -->
        <!-- navbar-top-links -->
    @include('partials.menu-top-right')
    <!-- end navbar-top-links -->

    </nav>
    <!-- end navbar top -->

    <!-- navbar side -->
{{--@include('partials.menu-left-backend')--}}
<!-- end navbar side -->

    <!--  page-wrapper -->
    <div id="page-wrapper" class="container">

        <div class="loader class-loader-css1" id="id-loader-css1"
             style="display: none;margin: 4% auto 0px 38%;z-index: 1;float: left;position: fixed;animation: spin 1s linear infinite;">
            <div class="loader-inner ball-spin-fade-loader">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        <div class="row">
            <!-- Page Header -->
            <div class="col-lg-12">
                @yield('header')
            </div>
            <!--End Page Header -->
        </div>

        @include('errors.errors')
        @yield('content')

    </div>
    <!-- end page-wrapper -->

</div>
<!-- end wrapper -->

<!-- Core Scripts - Include with every page -->
<script src="/backend/assets/plugins/jquery-1.10.2.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="/backend/assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="/backend/assets/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/backend/assets/plugins/pace/pace.js"></script>
<!-- Page-Level Plugin Scripts-->
<script src="/backend/assets/plugins/morris/raphael-2.1.0.min.js"></script>

{{-- set dataTable--}}
<script src="/table/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/table/datatables/media/js/dataTables.bootstrap.min.js"></script>

<script src="/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-messaging.js"></script>

<!-- Leave out Storage -->
<!-- <script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-storage.js"></script> -->

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Cache-Control': 'no-cache',
            'Pragma': 'no-cache'
        }
    });

    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyDGy7M0b1gqm7bo9ly7XmZcI2PqBH6h9BE",
        authDomain: "englishtest-9ce81.firebaseapp.com",
        databaseURL: "https://englishtest-9ce81.firebaseio.com",
        projectId: "englishtest-9ce81",
        storageBucket: "englishtest-9ce81.appspot.com",
        messagingSenderId: "163105165893"
    };
    firebase.initializeApp(config);

    var database = firebase.database();

    var user_auth_id = '{{Auth::user()->id}}';
    //    console.log(user_auth_id);
    // Find all dinosaurs whose height is exactly 25 meters.
    var ref = database.ref("notification/" + user_auth_id);

    ref.on("value", function (snap) {
        $('#alert_notifications').text('');
        var count_noti = [];
        var sort = [];

        var all_data = snap.val();

        var count = 0;
        for (var prop in all_data) {
            if (!all_data.hasOwnProperty(prop)) continue;

            var end_obj = all_data[prop];
            sort.push(end_obj);

            count++;
        }

        sort.sort(function (x, y) {
            var xDate = new Date(x.created_at);
            var yDate = new Date(y.created_at);

            return yDate - xDate;
        });
//        console.log("document.URL : "+document.URL);
//        console.log("document.location.href : "+document.location.href);
//        console.log("document.location.origin : "+document.location.origin);
//        console.log("document.location.hostname : "+document.location.hostname);
//        console.log("document.location.host : "+document.location.host);
//        console.log("document.location.pathname : "+document.location.pathname);
        if (count >= 5) {

            for (var sort_noti = 0; sort_noti < 5; sort_noti++) {
                var noti_obj = sort[sort_noti];
                var path_ava = document.location.origin + noti_obj['url_avatar_user'];
//                var path_ava = document.location.origin + '/allProjects/KhoaLuan/KLTN-EnglishTest/public/' + noti_obj['url_avatar_user'];

                $('#alert_notifications').append('<li>' +
                        '<a href="' + noti_obj['url'] + '" target="_blank">' +
                        '<div>' +
                        '<img src="' + path_ava + '" style="height: 34px; margin-right: 10px">' +
                        ' <span>' + noti_obj['content'] + '</span>' +
                        '<span class="pull-right text-muted small"> at ' + noti_obj['created_at'] + '</span>' +
                        '</div>' +
                        '</a>' +
                        '</li>' +
                        '<li class="divider"></li>');
            }

            var path_to_all_noti = '{{route("backend.manager.backend.all.noti")}}';
            $('#alert_notifications').append('<li id="see-all">' +
                    '<a class="text-center" href="'+path_to_all_noti+'">' +
                    '<strong>See All Alerts</strong>' +
                    '<i class="fa fa-angle-right"></i>' +
                    '</a>' +
                    '</li>');
        } else if (count < 5 && count > 0) {
            for (var sort_noti in sort) {
                if (!sort.hasOwnProperty(sort_noti)) continue;
                var noti_obj = sort[sort_noti];
                var path_ava = document.location.origin + '/allProjects/KhoaLuan/KLTN-EnglishTest/public/' + noti_obj['url_avatar_user'];

                $('#alert_notifications').append('<li>' +
                        '<a href="' + noti_obj['url'] + '" target="_blank">' +
                        '<div>' +
                        '<img src="' + path_ava + '" style="height: 34px; margin-right: 10px">' +
                        ' <span>' + noti_obj['content'] + '</span>' +
                        '<span class="pull-right text-muted small"> at ' + noti_obj['created_at'] + '</span>' +
                        '</div>' +
                        '</a>' +
                        '</li>' +
                        '<li class="divider"></li>');
            }
        } else {
            $('#alert_notifications').append('<li>' +
                    '<p style="text-align: center; margin-top: 10px;"> No notification </p>' +
                    '</li>');
        }

        ref.orderByChild("status").equalTo('0').on("child_added", function (snapshot) {
            count_noti.push(snapshot.val());

            $('#read-noti').click(function () {
                firebase.database().ref("notification/" + user_auth_id + "/" + snapshot.key + "/status").set('1');
            });
        });

        var noti_length = count_noti.length;
        if (noti_length > 0) {
            $('#sum-noti-admin').text(noti_length);
        } else {
            $('#sum-noti-admin').text('');
        }
    });

</script>

@if(Session::has('notification_new'))
    <?php $post_data = Session::get('notification_new');

    foreach ($post_data['user_id_receive'] as $user_id) { ?>

    <script>
        //       A post entry.var
        postData = {
            status: '0',
            created_at: '{{$post_data["created_at"]}}',
            url_avatar_user: '{{$post_data["url_avatar_user"]}}',
            url: '{{$post_data["url"]}}',
            content: '{{$post_data["content"]}}'
        };

        //      Get a key for a new Post.
        var newPostKey = firebase.database().ref().child('notification/{{$user_id}}').push(postData).key;
    </script>

    <?php } ?>

@endif

<script>
    function setTableInit(table_id) {
        var set_name = 'manager_set' + table_id;
        set_name = $('#' + table_id).DataTable({
            responsive: true,
            language: {
                "sProcessing": "Đang xử lý...",
                "sLengthMenu": "Xem _MENU_ bản ghi",
                "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ bản ghi",
                "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 bản ghi",
                "sInfoFiltered": "(được lọc từ _MAX_ bản ghi)",
                "sInfoPostFix": "",
                "sSearch": "Tìm kiếm:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Đầu",
                    "sPrevious": "Trước",
                    "sNext": "Tiếp",
                    "sLast": "Cuối"
                }
            },
            aLengthMenu: [
                [10, 30, 60, 100, -1],
                [10, 30, 60, 100, "All"]
            ],
            iDisplayLength: 10,
//            "order": [[1, 'asc']]
        });

        set_name.on('order.dt search.dt', function () {
            set_name.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    }

    function redirect_post_detail(table, array_id) {
        url = '{{route('backend.manager.author.post.detail')}}';
        CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: url,
            type: "post",
            data: {
                table: table,
                array_id: array_id,
                _token: CSRF_TOKEN
            },
            success: function (data) {
                if (data.code == 404) {
                    swal('', data.message, 'error').catch(swal.noop);
                    return false;
                } else if (data.code == 200) {
                    window.location = document.getElementById('href_' + skill_code).href;

                }
            },
            error: function () {
                swal('', 'Không thực hiện được hành động này!', 'error');
            }
        });
    }

    setTimeout(function () {
        $(".alert-success").hide();
    }, 5000);

</script>

@yield('script')

</body>

</html>
