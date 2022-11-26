<x-barebones>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upraviť podujatie
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

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6">

                    <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
                        Upraviť podujatie {{$event->name}}
                    </h2>

                    <div class="py-4">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                            <x-std-form>
                                <form method="POST" action="{{ route('event.update', $event) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div>
                                        <x-input-label for="name" value="Názov podujatia" />
                                        <x-std-text-input name="name" type="text" value="{{ old('name', $event->name) }}"/>
                                    </div>

                                    <div class="mt-4">
                                        <x-input-label for="description" value="Popis" />
                                        <x-std-textarea name="description">{{ old('description', $event->description) }}</x-std-textarea>
                                    </div>

                                    <div class="mt-4">
                                        <x-input-label for="date" value="Dátum" />
                                        <x-std-text-input name="date" type="datetime-local" value="{{ old('date', $event->date) }}"/>
                                    </div>

                                    <div class="mt-4">
                                        <x-input-label for="organizer" value="Organizátor (nepovinné)" />
                                        <x-std-text-input name="organizer" type="text" value="{{ old('organizer', $event->organizer) }}"/>
                                    </div>

                                    <div class="mt-4">
                                        <x-input-label for="location_name" value="Miesto" />
                                        <x-std-text-input name="location_name" type="text" value="{{ old('location_name', $event->location_name) }}"/>
                                    </div>

                                    <div class="mt-4">
                                        <x-input-label for="location_address" value="Adresa (nepovinné)" />
                                        <x-std-text-input name="location_address" type="text" value="{{ old('location_address', $event->location_address) }}"/>
                                    </div>

                                    <div class="mt-4">
                                        <x-input-label for="tags" value="Tagy (Max 10, držte CTRL pre výber viacerých)" />
                                        <select name="tags[]" class="rounded-md w-full h-72 shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" multiple>
                                            @foreach($tags as $tag)
                                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-4">
                                        <x-input-label for="image" value="Fotografia" />
                                        <input id="picker" name="image" type="file" accept="image/png, image/jpeg"/>
                                        <img id="preview" href="{{url('/images/event_thumb/', $event->image)}}" class="my-2 object-cover relative mx-auto rounded-lg overflow-hidden shadow-lg">
                                    </div>

                                    <div class="flex justify-end mt-8">
                                        <x-primary-button>{{ __('Uložiť') }}</x-primary-button>
                                    </div>
                                </form>
                            </x-std-form>

                            <script>
                                const filePicker = document.getElementById("picker");
                                const imgPreview = document.getElementById("preview");

                                filePicker.addEventListener("change", function () {
                                    const files = filePicker.files[0];
                                    if (files) {
                                        const fileReader = new FileReader();
                                        fileReader.readAsDataURL(files);
                                        fileReader.addEventListener("load", function () {
                                            imgPreview.src = this.result;
                                        });
                                    }
                                });
                            </script>
                        </div>
                    </div>

                </div>
        </div>
    </div>
</x-barebones>
