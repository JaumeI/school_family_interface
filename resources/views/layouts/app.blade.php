<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>
            .active { color: red; }
        </style>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header ?? '' }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <ul>
                    <x-sidebar.item route="logout">Sortir</x-sidebar.item>
                    <x-sidebar.item-protected route="users" permission="manage_users">Usuaris</x-sidebar.item-protected>
                    <x-sidebar.item-protected route="students" permission="manage_students">Alumnes</x-sidebar.item-protected>
                    <x-sidebar.item-protected route="groups" permission="manage_groups">Grups</x-sidebar.item-protected>
                </ul>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
