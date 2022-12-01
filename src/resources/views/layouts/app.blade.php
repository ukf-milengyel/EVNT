<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'UKF Events') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="icon" href="{{url('favicon.svg')}}" type="image/svg+xml">

        <!-- Stylesheet -->
        @stack('css')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <footer class=" bg-white absolute left-0 right-0 bottom-auto shadow md:px-6 md:py-3 dark:bg-gray-800">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="http://localhost:8080/" class="flex items-center mb-4 sm:mb-4">
                    <x-application-logo class="flex-none w-10 h-10 md:w-10 md:h-10 fill-red-700" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">EVNT</span>
                </a>

                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
                © 2022 <a href="http://localhost:8080/" class="hover:underline">EVNT</a>. All Rights Reserved.
                </span>

                <ul class="flex flex-wrap items-center mb-6 text-sm text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="http://localhost:8080/event" class="mr-4 hover:underline md:mr-6 ">Podujatia</a>
                    </li>
                    <li>
                        <a href="http://localhost:8080/announcement" class="mr-4 hover:underline md:mr-6">Oznámenia</a>
                    </li>
                    <li>
                        <a href="http://localhost:8080/tag" class="mr-4 hover:underline md:mr-6 ">Tagy</a>
                    </li>
                    <li>
                        <a href="http://localhost:8080/statistics" class="hover:underline">Štatistika</a>
                    </li>
                </ul>

            </div>
        </footer>
    </body>
</html>
