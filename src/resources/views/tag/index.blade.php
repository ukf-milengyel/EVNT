<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <div class="flex-auto">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Tagy
                </h2>

            </div>
            @can('create', App\Models\Event::class)
                <div class="justify-end">
                    <a href="{{ route('tag.add') }}" >
                        <x-primary-button-sm>Vytvoriť tag</x-primary-button-sm>
                    </a>
                </div>
            @endcan
        </div>
    </x-slot>
    @if(isset($message))
        <x-std-alert>
            <x-slot:title>
                Informácia
            </x-slot:title>
            <ul>
                {{$message}}
            </ul>
        </x-std-alert>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-4">

                    @foreach($tags as $tag)
                        <div class="flex w-full h-12 md:h-7 px-3 md:px-1 rounded-3xl md:rounded-xl border-2 flex items-center space-x-1">
                            <div class="flex-initial">
                                <x-tag-view>
                                    {{$tag->name}}
                                </x-tag-view>
                            </div>
                            <div class="flex-auto">
                            </div>
                            <div class="flex-none">
                                <a href="{{route('tag.edit', $tag)}}">
                                <img src="{{asset('/icons/edit.svg')}}" class="inline w-8 md:w-4 my-auto cursor-pointer">
                                </a>

                                <form class="inline" method="POST" action="{{ route('tag.destroy', $tag) }}">
                                    @csrf
                                    @method('delete')
                                <img src="{{asset('/icons/delete.svg')}}" class="inline w-8 md:w-4 my-auto cursor-pointer" :href="route('tag.destroy', $tag)" onclick="event.preventDefault(); if(confirm('Chcete odstrániť tento tag?')){this.closest('form').submit();}">
                                </form>
                            </div>
                        </div>
                    @endforeach


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
