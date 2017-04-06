<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ config('app.name', 'English App - Free') }}</title>
    <!-- Core CSS - Include with every page -->
    <link href="{{URL::asset('backend/assets/plugins/bootstrap/bootstrap.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('backend/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('backend/assets/plugins/pace/pace-theme-big-counter.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('backend/assets/css/style.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('backend/assets/css/main-style.css')}}" rel="stylesheet"/>

    <!-- sweet alert -->
    <link rel="stylesheet" href="{{URL::asset('sweetalert/dist/sweetalert.css')}}"/>
{{--    <link rel="stylesheet" href="{{URL::asset('css/sweet-alert/loader.css')}}"/>--}}
{{--    <link rel="stylesheet" href="{{URL::asset('css/sweet-alert/page_loaders.css')}}"/>--}}
{{--    <link rel="stylesheet" href="{{URL::asset('css/sweet-alert/sweetalert2.min.css')}}"/>--}}

<!-- Page-Level CSS -->
    <link href="{{URL::asset('backend/assets/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet"/>

    @yield('style')

    <style>
        .menu-top-right > li > a {
            padding: 3px 15px !important;
        }

        #navbar {
            background-color: #27C0D8;
        }

        .navbar-default {
            border-color: #27C0D8;
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

    </style>

</head>
<body>
<!--  wrapper -->
<div id="wrapper">
    <!-- navbar top -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
        <!-- navbar-header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="{{URL::asset('backend/assets/img/logo.png')}}" alt=""/>
            </a>
        </div>
        <!-- end navbar-header -->
        <!-- navbar-top-links -->
    @include('partials.menu-top-right')
    <!-- end navbar-top-links -->

    </nav>
    <!-- end navbar top -->

    <!-- navbar side -->
@include('partials.menu-left-backend')
<!-- end navbar side -->

    <!--  page-wrapper -->
    <div id="page-wrapper">

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
<script src="{{URL::asset('backend/assets/plugins/jquery-1.10.2.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{URL::asset('backend/assets/plugins/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('backend/assets/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{URL::asset('backend/assets/plugins/pace/pace.js')}}"></script>
<!-- Page-Level Plugin Scripts-->
<script src="{{URL::asset('backend/assets/plugins/morris/raphael-2.1.0.min.js')}}"></script>

{{-- set dataTable--}}
<script src="{{URL::asset('table/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('table/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>

<script src="{{URL::asset('sweetalert/dist/sweetalert.min.js')}}"></script>

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

    //    var starCountRef = database.ref('notification/');

    // Find all dinosaurs whose height is exactly 25 meters.
    var ref = database.ref("notification");

    ref.on("value", function (snap) {
        var count_noti = [];
        var all_data = snap.val();
        for (var prop in all_data) {
            if (!all_data.hasOwnProperty(prop)) continue;

            var end_obj = all_data[prop];
            ref_child = database.ref("notification/" + prop);
            ref_child.orderByChild("status").equalTo('0').on("child_added", function (snapshot) {
//                console.log(snapshot.val());
                count_noti.push(snapshot.val());
            });
        }

        var noti_length = count_noti.length;
        $('#sum-noti-admin').text(noti_length);
        count_noti.sort(function (x, y) {
            var xDate = new Date(x.created_at);
            var yDate = new Date(y.created_at);

            return yDate - xDate;
        });
        if (noti_length > 10) {
            for(var i = 0; i<= 9; i++) {
                console.log(count_noti[i]);
                $('#alert_notifications').append('<li>' +
                '<a href="#">' +
                        '<div>' +
                        '<i class="fa fa-comment fa-fw"></i>New Comment' +
                '<span class="pull-right text-muted small">4 minutes ago</span>' +
                '</div>' +
                '</a>' +
                '</li>' +
                '<li class="divider"></li>');
            }

            $('#alert_notifications').append('<li id="see-all">' +
                    '<a class="text-center" href="#">' +
                    '<strong>See All Alerts</strong>' +
                    '<i class="fa fa-angle-right"></i>' +
                    '</a>' +
                    '</li>');
        } else {
            for(noti in count_noti) {
                if (!count_noti.hasOwnProperty(noti)) continue;

                var end_obj = count_noti[noti];
                $('#alert_notifications').append('<li>' +
                        '<a href="' + end_obj['url'] + '" target="_blank">' +
                        '<div>' +
                        '<img src="' + end_obj['url_avatar_user'] + '" style="height: 34px; margin-right: 10px">' +
                         ' <span>' + end_obj['content'] + '</span>' +
                        '<span class="pull-right text-muted small"> at ' + end_obj['created_at'] + '</span>' +
                        '</div>' +
                        '</a>' +
                        '</li>' +
                        '<li class="divider"></li>');
            }
        }
    });

</script>

@if(Session::has('notification_new'))
    <?php $post_data = Session::get('notification_new'); ?>

    <script>
        //       A post entry.var
        postData = {
            status: '{{$post_data["status"]}}',
            created_at: '{{$post_data["created_at"]}}',
            url_avatar_user: '{{$post_data["url_avatar_user"]}}',
            url: '{{$post_data["url"]}}',
            content: '{{$post_data["content"]}}'
        };

        //      Get a key for a new Post.
        var newPostKey = firebase.database().ref().child('notification/{{$post_data["user_id"]}}').push(postData).key;
        //        console.log(newPostKey);
    </script>
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


    //    starCountRef.on("value", function(snap) {
    //        var all_data = snap.val();
    //        var notification = [];
    //        for (var prop in all_data) {
    //            // skip loop if the property is from prototype
    //            if (!all_data.hasOwnProperty(prop)) continue;
    //
    //            var end_obj = all_data[prop];
    //            for (var item in end_obj) {
    //                console.log(end_obj);
    //                // skip loop if the property is from prototype
    //                if (!end_obj.hasOwnProperty(item)) continue;
    //
    //                if(end_obj['status'] == 0) {
    //                    notification.push(end_obj);
    //                }
    ////                console.log(end_obj['status']);.length
    //            }
    //        }
    //        console.log(notification);
    //    });


</script>

@yield('script')

</body>

</html>
