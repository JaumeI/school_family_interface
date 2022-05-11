<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ config('app.name', 'SFI') }}</title>


    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script>
        function moveElement(fromControl, toControl) {
            var checked = document.querySelectorAll('#'+fromControl+' :checked');
            checked.forEach(element => document.getElementById(toControl).options.add(element));
        }

        function selectAll(selectBox) {
            if (typeof selectBox == "string") {
                selectBox = document.getElementById(selectBox);
            }
            // check if the select box is a multiple select box
            if (selectBox.type == "select-multiple") {
                for (var i = 0; i < selectBox.options.length; i++) {
                    selectBox.options[i].selected = true;
                }
            }
        }
    </script>


</head>
<body class="antialiased font-sans bg-gray-100">
<div class="" style="">
    <div class="min-h-[640px] ">

        <!-- Static sidebar for mobile -->

        <div x-data="{ open: false }" @keydown.window.escape="open = false">
            <button type="button"
                    class="px-6 py-4 text-gray-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
                    @click="open = true">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" x-description="Heroicon name: outline/menu-alt-2"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     aria-hidden="true"><
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h7"></path>
                </svg>
            </button>

            <div x-show="open" class="fixed inset-0 flex z-40 md:hidden"
                 x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state." x-ref="dialog"
                 aria-modal="true" style="display: none;">

                <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300"
                     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-linear duration-300"
                     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-600 bg-opacity-75"
                     x-description="Off-canvas menu overlay, show/hide based on off-canvas menu state."
                     @click="open = false" aria-hidden="true" style="display: none;">
                </div>

                <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
                     x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in-out duration-300 transform"
                     x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                     x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                     class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-indigo-200"
                     style="display: none;">

                    <div x-show="open" x-transition:enter="ease-in-out duration-300"
                         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         x-description="Close button, show/hide based on off-canvas menu state."
                         class="absolute top-0 right-0 -mr-12 pt-2" style="display: none;">
                        <button type="button"
                                class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                @click="open = false">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" x-description="Heroicon name: outline/x"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center flex-shrink-0 px-4">
                        <img class="h-8 w-auto"
                             src="{{asset('storage/images/logotrans.png')}}"
                             alt="SFI">
                        <div class="pl-3">School Family Interface</div>
                    </div>
                    <div class="mt-5 flex-1 h-0 overflow-y-auto">
                        <nav class="px-2 space-y-1">

                            @include('layouts.navigation')

                        </nav>
                    </div>
                </div>

                <div class="flex-shrink-0 w-14" aria-hidden="true">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </div>


            <!-- Static sidebar for desktop -->
            <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
                <div class="flex flex-col flex-grow pt-5 bg-indigo-200 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <img class="h-8 w-auto"
                             src="{{asset('storage/images/logotrans.png')}}"
                             alt="SFI">
                        <div class="pl-3">School Family Interface</div>
                    </div>
                    <div class="mt-5 flex-1 flex flex-col">
                        <nav class="flex-1 px-2 pb-4 space-y-1">

                            @include('layouts.navigation')

                        </nav>
                    </div>
                </div>
            </div>
            <div class="md:pl-64 flex flex-col flex-1">
                <main>
                    <div class="py-6 px-2">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <h1 class="text-2xl font-semibold text-gray-900">{{ $attributes->get('title') }}</h1>
                        </div>

                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            @if ($errors->any())

                                <ul class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            <div class="p-2 bg-red-100 items-center text-red-700 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                                <span class="flex rounded-full bg-red-300 uppercase px-2 py-1 text-xs font-bold mr-3">Error</span>
                                                <span class="font-semibold mr-2 text-left flex-auto">{{ $error }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>
</body>
</html>

