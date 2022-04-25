<nav x-data="{ open: false }" >
    <!-- Primary Navigation Menu -->
    <aside class="w-64" aria-label="Sidebar">
        <div class="overflow-y-auto pb-80 py-4 px-3 bg-blue-200 rounded shadow-md shadow-gray-300">
            <ul class="space-y-2">

                <img class="object-scale-down w-8 float-left" src="{{asset('storage/images/logotrans.png')}}" alt="SFI"/>
                <p>School Family Interface</p>

            </ul>
            <ul class="pt-4 mt-4 space-y-2 border-t border-gray-600">
                <span class="ml-3">{{ auth()->user()->name }}</span>

            </ul>
            <ul class="pt-4 mt-4 space-y-2 border-t border-gray-600">
                <x-sidebar.item-protected route="users" permission="manage_users">Usuaris</x-sidebar.item-protected>
                <x-sidebar.item-protected route="students" permission="manage_students">Alumnes</x-sidebar.item-protected>
                <x-sidebar.item-protected route="groups" permission="manage_groups">Grups</x-sidebar.item-protected>
                <x-sidebar.item-protected route="upload_images" permission="upload_images">Pujar imatges</x-sidebar.item-protected>
                <x-sidebar.item-protected route="see_images" permission="see_images">Galeria</x-sidebar.item-protected>
                <x-sidebar.item-protected route="messages" permission="messages">Missatges</x-sidebar.item-protected>
                <x-sidebar.item route="logout">Sortir</x-sidebar.item>
            </ul>
            <ul class="pt-4 mt-4 space-y-2 border-t border-gray-600">
                 <span class="object-center">
                     <img  src="{{asset('storage/images/uocrodo.png')}}" class="object-scale-down w-20" alt="UOC"/>
                 </span>
            </ul>

        </div>
    </aside>
</nav>
