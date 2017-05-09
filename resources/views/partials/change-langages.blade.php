
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-globe" aria-hidden="true" ></i>
        {{ Config::get('language')[App::getLocale()] }}
    </a>
    <ul class="dropdown-menu">

        @foreach (Config::get('language') as $lang => $language)
            @if ($lang != App::getLocale())
                <li>
                    <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                </li>
            @endif
        @endforeach
    </ul>
</li>