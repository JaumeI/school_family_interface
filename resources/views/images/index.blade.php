<x-app-layout title="Galeria">
    <div class="mt-8 flex flex-col">
        @if(sizeof($tags)>0)
            <!--Tags Dropwdown start-->
            <script>
                function dropdown() {
                    return {
                        options: [],
                        selected: [],
                        show: false,
                        open() {
                            this.show = true
                        },
                        close() {
                            this.show = false
                        },
                        isOpen() {
                            return this.show === true
                        },
                        select(index, event) {

                            if (!this.options[index].selected) {

                                this.options[index].selected = true;
                                this.options[index].element = event.target;
                                this.selected.push(index);

                            } else {
                                this.selected.splice(this.selected.lastIndexOf(index), 1);
                                this.options[index].selected = false
                            }
                        },
                        remove(index, option) {
                            this.options[option].selected = false;
                            this.selected.splice(index, 1);


                        },
                        loadOptions() {
                            const options = document.getElementById('select').options;
                            for (let i = 0; i < options.length; i++) {
                                this.options.push({
                                    value: options[i].value,
                                    text: options[i].innerText,
                                    selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                                });
                            }


                        },
                        selectedValues() {

                            if(this.selected.length == 0)
                            {
                                document.querySelectorAll('.image').forEach((element) => element.classList.remove("hidden"));
                            }
                            else
                            {
                                document.querySelectorAll('.image').forEach((element) => element.classList.add("hidden"));
                            }

                            this.selected.map((option) => {
                                document.querySelectorAll('.tag-' + this.options[option].value).forEach((img) =>
                                    img.classList.remove("hidden"))
                            })

                            return this.selected.map((option) => {
                                return this.options[option].value;
                            })

                        }
                    }
                }
            </script>

            <select x-cloak id="select" style="display: none">
                @foreach($tags as $tag)
                    <option value="{{$tag->id}}">
                        {{$tag->name}}
                    </option>
                @endforeach
            </select>

            <div x-data="dropdown()" x-init="loadOptions()"
                 class="w-full md:w-1/2 flex mb-4 flex-col items-center mx-auto">
                <input name="values" type="hidden" x-bind:value="selectedValues()">
                <div class="inline-block relative w-64">
                    <div class="flex flex-col items-center relative">
                        <div x-on:click="open" class="w-full">
                            <div class="my-2 p-1 flex border border-gray-200 bg-white rounded">
                                <div class="flex flex-auto flex-wrap">
                                    <template x-for="(option,index) in selected" :key="options[option].value">
                                        <div
                                            class="flex justify-center items-center m-1 font-medium py-1 px-1 bg-indigo-200 rounded bg-gray-100 border">
                                            <div
                                                class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                                                options[option] x-text="options[option].text"></div>
                                            <div class="flex flex-auto flex-row-reverse">
                                                <div x-on:click.stop="remove(index,option)">
                                                    <svg class="fill-current h-4 w-4 " role="button"
                                                         viewBox="0 0 20 20">
                                                        <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                           c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                           l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                           C14.817,13.62,14.817,14.38,14.348,14.849z"/>
                                                    </svg>

                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <div x-show="selected.length == 0" class="flex-1">
                                        <input placeholder="Tria etiquetes"
                                               class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800"
                                               x-bind:value="selectedValues()">
                                    </div>
                                </div>
                                <div
                                    class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">

                                    <button type="button" x-show="isOpen() === true" x-on:click="open"
                                            class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                        <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                            <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
	c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
	L17.418,6.109z"/>
                                        </svg>

                                    </button>
                                    <button type="button" x-show="isOpen() === false" @click="close"
                                            class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                            <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
	c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
	"/>
                                        </svg>

                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="w-full px-4">
                            <div x-show.transition.origin.top="isOpen()"
                                 class="absolute shadow top-100 bg-white z-40 w-full left-0 rounded max-h-select"
                                 x-on:click.away="close">
                                <div class="flex flex-col w-full overflow-y-auto">
                                    <template x-for="(option,index) in options" :key="option"
                                              class="overflow-auto">
                                        <div
                                            class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-gray-100"
                                            @click="select(index,$event)">
                                            <div
                                                class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                                <div class="w-full items-center flex justify-between">
                                                    <div class="mx-2 leading-6" x-model="option"
                                                         x-text="option.text"></div>
                                                    <div x-show="option.selected">
                                                        <svg class="svg-icon" viewBox="0 0 20 20">
                                                            <path fill="none" d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
							C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
							L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif
        <!--end of tags dropdown place-->
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">

            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 ">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg p-6 bg-white">


                    <!-- Modal gallery -->
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
                        <!-- End of Modal gallery -->

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
