<x-app-layout title="Pujar imatge">
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-100">

                    <form method="POST" enctype="multipart/form-data" id="upload-image" action="{{ route('images.store')  }}" >

                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Penja una imatge
                                </label>
                            <input id="image" name="image" type="file" placeholder="Tria una imatge"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <!--Students-->
                        <div class="mb-4 flex flex-row items-center">
                            <div class="basis-2/5 ">
                                <div class="w-full">
                                    <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Alumnes a etiquetar
                                    </label>
                                    <select name="origin_students" id="origin_students"
                                            class="form-multiselect shadow block rounded w-full mt-1" size="10" multiple>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                    <button type="button" id="remove"
                                            class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 px-4 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                                            onclick="moveElement('destination_students', 'origin_students')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class=" basis-2/5">

                                <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Alumnes etiquetats
                                </label>
                                <select name="destination_students[]" id="destination_students"
                                        class="form-multiselect shadow block rounded w-full mt-1" size="10" multiple>
                                </select>
                            </div>
                        </div>

                        <!--Tags-->

                        <div class="mb-4 flex flex-row items-center">
                            <div class="basis-2/5 ">
                                <div class="w-full">
                                    <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Etiquetes possibles
                                        </label>
                                    <select name="origin_tags" id="origin_tags"
                                            class="form-multiselect shadow block rounded w-full mt-1" size="10" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="basis-1/5">
                                <div class="flex flex-col">
                                    <button type="button" id="add"
                                            class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 px-4 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                                            onclick="moveElement('origin_tags', 'destination_tags')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                    <button type="button" id="remove"
                                            class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 px-4 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                                            onclick="moveElement('destination_tags', 'origin_tags')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class=" basis-2/5">

                                <label for="all" class="block text-gray-700 text-sm font-bold mb-2">Etiquetes assignades
                                    </label>
                                <select name="destination_tags[]" id="destination_tags"
                                        class="form-multiselect shadow block rounded w-full mt-1" size="10" multiple>
                                </select>
                            </div>
                        </div>



                        <div class="mb-4">
                            <button type="submit" onclick="selectAll(document.getElementById('destination_tags'));selectAll(document.getElementById('destination_students')))"
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
