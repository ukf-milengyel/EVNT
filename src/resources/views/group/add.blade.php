<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vytvoriť novú skupinu') }}
        </h2>
    </x-slot>
    @if($errors->any())
        <x-std-error>
            <x-slot:title>
                Chyba
            </x-slot:title>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </x-std-error>
    @endif

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-std-form>
                <form method="POST" action="{{ route('group.store') }}">
                    @csrf
                    <div>
                        <x-input-label for="name" value="Názov skupiny" />
                        <x-std-text-input name="name" type="text" value="{{ old('name') }}"/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="permissions" value="Povolenia"/>
                        <x-std-text-input name="permissions" type="text" value="{{ old('permissions') }}"/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="color" value="Farba" />
                        <x-std-text-input name="color" placeholder="#3498eb" type="text" value="{{ old('color', '#3498eb') }}"/>
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>{{ __('Pridať') }}</x-primary-button>
                    </div>

                </form>
            </x-std-form>
        </div>
    </div>
</x-app-layout>
