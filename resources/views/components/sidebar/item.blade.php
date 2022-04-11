<li class="{{ request()->routeIs($route.'*') ? 'active' : '' }}"><a href="{{ route($route) }}">{{ $slot }}</a></li>
