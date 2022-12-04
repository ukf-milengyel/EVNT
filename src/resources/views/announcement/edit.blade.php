<x-barebones class="bg-gray-100">
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
            <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight mb-8">
                Upraviť oznámenie
            </h2>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('announcement.update', $announcement) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <x-input-label for="body" value="Správa" />
                            <x-std-textarea name="body">{{ $announcement->body }}</x-std-textarea>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="image" value="Fotografia" />
                            <input id="picker" name="image" type="file"/>
                        </div>
                        <div class="flex justify-end">
                            <x-primary-button>{{ __('Pridať') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-barebones>
