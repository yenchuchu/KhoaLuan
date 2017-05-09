<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EStore') }}</title>

{{--<title>English App - Free</title>--}}

<!-- Bootstrap Core CSS change -->
    <link href="/backend/assets/plugins/bootstrap/bootstrap.css" rel="stylesheet"/>

    <!-- My CSS -->
    <link href="/frontend/mystyle.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="/frontend/theme_css/css/freelancer.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
          type="text/css">

    <!-- sweet alert -->
    {{--<link rel="stylesheet" href="/css/sweet-alert/loader.css"/>--}}
    {{--<link rel="stylesheet" href="/css/sweet-alert/page_loaders.css"/>--}}
    <link rel="stylesheet" href="/sweetalert/dist/sweetalert.css"/>
    <link rel="stylesheet" href="/css/loader.css"/>
    <link rel="stylesheet" href="/css/page_loaders.css"/>

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
            padding: 15px 52px;
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

        .change-language {
            float: right;
            margin-top: 18px;
            margin-left: 35px;
        }

        .change-language li {
            list-style: none;
        }
        @if (!Auth::guest())
        @if( Auth::user()->hasRole('AU') ||  Auth::user()->hasRole('ST'))

            .change-language {
                float: right;
                margin-top: 23px;
                position: relative;
                left: 30px;
            }

        .change-language a {
            color: white;
        }
        .change-language a:hover {
            color: #18BC9C;
        }
        @endif
        @endif


    </style>

</head>
<body>
<div id="app">
    @if(Auth::guest())

        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    @if (Auth::guest())
                    <a class="navbar-brand page-scroll" href="{{route('dashboard.design')}}">{{ config('app.name', 'Laravel') }}</a>
                    @else
                        <a class="navbar-brand page-scroll" href="{{route('frontend.dashboard.student.index')}}">{{ config('app.name', 'Laravel') }}</a>
                    @endif
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    @include('partials.menu-top-right')
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    @else
        <nav class="navbar navbar-default navbar-static-top" id="menu-nav-top">
            <div class="container"  style="padding-left: 0">
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
                    <a class="navbar-brand" href="{{route('frontend.dashboard.student.index')}}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                @include('partials.menu-top-right')
            </div>
        </nav>
    @endif

    @yield('menu-main')
    <div class="container" style="padding-left: 0">

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

        @include('errors.errors')
    </div>
    @yield('content')


</div>

<!-- Core Scripts - Include with every page -->
<script src="/backend/assets/plugins/jquery-1.10.2.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="/backend/assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="/backend/assets/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/backend/assets/plugins/pace/pace.js"></script>
<!-- Page-Level Plugin Scripts-->
<script src="/backend/assets/plugins/morris/raphael-2.1.0.min.js"></script>

{{-- set dataTable--}}
<script src="/table/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/table/datatables/media/js/dataTables.bootstrap.min.js"></script>

<script src="/sweetalert/dist/sweetalert.min.js"></script>

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
{{--<script src="/js/app.js"></script>--}}

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
                "sLengthMenu": "{{ trans('label.table.view')  }}  _MENU_  {{ trans('label.table.record')  }}",
                "sZeroRecords": "{{ trans('label.table.no_record')  }} ",
                "sInfo": "",
                "sInfoEmpty": "",
                "sInfoFiltered": "",
                "sInfoPostFix": "",
                "sSearch": "{{ trans('label.table.search')  }} ",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "{{ trans('label.table.first')  }} ",
                    "sPrevious": "<<",
                    "sNext": ">>",
                    "sLast": "{{ trans('label.table.last')  }} "
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

    $('#page-home-active').addClass('active');
    <?php
            if(!isset($set_menu)) {
                $set_menu = '';
            }
            ?>
    set_menu_active = '{{$set_menu}}';

    if(set_menu_active == 'Read') {
        $('#page-read-active').addClass('active');

        $('#page-speak-active').removeClass('active');
        $('#page-listen-active').removeClass('active');
        $('#page-home-active').removeClass('active');
        $('#page-result-ative').removeClass('active');
    } else if(set_menu_active == 'Listen') {
        $('#page-listen-active').addClass('active');

        $('#page-speak-active').removeClass('active');
        $('#page-result-active').removeClass('active');
        $('#page-read-active').removeClass('active');
        $('#page-home-active').removeClass('active');
    } else if(set_menu_active == 'Result') {
        $('#page-result-active').addClass('active');

        $('#page-speak-active').removeClass('active');
        $('#page-listen-active').removeClass('active');
        $('#page-read-active').removeClass('active');
        $('#page-home-active').removeClass('active');
    } else  if(set_menu_active == 'Speak') {
        $('#page-speak-active').addClass('active');

        $('#page-result-active').removeClass('active');
        $('#page-listen-active').removeClass('active');
        $('#page-read-active').removeClass('active');
        $('#page-home-active').removeClass('active');
    } else {
        $('#page-home-active').addClass('active');

        $('#page-speak-active').removeClass('active');
        $('#page-listen-active').removeClass('active');
        $('#page-read-active').removeClass('active');
        $('#page-result-ative').removeClass('active');
    }

</script>
@yield('script')

</body>
</html>
