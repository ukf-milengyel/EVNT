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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-5 px-2 w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-4">

                    @foreach($tags as $tag)
                        <div class="flex w-full px-1 rounded-xl border-2 flex items-center space-x-1">
                            <div class="flex-initial">
                                <x-tag-view class="md:max-w-[10em]">
                                    <x-slot:tag>{{$tag->name}}</x-slot:tag>
                                </x-tag-view>
                            </div>
                            <div class="flex-auto">
                            </div>
                            <div class="flex-none">
                                <img src="{{asset('/icons/edit.svg')}}" class="inline w-4 my-auto cursor-pointer">
                                <img src="{{asset('/icons/delete.svg')}}" class="inline underline w-4 my-auto cursor-pointer" :href="route('tag.destroy', $tag)" onclick="event.preventDefault(); if(confirm('Chcete odstrániť tento tag?')){this.closest('form').submit();}">
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>
        </div>
    </div>
</x-app-layout>
