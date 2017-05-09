@extends ('layouts.app')
@section('style')

    <link rel="stylesheet" href="{{URL::asset('test_theme_dashboard/creative.min.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('test_theme_dashboard/magnific-popup.css')}}"/>

    <style>
        .navbar-custom {
            padding: 10px 0;
        }

        a > img {
            width: 100%;
            visibility: visible;
            -webkit-transform: translateY(0) scale(1);
            opacity: 1;
            transform: translateY(0) scale(1);
            opacity: 1;
            -webkit-transition: all 0.35s ease 0s, -webkit-transform 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0.2s, opacity 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0.2s;
            transition: all 0.35s ease 0s, transform 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0.2s, opacity 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0.2s;
        }

        .main-body {
            margin: 30px 15px 10px;
            overflow: hidden;
            padding: 10px 10px;
            margin-bottom: 90px;
        }

        .main-body img {
            margin-top: 25px;
            font-size: 21px;
            text-align: center;

            -webkit-animation: fadein 2s; /* Safari, Chrome and Opera > 12.1 */
            -moz-animation: fadein 2s; /* Firefox < 16 */
            -ms-animation: fadein 2s; /* Internet Explorer */
            -o-animation: fadein 2s; /* Opera < 12.1 */
            animation: fadein 2s;
        }

        @keyframes fadein {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* Firefox < 16 */
        @-moz-keyframes fadein {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* Safari, Chrome and Opera > 12.1 */
        @-webkit-keyframes fadein {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* Internet Explorer */
        @-ms-keyframes fadein {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* Opera < 12.1 */
        @-o-keyframes fadein {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

    </style>
@stop

@section('content')

    @if(!empty( Auth::user()))

        @if (Auth::user()->hasRole('AT') || Auth::user()->hasRole('AD'))
            <section id="dashboard-index-wrap" style="padding: 0px 0 80px;margin-top: 180px;">
                @else
                    <section id="dashboard-index-wrap" style="padding: 100px 0 80px;margin-top: 180px;">
                        @endif
                        @else
                            <section id="dashboard-index-wrap" style="padding: 100px 0 80px;margin-top: 180px;">
                                @endif

                                <header style="margin-bottom: 200px">
                                    <div class="header-content">
                                        <div class="header-content-inner">
                                            {{--<div class="container">--}}
                                            <div class="row">

                                                <div class="main-body" style="margin: 10px 15px 10px;">

                                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-1 col-md-offset-1" style="margin-top: 40px;">
                                                        <a href="#">
                                                            <img src="/imgs-dashboard/tieu-hoc.PNG"
                                                                 alt="Tạo Đề Cấp Tiểu Học"></a>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <a href="#">
                                                            <img src="/imgs-dashboard/THCS.PNG"
                                                                 alt="Tạo Đề Cấp Trung Học Cơ Sở"></a>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" style="margin-top: 40px;">
                                                        <a href="#">
                                                            <img src="/imgs-dashboard/THPT.PNG"
                                                                 alt="Tạo Đề Cấp Trung Học Phổ Thông"></a>
                                                    </div>
                                                </div>
                                                {{--</div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </header>

                                <section class="bg-primary" id="about">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-8 col-lg-offset-2 text-center">
                                                <h2 class="section-heading">{{ trans('label.auth.main.session1.title')  }}</h2>
                                                <hr class="light">
                                                <p class="text-faded">{{ trans('label.auth.main.session1.content')  }} </p>
                                                <a href="{{ url('/register') }}"
                                                   class="page-scroll btn btn-default btn-xl sr-button">{{trans('label.auth.register.title')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section id="services">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <h2 class="section-heading">{{ trans('label.auth.main.session2.title')  }}</h2>
                                                <hr class="primary">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 text-center">
                                                <div class="service-box">
                                                    <i class="fa fa-4x fa-book text-primary sr-icons"></i>
                                                    <h3>{{ trans('label.auth.main.session2.content.one')  }}</h3>
                                                    <p class="text-muted">{{ trans('label.auth.main.session2.content.title_one')  }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 text-center">
                                                <div class="service-box">
                                                    <i class="fa fa-4x fa-share  text-primary sr-icons"></i>
                                                    <h3>{{ trans('label.auth.main.session2.content.two')  }}</h3>
                                                    <p class="text-muted">{{ trans('label.auth.main.session2.content.title_two')  }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 text-center">
                                                <div class="service-box">
                                                    <i class="fa fa-4x fa-globe text-primary sr-icons"></i>
                                                    <h3>{{ trans('label.auth.main.session2.content.three')  }}</h3>
                                                    <p class="text-muted">{{ trans('label.auth.main.session2.content.title_three')  }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 text-center">
                                                <div class="service-box">
                                                    <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
                                                    <h3>{{ trans('label.auth.main.session2.content.four')  }}</h3>
                                                    <p class="text-muted">{{ trans('label.auth.main.session2.content.title_four')  }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section class="no-padding" id="portfolio">
                                    <div class="container-fluid">
                                        <div class="row no-gutter popup-gallery">
                                            <div class="col-lg-4 col-sm-6">
                                                <a href="{{URL::asset('test_theme_dashboard/img/portfolio/fullsize/1.jpg')}}"
                                                   class="portfolio-box">
                                                    <img src="{{URL::asset('test_theme_dashboard/img/portfolio/thumbnails/1.jpg')}}"
                                                         class="img-responsive" alt="">
                                                    <div class="portfolio-box-caption">
                                                        <div class="portfolio-box-caption-content">
                                                            <div class="project-category text-faded">
                                                                Category
                                                            </div>
                                                            <div class="project-name">
                                                                Project Name
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <a href="{{URL::asset('test_theme_dashboard/img/portfolio/fullsize/2.jpg')}}"
                                                   class="portfolio-box">
                                                    <img src="{{URL::asset('test_theme_dashboard/img/portfolio/thumbnails/2.jpg')}}"
                                                         class="img-responsive" alt="">
                                                    <div class="portfolio-box-caption">
                                                        <div class="portfolio-box-caption-content">
                                                            <div class="project-category text-faded">
                                                                Category
                                                            </div>
                                                            <div class="project-name">
                                                                Project Name
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <a href="{{URL::asset('test_theme_dashboard/img/portfolio/fullsize/3.jpg')}}"
                                                   class="portfolio-box">
                                                    <img src="{{URL::asset('test_theme_dashboard/img/portfolio/thumbnails/3.jpg')}}"
                                                         class="img-responsive" alt="">
                                                    <div class="portfolio-box-caption">
                                                        <div class="portfolio-box-caption-content">
                                                            <div class="project-category text-faded">
                                                                Category
                                                            </div>
                                                            <div class="project-name">
                                                                Project Name
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <a href="{{URL::asset('test_theme_dashboard/img/portfolio/fullsize/4.jpg')}}"
                                                   class="portfolio-box">
                                                    <img src="{{URL::asset('test_theme_dashboard/img/portfolio/thumbnails/4.jpg')}}"
                                                         class="img-responsive" alt="">
                                                    <div class="portfolio-box-caption">
                                                        <div class="portfolio-box-caption-content">
                                                            <div class="project-category text-faded">
                                                                Category
                                                            </div>
                                                            <div class="project-name">
                                                                Project Name
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <a href="{{URL::asset('test_theme_dashboard/img/portfolio/fullsize/5.jpg')}}"
                                                   class="portfolio-box">
                                                    <img src="{{URL::asset('test_theme_dashboard/img/portfolio/thumbnails/5.jpg')}}"
                                                         class="img-responsive" alt="">
                                                    <div class="portfolio-box-caption">
                                                        <div class="portfolio-box-caption-content">
                                                            <div class="project-category text-faded">
                                                                Category
                                                            </div>
                                                            <div class="project-name">
                                                                Project Name
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <a href="{{URL::asset('test_theme_dashboard/img/portfolio/fullsize/6.jpg')}}"
                                                   class="portfolio-box">
                                                    <img src="{{URL::asset('test_theme_dashboard/img/portfolio/thumbnails/6.jpg')}}"
                                                         class="img-responsive" alt="">
                                                    <div class="portfolio-box-caption">
                                                        <div class="portfolio-box-caption-content">
                                                            <div class="project-category text-faded">
                                                                Category
                                                            </div>
                                                            <div class="project-name">
                                                                Project Name
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <aside class="bg-dark">
                                    <div class="container text-center">
                                        <div class="call-to-action">
                                            <h2>{{ trans('label.auth.main.session3.title')  }}</h2>
                                            <a href="{{ url('/login') }}"
                                               class="btn btn-default btn-xl sr-button">{{trans('label.auth.login.title')}}</a>
                                        </div>
                                    </div>
                                </aside>

                                <section id="contact">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-8 col-lg-offset-2 text-center">
                                                <h2 class="section-heading">{{ trans('label.auth.main.session4.title')  }}</h2>
                                                <hr class="primary">
                                                <p>{{ trans('label.auth.main.session4.content')  }}</p>
                                            </div>
                                            <div class="col-lg-4 col-lg-offset-2 text-center">
                                                <i class="fa fa-phone fa-3x sr-contact"></i>
                                                <p>123-456-6789</p>
                                            </div>
                                            <div class="col-lg-4 text-center">
                                                <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                                                <p><a href="mailto:your-email@your-domain.com">feedback@startbootstrap
                                                        .com</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </section>


                            </section>

                    </section>
                @stop

@section('script')

    <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="{{URL::asset('test_theme_dashboard/scrollreveal.min.js')}}"></script>
        <script src="{{URL::asset('test_theme_dashboard/jquery.magnific-popup.min.js')}}"></script>

        <!-- Theme JavaScript -->
        <script src="{{URL::asset('test_theme_dashboard/creative.min.js')}}"></script>


@stop