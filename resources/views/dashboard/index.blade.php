@extends ('layouts.app')
@section('style')
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
             <section id="dashboard-index-wrap" style="padding: 0px 0 80px;">
         @else
              <section id="dashboard-index-wrap" style="padding: 100px 0 80px;">
         @endif
    @else
       <section id="dashboard-index-wrap" style="padding: 100px 0 80px;">
    @endif
        <div class="container">
            <div class="row">

                <div class="main-body">

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="#">
                            <img src="/imgs-dashboard/tieu-hoc.PNG" alt="Tạo Đề Cấp Tiểu Học"></a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="#">
                            <img src="/imgs-dashboard/THCS.PNG" alt="Tạo Đề Cấp Trung Học Cơ Sở"></a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="#">
                            <img src="/imgs-dashboard/THPT.PNG" alt="Tạo Đề Cấp Trung Học Phổ Thông"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop