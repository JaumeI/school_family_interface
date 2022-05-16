<x-app-layout title="{{isset($user->email)?'Editar Usuari' : 'Afegir Usuari'}}">
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-100">

                    <form method="POST" action={{ route('users.store')}}>
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correu
                                electrònic</label>
                            <input id="email" name="email" type="email"
                                   value="{{ $user->email }}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                            <input id="name" name="name" type="text" value="{{ $user->name }}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contrasenya</label>
                            <input id="password" name="password" type="password" value=""
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <!--Permissions-->
                        <div class="mb-4 flex flex-row items-center">
                            <x-move-data name="permissions"
                                         originTitle="Permisos no atorgats"
                                         destinationTitle="Permisos atorgats"
                                         :origins="$permissions"
                                         :destinations="$user->permissions()->orderBy('name')->get()"/>
                        </div>

                        <!--Groups this user has permission to tag-->
                        <div class="mb-4 flex flex-row items-center">
                            <x-move-data name="groups"
                                         originTitle="Llistat de grups"
                                         destinationTitle="Grups als que pertany"
                                         :origins="$groups"
                                         :destinations="$user->groups()->orderBy('name')->get()"/>
                        </div>

                        <!--Students this user has permission to see-->
                        <div class="mb-4 flex flex-row items-center">
                            <x-move-data name="students"
                                         originTitle="Llistat d'alumnes'"
                                         destinationTitle="Alumnes que aquest usuari pot visualitzar"
                                         :origins="$students"
                                         :destinations="$user->students()->orderBy('name')->get()"/>
                        </div>

                        <div class="mb-4">
                            <input name="active"
                                   class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                   type="checkbox" value="active" id="active" {{ $user->active? 'checked' : '' }}>
                            <label class="form-check-label inline-block text-gray-800"
                                   for="flexCheckChecked">Actiu</label>
                        </div>
                        <div class="mb-4">
                            <input name="sendcredentials"
                                   class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                   type="checkbox" value="sendcredentials" id="sendcredentials" }}>
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">Enviar
                                credencials</label>
                        </div>

                        <div class="mb-4">
                            <button type="submit" onclick="selectAll(document.getElementById('destination_permissions'));selectAll(document.getElementById('destination_groups'));selectAll(document.getElementById('destination_students'))"
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
