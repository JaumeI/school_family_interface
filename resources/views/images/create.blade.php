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
                        <!--Students that appear in this image-->
                        <div class="mb-4 flex flex-row items-center">
                            <x-move-data name="students"
                                         originTitle="Llistat d'alumnes'"
                                         destinationTitle="Alumnes que apareixen en aquesta imatge"
                                         :origins="$students"
                                         :destinations="$appearing_students"/>
                        </div>


                        <!--Tags for this image-->
                        <div class="mb-4 flex flex-row items-center">
                            <x-move-data name="tags"
                                         originTitle="Llistat d'etiquetes'"
                                         destinationTitle="Etiquetes assignades a aquesta imatge"
                                         :origins="$tags"
                                         :destinations="$applied_tags"/>
                        </div>

                        <div class="mb-4">
                            <button type="submit" onclick="selectAll(document.getElementById('destination_tags'));selectAll(document.getElementById('destination_students'))"
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
