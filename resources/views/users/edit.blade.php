<x-app-layout title="Afegir Usuari">
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

                        <div class="mb-4 flex flex-row items-center">
                            <div class="basis-2/5 ">
                                <div class="w-full">
                                    <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Permisos no atorgats
                                        </label>
                                    <select name="origin_permissions" id="origin_permissions"
                                            class="form-multiselect shadow block rounded w-full mt-1" size="10" multiple>
                                        @foreach($permissions as $permission)
                                            <option value="{{$permission->id}}">{{$permission->public_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="basis-1/5">
                                <div class="flex flex-col">
                                    <button type="button" id="add"
                                            class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 px-4 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                                            onclick="moveElement('origin_permissions', 'destination_permissions')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                    <button type="button" id="remove"
                                            class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 px-4 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                                            onclick="moveElement('destination_permissions', 'origin_permissions')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class=" basis-2/5">

                                <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Permisos atorgats</label>
                                <select name="destination_permissions[]" id="destination_permissions"
                                        class="form-multiselect shadow block rounded w-full mt-1" size="10" multiple>
                                    @foreach($user->permissions()->orderBy('name')->get() as $permission)
                                        <option value="{{$permission->id}}">{{$permission->public_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <!--Groups this user has permission to tag-->
                        <div class="mb-4 flex flex-row items-center">
                            <div class="basis-2/5 ">
                                <div class="w-full">
                                    <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Llistat
                                        de grups</label>
                                    <select name="origin_groups" id="origin_groups"
                                            class="form-multiselect shadow block w-full rounded mt-1" size="10" multiple>
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="basis-1/5">
                                <div class="flex flex-col">

                                    <button type="button" id="add"
                                            class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 px-4 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                                            onclick="moveElement('origin_groups', 'destination_groups')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                        </svg>
                                    </button>

                                    <button type="button" id="remove"
                                            class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 px-4 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                                            onclick="moveElement('destination_groups', 'origin_groups')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w46 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                                        </svg>
                                    </button>

                                </div>
                            </div>
                            <div class="basis-2/5">
                                <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Grups als que pertany</label>
                                <select name="destination_groups[]" id="destination_groups"
                                        class="form-multiselect shadow block rounded w-full mt-1" size="10" multiple>
                                    @foreach($user->groups()->orderBy('name')->get() as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <!--Students this user has permission to see-->
                        <div class="mb-4 flex flex-row items-center">
                            <div class="basis-2/5 ">
                                <div class="w-full">
                                    <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Llistat
                                        d'alumnes</label>
                                    <select name="origin_students" id="origin_students"
                                            class="form-multiselect shadow block w-full rounded mt-1" size="10" multiple>
                                        @foreach($students as $student)
                                            <option value="{{$student->id}}">{{$student->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="basis-1/5">
                                <div class="flex flex-col">

                                    <button type="button" id="add"
                                            class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 px-4 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                                            onclick="moveElement('origin_students', 'destination_students')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                        </svg>
                                    </button>

                                    <button type="button" id="remove"
                                            class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 px-4 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                                            onclick="moveElement('destination_students', 'origin_students')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w46 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                                        </svg>
                                    </button>

                                </div>
                            </div>
                            <div class="basis-2/5">
                                <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Alumnes que aquest usuari pot visualitzar</label>
                                <select name="destination_students[]" id="destination_students"
                                        class="form-multiselect shadow block rounded w-full mt-1" size="10" multiple>
                                    @foreach($user->students()->orderBy('name')->get() as $student)
                                        <option value="{{$student->id}}">{{$student->name}}</option>
                                    @endforeach
                                </select>

                            </div>
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
