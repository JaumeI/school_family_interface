<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/v2-assets/components.css?id=20c0b40a1dbe0785ad2e121780055f6b">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ config('app.name', 'SFI') }}</title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function addMulti(){
            var checked = document.querySelectorAll('#origin :checked');
            checked.forEach(element => document.getElementById('destination').options.add(element));
        }
        function removeMulti(){
            var checked = document.querySelectorAll('#destination :checked');
            checked.forEach(element => document.getElementById('origin').options.add(element));
        }
        function selectAll(selectBox,selectAll) {
            // have we been passed an ID
            if (typeof selectBox == "string") {
                selectBox = document.getElementById(selectBox);
            }
            // is the select box a multiple select box?
            if (selectBox.type == "select-multiple") {
                for (var i = 0; i < selectBox.options.length; i++) {
                    selectBox.options[i].selected = selectAll;
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
                    class="px-4 border-r bg-indigo-200 border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
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
                     class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-indigo-700"
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

                    <div class="flex-shrink-0 flex items-center px-4">
                        <img class="h-8 w-auto"
                             src="https://tailwindui.com/img/logos/workflow-logo-indigo-300-mark-white-text.svg"
                             alt="Workflow">
                    </div>
                    <div class="mt-5 flex-1 h-0 overflow-y-auto">
                        <nav class="px-2 space-y-1">

                            <a href="#"
                               class="bg-indigo-800 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md"
                               x-state:on="Current" x-state:off="Default"
                               x-state-description="Current: &quot;bg-indigo-800 text-white&quot;, Default: &quot;text-indigo-100 hover:bg-indigo-600&quot;">
                                <svg class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300"
                                     x-description="Heroicon name: outline/home" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Dashboard
                            </a>

                            <a href="#"
                               class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md"
                               x-state-description="undefined: &quot;bg-indigo-800 text-white&quot;, undefined: &quot;text-indigo-100 hover:bg-indigo-600&quot;">
                                <svg class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300"
                                     x-description="Heroicon name: outline/users" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                Team
                            </a>

                            <a href="#"
                               class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md"
                               x-state-description="undefined: &quot;bg-indigo-800 text-white&quot;, undefined: &quot;text-indigo-100 hover:bg-indigo-600&quot;">
                                <svg class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300"
                                     x-description="Heroicon name: outline/folder" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                </svg>
                                Projects
                            </a>

                            <a href="#"
                               class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md"
                               x-state-description="undefined: &quot;bg-indigo-800 text-white&quot;, undefined: &quot;text-indigo-100 hover:bg-indigo-600&quot;">
                                <svg class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300"
                                     x-description="Heroicon name: outline/calendar" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Calendar
                            </a>

                            <a href="#"
                               class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md"
                               x-state-description="undefined: &quot;bg-indigo-800 text-white&quot;, undefined: &quot;text-indigo-100 hover:bg-indigo-600&quot;">
                                <svg class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300"
                                     x-description="Heroicon name: outline/inbox" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                Documents
                            </a>

                            <a href="#"
                               class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md"
                               x-state-description="undefined: &quot;bg-indigo-800 text-white&quot;, undefined: &quot;text-indigo-100 hover:bg-indigo-600&quot;">
                                <svg class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300"
                                     x-description="Heroicon name: outline/chart-bar" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                Reports
                            </a>

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
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <h1 class="text-2xl font-semibold text-gray-900">{{ $attributes->get('title') }}</h1>
                        </div>
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
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

