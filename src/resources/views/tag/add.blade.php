<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vytvoriť tag
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <x-std-form>
                        <form method="POST" action="{{ route('tag.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <x-input-label for="name" value="Názov tagu" />
                                <x-std-text-input name="name" type="text" value="{{ old('name') }}"/>
                            </div>

                            <div class="flex justify-end mt-8">
                                <x-primary-button>{{ __('Pridať') }}</x-primary-button>
                            </div>
                        </form>
                    </x-std-form>
                </div>
            </div>
</x-app-layout>
