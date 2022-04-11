@if (auth()->user()->hasPermissionTo($permission))
    <x-sidebar.item :route="$route">{{ $slot }}</x-sidebar.item>
@endif
