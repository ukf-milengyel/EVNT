<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Štatistika') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto md:px-6 lg:px-8">
            <div class="overflow-hidden md:shadow-none shadow-lg rounded-b-3xl">
                <div class="lg:px-6 md:py-9">
                    <div class="md:space-y-4">

                    <div class="grid grid-cols-2 md:gap-4">

                        <div class="bg-white p-6 w-full md:rounded-xl md:shadow-lg flex items-center space-x-4">
                            <div>
                                <div class="text-6xl font-medium text-black">{{$attendants}}</div>
                                <div class="text-3xl font-medium text-black">zúčastnených</div>
                            </div>
                        </div>

                        <div class="bg-white p-6 w-full md:rounded-xl md:shadow-lg flex items-center space-x-4">
                            <div>
                                <div class="text-6xl font-medium text-black">{{$events}}</div>
                                <div class="text-3xl font-medium text-black">podujatí</div>
                            </div>
                        </div>

                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 md:gap-4">

                        <div class="p-6 h-24 w-auto bg-white md:rounded-xl md:shadow-lg flex items-center space-x-4">
                            <div>
                                <div class="text-4xl font-medium text-black">{{$users}}</div>
                                <div class="text-2xl font-medium text-black">používateľov</div>
                            </div>
                        </div>

                        <div class="p-6 h-24 w-auto bg-white md:rounded-xl md:shadow-lg flex items-center space-x-4">
                            <div>
                                <div class="text-4xl font-medium text-black">{{$groups}}</div>
                                <div class="text-2xl font-medium text-black">skupín</div>
                            </div>
                        </div>

                        <div class="p-6 h-24 w-auto bg-white md:rounded-xl md:shadow-lg flex items-center space-x-4">
                            <div>
                                <div class="text-4xl font-medium text-black">{{$photos}}</div>
                                <div class="text-2xl font-medium text-black">fotografií</div>
                            </div>
                        </div>

                        <div class="p-6 h-24 w-auto bg-white md:rounded-xl md:shadow-lg flex items-center space-x-4">
                            <div>
                                <div class="text-4xl font-medium text-black">{{$attachments}}</div>
                                <div class="text-2xl font-medium text-black">príloh</div>
                            </div>
                        </div>

                    </div>

                    </div>

                    <!--Údaje z controllera<br>
                    users {{$users}}<br>
                    groups {{$groups}}<br>
                    events {{$events}}<br>
                    attendants {{$attendants}}<br>
                    photos {{$photos}}<br>
                    attachments {{$attachments}}<br>-->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<footer class="p-4 bg-white absolute left-0 right-0 bottom-auto shadow md:px-6 md:py-8 dark:bg-gray-900">
    <div class="sm:flex sm:items-center sm:justify-between">
        <a href="http://localhost:8080/" class="flex items-center mb-4 sm:mb-0">
            <x-application-logo class="flex-none h-3 w-3 md:w-10 md:h-10 fill-red-700" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">EVNT</span>
        </a>
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
    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
    <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 <a href="http://localhost:8080/" class="hover:underline">EVNT</a>. All Rights Reserved.
    </span>
</footer>
