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

            <footer class="bg-gray-100 border-t-1 absolute left-0 right-0 bottom-auto pb-10">
                <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto flex flex-wrap items-center text-sm uppercase text-gray-500 justify-between">
                    <a href="{{route("event.index")}}" class="w-full sm:w-auto mr-4">
                        <x-application-logo-transparent class="inline w-10 h-10 fill-gray-500 md:w-10 md:h-10" />
                        <p class="inline ml-4">Správca podujatí</p>
                    </a>

                    <ul class="flex flex-wrap items-center mt-4 sm:mt-0">
                        <li>
                            <a href="/" class="mr-4 md:mr-6 ">Index</a>
                        </li>
                        <li>
                            <a href="{{route("event.index")}}" class="mr-4 md:mr-6 ">Podujatia</a>
                        </li>
                        <li>
                            <a href="{{route("announcement.index")}}" class="mr-4 md:mr-6">Oznámenia</a>
                        </li>
                        <li>
                            <a href="{{route("tag.index")}}" class="mr-4 md:mr-6 ">Tagy</a>
                        </li>
                        <li>
                            <a href="{{route("statistics")}}">Štatistika</a>
                        </li>
                    </ul>

                </div>
            </footer>
        </div>
    </body>
</html>
