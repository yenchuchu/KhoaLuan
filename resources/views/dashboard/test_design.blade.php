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

                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <a href="#">
                                                            <img src="/imgs-dashboard/tieu-hoc.PNG"
                                                                 alt="Tạo Đề Cấp Tiểu Học"></a>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <a href="#">
                                                            <img src="/imgs-dashboard/THCS.PNG"
                                                                 alt="Tạo Đề Cấp Trung Học Cơ Sở"></a>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
                                                <h2 class="section-heading">Hãy đến với chúng tôi</h2>
                                                <hr class="light">
                                                <p class="text-faded">EStore là nơi để các bạn cùng nhau trao đổi
                                                    kiến thức môn tiếng Anh các bậc tiểu học, trung học cơ sở và trung
                                                    học phổ thông. Từ những kiến thức được kiểm duyệt, các em học sinh
                                                    sẽ tự rèn luyện kỹ năng tiếng Anh của mình với những kiến thức
                                                    đó. </p>
                                                <a href="{{ url('/register') }}"
                                                   class="page-scroll btn btn-default btn-xl sr-button">Đăng ký!</a>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section id="services">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <h2 class="section-heading">At Your Service</h2>
                                                <hr class="primary">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 text-center">
                                                <div class="service-box">
                                                    <i class="fa fa-4x fa-diamond text-primary sr-icons"></i>
                                                    <h3>Sturdy Templates</h3>
                                                    <p class="text-muted">Our templates are updated regularly so they
                                                        don't break.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 text-center">
                                                <div class="service-box">
                                                    <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
                                                    <h3>Ready to Ship</h3>
                                                    <p class="text-muted">You can use this theme as is, or you can make
                                                        changes!</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 text-center">
                                                <div class="service-box">
                                                    <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                                                    <h3>Up to Date</h3>
                                                    <p class="text-muted">We update dependencies to keep things
                                                        fresh.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 text-center">
                                                <div class="service-box">
                                                    <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
                                                    <h3>Made with Love</h3>
                                                    <p class="text-muted">You have to make your websites with love these
                                                        days!</p>
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
                                            <h2>Sử dụng miễn phí</h2>
                                            <a href="{{ url('/login') }}"
                                               class="btn btn-default btn-xl sr-button">Đăng nhập!</a>
                                        </div>
                                    </div>
                                </aside>

                                <section id="contact">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-8 col-lg-offset-2 text-center">
                                                <h2 class="section-heading">Let's Get In Touch!</h2>
                                                <hr class="primary">
                                                <p>Ready to start your next project with us? That's great! Give us a
                                                    call or send us an email and we will get back to you as soon as
                                                    possible!</p>
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