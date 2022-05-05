<x-app-layout title="Afegir Grup">
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-100">

                    <form method="POST" action={{ route('groups.store')}}>
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$group->id}}">

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                            <input id="name" name="name" type="text" value="{{ $group->name }}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                Afegir
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
