<x-app-layout title="{{isset($group->name)?'Editar Grup' : 'Afegir Grup'}}">
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


                        <!--Students that belong to this group-->
                        <div class="mb-4 flex flex-row items-center">
                            <x-move-data name="students"
                                         originTitle="Llistat d'alumnes'"
                                         destinationTitle="Alumnes que pertanyen a aquest grup"
                                         :origins="$students"
                                         :destinations="$group->students()->orderBy('name')->get()"/>
                        </div>

                        <!--Users with permission to this group-->
                        <!--TODO: Fix the if hasPermissionTo-->
                        <div class="mb-4 flex flex-row items-center">
                            <div class="basis-2/5 ">
                                <div class="w-full">
                                    <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Llistat
                                        d'usuaris amb permisos de pujar imatges</label>
                                    <select name="origin_users" id="origin_users"
                                            class="form-multiselect shadow block rounded w-full mt-1" size="10" multiple>
                                        @foreach($users as $user)
                                            @if($user->hasPermissionTo('upload_images'))
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="basis-1/5">
                                <div class="flex flex-col">
                                    <button type="button" id="add"
                                            class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                                            onclick="moveElement('origin_users', 'destination_users')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                    <button type="button" id="remove"
                                            class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                                            onclick="moveElement('destination_users', 'origin_users')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class=" basis-2/5">

                                <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Usuaris agregats al
                                    grup</label>
                                <select name="destination_users[]" id="destination_users"
                                        class="form-multiselect shadow block rounded w-full mt-1" size="10" multiple>
                                    @foreach($group->users()->orderBy('name')->get() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!--Submit-->
                        <div class="mb-4">
                            <button type="submit" onclick="selectAll(document.getElementById('destination_students'));selectAll(document.getElementById('destination_users'))"
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
