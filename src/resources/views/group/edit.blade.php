<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upraviť skupinu ') . $group->name }}
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
                <form method="POST" action="{{ route('group.update', $group) }}">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" value="Názov skupiny" />
                        <x-std-text-input name="name" type="text" value="{{ $group->name }}"/>
                    </div>

                    <div class="mt-4">
                        <script src="{{asset("/js/jscolor.js")}}"></script>
                        <x-input-label for="color" value="Farba" />
                        <x-std-text-input name="color" placeholder="#3498eb" type="text" value="{{ $group->color }}" data-jscolor="{preset:'large', position:'bottom'}"/>
                    </div>

                    <div class="mt-4">
                        <x-input-label value="Povolenia" />
                        <x-std-checkbox>
                            Administrátor
                            <x-slot:id>check-1</x-slot:id>
                            <x-slot:name>check-1</x-slot:name>
                            <x-slot:subtext>Používateľ má prístup k administrátorskému rozhraniu</x-slot:subtext>
                        </x-std-checkbox>
                        <x-std-checkbox>
                            Udalosti
                            <x-slot:id>check-2</x-slot:id>
                            <x-slot:name>check-2</x-slot:name>
                            <x-slot:subtext>Používateľ vie vytvárať udalosti</x-slot:subtext>
                        </x-std-checkbox>
                        <x-std-checkbox>
                            Tagy
                            <x-slot:id>check-4</x-slot:id>
                            <x-slot:name>check-4</x-slot:name>
                            <x-slot:subtext>Používateľ vie vytvárať vlastné tagy</x-slot:subtext>
                        </x-std-checkbox>
                        <x-std-checkbox>
                            Fotografie
                            <x-slot:id>check-8</x-slot:id>
                            <x-slot:name>check-8</x-slot:name>
                            <x-slot:subtext>Používateľ vie k vytvoreným udalostiam pridať fotografie</x-slot:subtext>
                        </x-std-checkbox>
                        <x-std-checkbox>
                            Prílohy
                            <x-slot:id>check-16</x-slot:id>
                            <x-slot:name>check-16</x-slot:name>
                            <x-slot:subtext>Používateľ vie k vytvoreným udalostiam pridať prílohy</x-slot:subtext>
                        </x-std-checkbox>
                    </div>

                    <script>
                        for (let i = 0; i < 5; ++i) {
                            const current = Math.pow(2,i);
                            document.getElementById("check-"+current).checked = ({{$group->permissions}} & current);
                        }
                    </script>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>Uložiť</x-primary-button>
                    </div>

                </form>
            </x-std-form>
        </div>
    </div>

</x-app-layout>
