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
            </div>
        </div>
    </div>
</x-app-layout>
