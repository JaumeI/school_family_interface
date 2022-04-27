<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-100">

                    <form method="POST" action={{ route('users.store', ['id' => $user->id]) }}>
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correu electrònic</label>
                            <input id="email" name="email" type="email"
                                   @if(strlen($user->email)>0)
                                   disabled
                                   @endif
                                   value="{{ $user->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                            <input id="name" name="name" type="text" value="{{ $user->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contrasenya</label>
                            <input id="password" name="password" type="password" value="" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" name="manage_users" value="manage_users" id="manage_users" {{ $user->hasPermissionTo('manage_users')? 'checked' : '' }}
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" >
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">Gestionar Usuaris</label>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" name="manage_students" value="manage_students" id="manage_students" {{ $user->hasPermissionTo('manage_students')? 'checked' : '' }}
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" >
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">Gestionar Alumnes</label>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" name="manage_groups" value="manage_groups" id="manage_groups" {{ $user->hasPermissionTo('manage_groups')? 'checked' : '' }}
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" >
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">Gestionar Grups</label>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" name="manage_permissions" value="manage_permissions" id="manage_permissions" {{ $user->hasPermissionTo('manage_permissions')? 'checked' : '' }}
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" >
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">Gestionar Permisos</label>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" name="manage_tags" value="manage_tags" id="manage_tags" {{ $user->hasPermissionTo('manage_tags')? 'checked' : '' }}
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" >
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">Gestionar Etiquetes</label>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" name="upload_images" value="upload_images" id="upload_images" {{ $user->hasPermissionTo('upload_images')? 'checked' : '' }}
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" >
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">Pujar Imatges</label>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" name="see_images" value="see_images" id="see_images" {{ $user->hasPermissionTo('see_images')? 'checked' : '' }}
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" >
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">Veure Imatges</label>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" name="start_thread" value="start_thread" id="start_thread" {{ $user->hasPermissionTo('start_thread')? 'checked' : '' }}
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" >
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">Iniciar converses</label>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" name="messages" value="messages" id="messages" {{ $user->hasPermissionTo('messages')? 'checked' : '' }}
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" >
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">Enviar Missatges</label>
                        </div>



                        <div class="mb-4">
                            <input name="active" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="active" id="active" {{ $user->active? 'checked' : '' }}>
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">Actiu</label>
                        </div>
                        <div class="mb-4">
                            <input name="sendcredentials" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600  focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="sendcredentials" id="sendcredentials" }}>
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">Enviar credencials</label>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded">Submit</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
