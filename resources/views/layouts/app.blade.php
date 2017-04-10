<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'English App - Free') }}</title>

{{--<title>English App - Free</title>--}}

<!-- Bootstrap Core CSS -->
    <link href="{{URL::asset('backend/assets/plugins/bootstrap/bootstrap.css')}}" rel="stylesheet"/>

    <!-- My CSS -->
    <link href="{{URL::asset('frontend/mystyle.css')}}" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="{{URL::asset('frontend/theme_css/css/freelancer.min.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{URL::asset('backend/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
          type="text/css">

    <!-- sweet alert -->
    {{--<link rel="stylesheet" href="{{URL::asset('css/sweet-alert/loader.css')}}"/>--}}
    {{--<link rel="stylesheet" href="{{URL::asset('css/sweet-alert/page_loaders.css')}}"/>--}}
    <link rel="stylesheet" href="{{URL::asset('sweetalert/dist/sweetalert.css')}}"/>

<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    @yield('style')
    @yield('style-menu-main')

    <style>
        #menu-nav-top {
            background-color: #4d545d;
            margin-bottom: -1px;
            height: 60px;
        }

        #menu-nav-top .navbar-brand,
        #menu-nav-top #username-auth,
        .guest-app > a {
            color: white !important;
        }

        #username-auth:focus,
        #username-auth:active {
            text-decoration: none;
        }

        #menu-nav-top .nav a:hover,
        #menu-nav-top .nav a:active {
            background-color: #2aadda;
        }

        #nav-bottom-tab {
            background-color: #f6f6f6;
            height: 55px;
            z-index: 40;
            margin-bottom: 30px;
        }

        .navbar-default .navbar-nav > .active > a,
        .navbar-default .navbar-nav > .active > a:hover,
        .navbar-default .navbar-nav > .active > a:focus,
        .navbar-default .navbar-nav > li > a:hover{
            color: white !important;
            background: #00b1b3;
            border-right: 1px solid #00989a;
        }

        #ul-menu-main>li {
            background: #f6f6f6;
            border-left: 1px solid #d7d7d7;
            /*border-right: 1px solid transparent;*/

        }

        #ul-menu-main li a {
            color: #7d8793;
            padding: 15px 42px;
            font-size: 16px;
            height: 54px;
        }

        .img-icon {
            float: left;
            margin-top: -3px;
            margin-right: 15px;
        }

        .img-icon>i {
            font-size: 24px;
        }

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
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 100;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}

        #dropdown-menu-top:hover .dropdown-content {
            display: block;
        }

        #dropdown-menu-top:hover .dropbtn {
           text-decoration: none;
        }

        #avatar_img {
            width: 40px;
            height: 40px;
            border-radius: 5%;
            position: relative;
            top: -5px;
        }

        .guest-app>a {
            padding: 20px 31px !important;
            font-size: 16px;
        }
        .guest-app>a:hover {
            background: #00b1b3 !important;
            padding: 20px 31px;
            font-size: 16px;
        }

    </style>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top" id="menu-nav-top">
        <div class="container">
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
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            @include('partials.menu-top-right')
        </div>
    </nav>
    @yield('menu-main')
    <div class="container">

        @include('errors.errors')
    </div>
    @yield('content')


</div>

<!-- Core Scripts - Include with every page -->
<script src="{{URL::asset('backend/assets/plugins/jquery-1.10.2.js')}}"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{URL::asset('backend/assets/plugins/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('backend/assets/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{URL::asset('backend/assets/plugins/pace/pace.js')}}"></script>
<!-- Page-Level Plugin Scripts-->
<script src="{{URL::asset('backend/assets/plugins/morris/raphael-2.1.0.min.js')}}"></script>

{{-- set dataTable--}}
<script src="{{URL::asset('table/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('table/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>

<script src="{{URL::asset('sweetalert/dist/sweetalert.min.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Cache-Control': 'no-cache',
            'Pragma': 'no-cache'
        }
    });
</script>

<!-- Scripts -->
{{--<script src="{{URL::asset('js/app.js')}}"></script>--}}

<script>

    var CSRF_TOKEN_MENU = $('meta[name="csrf-token"]').attr('content');

    function redirect_to_test(level_id) {
        {{--url = '{{ route('frontend.dashboard.student.redirect') }}';--}}
        $.ajax({
            url: url,
            type: "get",
            data: {
                level_id: level_id,
                _token: CSRF_TOKEN_MENU
            },
            success: function (data) {
                if (typeof data.code != 'undefined') {
                    $('#refresh-page-testing').html(data);
                } else if (data.code == 404 || data.code == 32) {
                    swal('', data.message, 'error').catch(swal.noop);
                    return false;
                }
            },
            error: function () {
                swal('', 'Không thực hiện được hành động này!', 'error');
            }
        });
    }

    function setTableInitStudent(table_id) {
        var set_name = 'manager_set' + table_id;
        set_name = $('#'+ table_id).DataTable({
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

//        set_name.on('order.dt search.dt', function () {
//            set_name.column(0, {
//                search: 'applied',
//                order: 'applied'
//            }).nodes().each(function (cell, i) {
//                cell.innerHTML = i + 1;
//            });
//        }).draw();
    }

    $('#btn-done-loginfb').click(function () {

        var type_user = $("input[name='office_type']:checked").val();
        if(type_user == 'ST') {
            var class_id = $("#class-choose option:selected" ).val();
            if(class_id == 0) {
                alert('Bạn phải chọn lớp');
                return false;
            }
        }
    });

</script>
@yield('script')

</body>
</html>
