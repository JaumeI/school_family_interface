<x-app-layout title="Galeria">
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">

            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 ">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg p-6 bg-white">

                    <select multiple id="taglist" name="taglist" onchange="filterTags('taglist')">
                        <option value="0">Totes</option>
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">
                                {{$tag->name}}
                            </option>
                        @endforeach
                    </select>


                    <div x-data="{ imgModal : false, imgModalSrc : '', imgModalDesc : '' }">
                        <template
                            @img-modal.window="imgModal = true; imgModalSrc = $event.detail.imgModalSrc; imgModalDesc = $event.detail.imgModalDesc;"
                            x-if="imgModal">
                            <div x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform scale-90"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-90"
                                 x-on:click.away="imgModalSrc = ''"
                                 class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-black bg-opacity-75">
                                <div @click.away="imgModal = ''"
                                     class="flex flex-col max-w-3xl max-h-full overflow-auto">

                                    <div class="p-2">
                                        <img :alt="imgModalSrc" class="object-contain h-1/2-screen" :src="imgModalSrc">
                                        <p x-text="imgModalDesc" class="text-center text-white"></p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-data="{}">


                        <ul role="list"
                            class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8 ">
                            @foreach($images as $image)

                                <li class="relative image tag-0 @foreach($image->tags()->get() as $tag){{'tag-'.$tag->id }} @endforeach">
                                    <div
                                        class="group block w-full aspect-w-10 aspect-h-7 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden">
                                        <a @click="$dispatch('img-modal', {  imgModalSrc: '{{ $image->path.$image->name }}', imgModalDesc: '' })"
                                           class="cursor-pointer">
                                            <img clasclass="object-fit w-full" src="{{ $image->path.$image->name }}"
                                                 alt=""
                                                 class="object-cover pointer-events-none group-hover:opacity-75">
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
