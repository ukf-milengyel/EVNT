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
                <div class="p-6 bg-white border-b border-gray-200">

                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Tabulka s tagmi
                    </h2>

                </div>


                <div class="py-5 px-2 w-full grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-4">

                    <div class="text-xs	px-px h-7 w-auto md:w-1/7 md:mx-auto md:rounded-xl border-2 flex items-center space-x-1">
                            <x-tag-view>
                                <x-slot:tag>Tag Komponent</x-slot:tag>
                            </x-tag-view>
                        <img src="{{asset('/icons/edit.svg')}}" class="inline underline w-4 my-auto cursor-pointer">
                        <img src="{{asset('/icons/delete.svg')}}" class="inline underline w-4 my-auto cursor-pointer" :href="route('group.destroy', $group)" onclick="event.preventDefault(); if(confirm('Chcete odstrániť tento tag?')){this.closest('form').submit();}">
                    </div>

                    <div class="text-xs	px-px h-7 w-auto md:w-1/7 md:mx-auto md:rounded-xl border-2 flex items-center space-x-1">
                        <x-tag-view>
                            <x-slot:tag>Druhý Tag</x-slot:tag>
                        </x-tag-view>
                        <img src="{{asset('/icons/edit.svg')}}" class="inline underline w-4 my-auto cursor-pointer">
                        <img src="{{asset('/icons/delete.svg')}}" class="inline underline w-4 my-auto cursor-pointer" :href="route('group.destroy', $group)" onclick="event.preventDefault(); if(confirm('Chcete odstrániť tento tag?')){this.closest('form').submit();}">
                    </div>

                    <div class="text-xs	px-px h-7 w-auto md:w-1/7 md:mx-auto md:rounded-xl border-2 flex items-center space-x-1">
                        <x-tag-view>
                            <x-slot:tag>Tretí Tag</x-slot:tag>
                        </x-tag-view>
                        <img src="{{asset('/icons/edit.svg')}}" class="inline underline w-4 my-auto cursor-pointer">
                        <img src="{{asset('/icons/delete.svg')}}" class="inline underline w-4 my-auto cursor-pointer" :href="route('group.destroy', $group)" onclick="event.preventDefault(); if(confirm('Chcete odstrániť tento tag?')){this.closest('form').submit();}">
                    </div>

                    <div class="text-xs	px-px h-7 w-auto md:w-1/7 md:mx-auto md:rounded-xl border-2 flex items-center space-x-1">
                        <x-tag-view>
                            <x-slot:tag>Štvrtý Tag</x-slot:tag>
                        </x-tag-view>
                        <img src="{{asset('/icons/edit.svg')}}" class="inline underline w-4 my-auto cursor-pointer">
                        <img src="{{asset('/icons/delete.svg')}}" class="inline underline w-4 my-auto cursor-pointer" :href="route('group.destroy', $group)" onclick="event.preventDefault(); if(confirm('Chcete odstrániť tento tag?')){this.closest('form').submit();}">
                    </div>

                    <div class="text-xs	px-px h-7 w-auto md:w-1/7 md:mx-auto md:rounded-xl border-2 flex items-center space-x-1">
                        <x-tag-view>
                            <x-slot:tag>Piaty Tag</x-slot:tag>
                        </x-tag-view>
                        <img src="{{asset('/icons/edit.svg')}}" class="inline underline w-4 my-auto cursor-pointer">
                        <img src="{{asset('/icons/delete.svg')}}" class="inline underline w-4 my-auto cursor-pointer" :href="route('group.destroy', $group)" onclick="event.preventDefault(); if(confirm('Chcete odstrániť tento tag?')){this.closest('form').submit();}">
                    </div>

                    <div class="text-xs	px-px h-7 w-auto md:w-1/7 md:mx-auto md:rounded-xl border-2 flex items-center space-x-1">
                        <x-tag-view>
                            <x-slot:tag>Šiesty Tag</x-slot:tag>
                        </x-tag-view>
                        <img src="{{asset('/icons/edit.svg')}}" class="inline underline w-4 my-auto cursor-pointer">
                        <img src="{{asset('/icons/delete.svg')}}" class="inline underline w-4 my-auto cursor-pointer" :href="route('group.destroy', $group)" onclick="event.preventDefault(); if(confirm('Chcete odstrániť tento tag?')){this.closest('form').submit();}">
                    </div>

                    <div class="text-xs	px-px h-7 w-auto md:w-1/7 md:mx-auto md:rounded-xl border-2 flex items-center space-x-1">
                        <x-tag-view>
                            <x-slot:tag>Siedmy Tag</x-slot:tag>
                        </x-tag-view>
                        <img src="{{asset('/icons/edit.svg')}}" class="inline underline w-4 my-auto cursor-pointer">
                        <img src="{{asset('/icons/delete.svg')}}" class="inline underline w-4 my-auto cursor-pointer" :href="route('group.destroy', $group)" onclick="event.preventDefault(); if(confirm('Chcete odstrániť tento tag?')){this.closest('form').submit();}">
                    </div>

                    <div class="text-xs	px-px h-7 w-auto md:w-1/7 md:mx-auto md:rounded-xl border-2 flex items-center space-x-1">
                        <x-tag-view>
                            <x-slot:tag>Osmy Tag</x-slot:tag>
                        </x-tag-view>
                        <img src="{{asset('/icons/edit.svg')}}" class="inline underline w-4 my-auto cursor-pointer">
                        <img src="{{asset('/icons/delete.svg')}}" class="inline underline w-4 my-auto cursor-pointer" :href="route('group.destroy', $group)" onclick="event.preventDefault(); if(confirm('Chcete odstrániť tento tag?')){this.closest('form').submit();}">
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
