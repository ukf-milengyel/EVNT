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
                   Vytvorenie novej skupiny
                    <br>
                    <form method="POST" action="{{ route('group.store') }}">
                        @csrf
                        <div style="background-color:white">
                            <table width="75%" style="margin: 0 auto; border:0px solid;text-align:center">
                                <tr>
                                <td><label for="name">Názov skupiny</label></td>
                                <td><input name="name" type="text" value="{{ old('name') }}"></td>
                                </tr>
                                <tr>
                                    <td> <label for="permissions">Povolenia</label></td>
                                    <td> <input name="permissions" type="text" value="{{ old('permissions') }}"></td>
                                </tr>
                                <tr>
                                    <td> <label for="color">Farba</label></td>
                                    <td> <input name="color" placeholder="#3498eb" type="text" value="{{ old('color') }}"></td>
                                </tr>
                                <tr>
                                    <td> <x-input-error :messages="$errors->get('message')" class="mt-2" /></td>
                                    <td> <x-primary-button class="mt-4">{{ __('Pridať') }}</x-primary-button></td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
