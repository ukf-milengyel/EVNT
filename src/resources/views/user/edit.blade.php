<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upraviť používateľa ') . $user->name }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-std-form>
                <form method="POST" action="{{ route('user.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="mt-4">
                        <x-input-label for="group" value="Skupina"/>
                        <x-std-text-input name="group" type="text" value="{{ $user->group }}" required />
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>{{ __('Uložiť') }}</x-primary-button>
                    </div>

                </form>
            </x-std-form>
        </div>
    </div>

</x-app-layout>
