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
                                <x-tag-view class="md:max-w-[10em]">
                                    <x-slot:tag>{{$tag->name}}</x-slot:tag>
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
