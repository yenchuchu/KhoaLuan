@if (Auth::guest())
    <ul class="nav navbar-nav navbar-right">
        <li class="guest-app"><a href="{{ url('/login') }}">Login</a></li>
        <li class="guest-app"><a href="{{ url('/register') }}">Register</a></li>
    </ul>
@else
    {{--@if(!empty( Auth::user()))--}}
    @if ( Auth::user()->hasRole('AD'))
        <ul class="nav navbar-top-links navbar-right menu-top-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="top-label label label-warning" id="sum-noti-admin"></span> <i class="fa fa-bell fa-2x"></i>
                </a>
                <!-- dropdown alerts-->
                <ul class="dropdown-menu dropdown-alerts" id="alert_notifications">

                </ul>
                <!-- end dropdown-alerts -->
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-2x"></i>
                </a>
                <!-- dropdown user-->
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="{{route('frontend.student.show.profile')}}"><i class="fa fa-user fa-fw"></i>User
                            Profile</a>
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i>Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    </li>
                </ul>
                <!-- end dropdown-user -->
            </li>
            <!-- end main dropdown -->
        </ul>
    @endif

    @if (Auth::user()->hasRole('AT'))
        <ul class="nav navbar-top-links navbar-right menu-top-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="top-label label label-warning">5</span> <i class="fa fa-bell fa-2x"></i>
                </a>
                <!-- dropdown alerts-->
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i>New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i>3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i>Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i>New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i>Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- end dropdown-alerts -->
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-2x"></i>
                </a>
                <!-- dropdown user-->
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="{{route('frontend.student.show.profile')}}"><i class="fa fa-user fa-fw"></i>User
                            Profile</a>
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i>Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    </li>
                </ul>
                <!-- end dropdown-user -->
            </li>
            <!-- end main dropdown -->
        </ul>
    @endif

    @if ( Auth::user()->hasRole('TC') ||  Auth::user()->hasRole('ST'))

        <!-- Authentication Links -->
        @if (Auth::guest())
            <ul class="nav navbar-nav navbar-right">
                <li class="guest-app"><a href="{{ url('/login') }}">Login</a></li>
                <li class="guest-app"><a href="{{ url('/register') }}">Register</a></li>
            </ul>
        @else
            <div class="dropdown" id="dropdown-menu-top">
                <a href="#" class="dropbtn" id="username-auth">
                    @if(Auth::user()->avatar != null)
                        <img src="{{URL::asset(Auth::user()->avatar)}}" id="avatar_img" alt="Avatar">
                    @else
                        <img src="{{URL::asset('imgs-dashboard/avatar.png')}}" id="avatar_img" alt="Avatar">
                    @endif
                    {{ Auth::user()->user_name }} <span class="caret"></span>
                </a>
                <div class="dropdown-content">
                    <a href="{{route('frontend.student.show.profile')}}"><i class="fa fa-user fa-fw"></i>
                        User Profile</a>
                    <a href="{{ url('/logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>

                </div>
            </div>

        @endif
    @endif
@endif
