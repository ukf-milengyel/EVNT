<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pridať novú skupinu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    --- tu bude formulár na vytvorenie novej skupiny ---
                    <br>
                    <form method="POST" action="{{ route('group.store') }}">
                        @csrf
                        <label for="name">Názov skupiny</label>
                        <input name="name" type="text" value="{{ old('name') }}">
                        <br>
                        <label for="permissions">Povolenia</label>
                        <input name="permissions" type="text" value="{{ old('permissions') }}">
                        <br>
                        <label for="color">Farba</label>
                        <input name="color" placeholder="#3498eb" type="text" value="{{ old('color') }}">


                        <br>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        <x-primary-button class="mt-4">{{ __('Pridať') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
