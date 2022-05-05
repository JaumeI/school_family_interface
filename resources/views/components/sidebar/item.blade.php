<li class="{{ request()->routeIs($route.'*') ? 'active' : '' }}">

    <a href="{{ route($route) }}"
       class="bg-indigo-600 text-gray-300 group flex items-center px-2 py-2 text-sm font-medium rounded-md"
       x-state:on="Current" x-state:off="Default"
       x-state-description="Current: &quot;bg-indigo-800 text-white&quot;, Default: &quot;text-indigo-100 hover:bg-indigo-600&quot;">
        {{ $slot }}
    </a>
</li>
