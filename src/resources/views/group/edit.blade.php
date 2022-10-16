<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upraviť skupinu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    --- tu bude formulár na upravenie skupiny ---
                    <br>
                    <form method="POST" action="{{ route('group.update', $group) }}">
                        @csrf
                        @method('PUT')
                        <label for="name">Názov skupiny</label>
                        <input name="name" type="text" value="{{ $group->name }}">
                        <br>
                        <label for="permissions">Povolenia</label>
                        <input name="permissions" type="text" value="{{ $group->permissions }}">
                        <br>
                        <label for="color">Farba</label>
                        <input name="color" placeholder="#3498eb" type="text" value="{{ $group->color }}">


                        <br>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        <x-primary-button class="mt-4">{{ __('Potvrdiť') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
