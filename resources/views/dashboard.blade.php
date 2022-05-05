<x-app-layout title="titola">
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Hola, {{ auth()->user()->name }}, selecciona una opcó del menú lateral. Si no en veus, siusplau contacta amb el responsable.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
