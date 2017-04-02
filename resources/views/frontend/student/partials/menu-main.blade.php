<nav class="navbar navbar-default navbar-static-top" id="nav-bottom-tab">
    <div class="container">
        <ul class="nav navbar-nav" id="ul-menu-main">
            <li class="active" style="border-left: 1px solid #d7d7d7;">
                <a href="{{route('frontend.dashboard.student.index')}}">
                    <div class="img-icon">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </div>
                    INTRODUCTION</a>
            </li>
            <li>

                <a href="{{route('frontend.dashboard.student.redirect', 'Read')}}" id="href_Read">
                    <div class="img-icon">
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </div>
                    READING
                </a>
            </li>
            <li>
                <a href="{{route('frontend.dashboard.student.redirect.listen', 'Listen')}}" id="href_Listen">
                    <div class="img-icon">
                        <i class="fa fa-headphones" aria-hidden="true"></i>
                    </div>
                    LISTENING
                </a>
            </li>
            <li>
                <a href="{{route('frontend.dashboard.student.learn.speak', [])}}">
                    <div class="img-icon">
                        <i class="fa fa-smile-o" aria-hidden="true"></i>
                    </div>
                    TEST SPEAKING</a>
            </li>
            <li style="border-right: 1px solid #d7d7d7;">
                <a href="{{route('frontend.student.show.results')}}">
                    <div class="img-icon">
                        {{--<i class="fa fa-th-list" aria-hidden="true"></i>--}}
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                    </div>
                    KẾT QUẢ THI</a>
            </li>
            {{--<i class="fa fa-pencil" aria-hidden="true"></i>--}}
            {{--<li style="border-right: 1px solid #d7d7d7;"><a href="#">HƯỚNG DẪN</a></li>--}}
            {{--<li><a href="#">LÀM THỬ TEST</a></li>--}}
            {{--<li><a href="#">THỐNG KÊ</a></li>--}}
            {{--<li><a href="#">FORUM</a></li>--}}
        </ul>
    </div>
</nav>
