<li class="{{ request()->routeIs($route.'*') ? 'active' : '' }}">
    <a href="{{ route($route) }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg  hover:bg-blue-300 ">

        <span class="ml-3">{{ $slot }}</span>
    </a>
</li>
