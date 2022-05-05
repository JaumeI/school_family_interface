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
                            <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Llistat d'alumnes</label>
                            <select name="origin" id="origin" class="form-multiselect block w-1/3 mt-1" multiple>
                                @foreach($students as $student)
                                    <option value="{{$student->id}}">{{$student->name}}</option>
                                @endforeach
                            </select>
                            <button type="button" id="add" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded" onclick="addMulti()">Afegir</button>
                            <button type="button" id="remove" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded" onclick="removeMulti()">Treure</button>
                            <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Alumnes al grup</label>
                            <select name="destination[]" id="destination" class="form-multiselect block w-1/3 mt-1" multiple>
                                @foreach($group->students()->orderBy('name')->get() as $student)
                                    <option value="{{$student->id}}">{{$student->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-4">
                            <button type="submit"  onclick="selectAll(document.getElementById('destination'),true)"
                                    class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                Desar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
