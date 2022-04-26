<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Hola, {{ auth()->user()->name }}
                    @if (auth()->user()->hasPermissionTo("manage_users"))
                        <div class="bg-white p-6 border-gray-500 shadow-black overflow-hidden rounded">
                            <p>Gestiona usuaris</p>
                            <a href=" {{ route('users') }}">Llista usuaris</a>
                            <a href=" {{ route('users.create') }}">Nou usuari</a>
                        </div>
                    @endif
                    @if (auth()->user()->hasPermissionTo("manage_students"))
                        <p>Gestiona alumnes</p>

                    @endif
                    @if (auth()->user()->hasPermissionTo("manage_groups"))
                        <p>Gestiona grups</p>
                    @endif
                    @if (auth()->user()->hasPermissionTo("manage_tags"))
                        <p>Gestiona etiquetes</p>
                    @endif
                    @if (auth()->user()->hasPermissionTo("upload_images"))
                        <p>Pujar imatges</p>
                    @endif
                    @if (auth()->user()->hasPermissionTo("see_images"))
                        <p>Galeria</p>
                    @endif
                    @if (auth()->user()->hasPermissionTo("messages"))
                        <p>Missatges</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
