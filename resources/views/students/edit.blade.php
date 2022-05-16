<x-app-layout title="{{isset($student->name)?'Editar Alumne' : 'Afegir Alumne'}}">
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-100">

                    <form method="POST" action={{ route('students.store')}}>
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$student->id}}">

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                            <input id="name" name="name" type="text" value="{{ $student->name }}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <!-- Groups this student belongs to-->
                        <div class="mb-4 flex flex-row items-center">
                            <x-move-data name="groups"
                                         originTitle="Llistat de grups"
                                         destinationTitle="Grups als que pertany"
                                         :origins="$groups"
                                         :destinations="$student->groups()->orderBy('name')->get()"/>
                        </div>

                        <!--users with permissions to this student-->
                        <div class="mb-4 flex flex-row items-center">
                            <x-move-data name="users"
                                         originTitle="Llistat d'usuaris que poden veure imatges"
                                         destinationTitle="Usuaris amb permisos per visualitzar aquest alumne"
                                         :origins="$users"
                                         :destinations="$student->users()->orderBy('name')->get()"/>
                        </div>

                        <div class="mb-4">
                            <button type="submit" onclick="selectAll(document.querySelector('#destination_groups'));selectAll(document.querySelector('#destination_users'))"
                                    class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 px-4 border border-indigo-700 rounded">
                                Desar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
