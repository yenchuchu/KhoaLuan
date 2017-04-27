@if (Auth::guest())
    <ul class="nav navbar-nav navbar-right">
        <li class="guest-app"><a href="{{ url('/login') }}">{{trans('label.auth.login.title')}}</a></li>
        <li class="guest-app"><a href="{{ url('/register') }}">{{trans('label.auth.register.title')}}</a></li>
    </ul>
@else

    @if (Auth::user()->hasRole('AT') || Auth::user()->hasRole('AD'))
        <ul class="nav navbar-top-links navbar-right menu-top-right">
            <li class="dropdown" style="float:left;">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="read-noti">
                    <span class="top-label label badge label-warning" id="sum-noti-admin" style="background-color: #e53238"></span>
                    <i class="fa fa-bell-o" aria-hidden="true" style="font-size: 19px; margin-top: 6px;"></i>
                </a>
                <!-- dropdown alerts-->
                <ul class="dropdown-menu dropdown-alerts" id="alert_notifications">

                </ul>
                <!-- end dropdown-alerts -->
            </li>

            <li class="dropdown" style="float:left;margin-right: 0px">
                {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#">--}}
                    {{--<i class="fa fa-user fa-2x"></i>--}}
                {{--</a>--}}
                <a href="#" class="dropbtn dropdown-toggle" id="username-auth" data-toggle="dropdown">
                    @if(Auth::user()->avatar != null)
                        <img src="/{{Auth::user()->avatar}}" id="avatar_img" alt="Avatar">
                    @else
                        <img src="/imgs-dashboard/avatar.png" id="avatar_img" alt="Avatar">
                    @endif
                    {{ Auth::user()->user_name }} <span class="caret"></span>
                </a>
                <!-- dropdown user-->
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="{{route('frontend.student.show.profile')}}"><i class="fa fa-user fa-fw"></i>
                            {{trans('button.redirect.profile_page')}}</a>
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i>{{trans('button.redirect.logout')}}
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
                        <img src="/{{Auth::user()->avatar}}" id="avatar_img" alt="Avatar">
                    @else
                        <img src="/imgs-dashboard/avatar.png" id="avatar_img" alt="Avatar">
                    @endif
                    {{ Auth::user()->user_name }} <span class="caret"></span>
                </a>
                <div class="dropdown-content">
                    <a href="{{route('frontend.student.show.profile')}}"><i class="fa fa-user fa-fw"></i>
                        {{trans('button.redirect.profile_page')}}</a>
                    <a href="{{ url('/logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{trans('button.redirect.logout')}}

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>

                </div>
            </div>

        @endif
    @endif
@endif
