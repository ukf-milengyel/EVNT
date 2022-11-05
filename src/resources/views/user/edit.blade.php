<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upraviť používateľa ') . $user->name }}
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
                <form method="POST" action="{{ route('user.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <x-input-label for="n" value="Používateľ" />
                    <x-std-text-input name="n" type="text" value="{{ $user->name }}" disabled/>

                    <x-input-label class="mt-4" for="group" value="Skupina" />
                    <select id="groupselect" onchange="translatePermissions(this.options[this.selectedIndex].dataset.perms)" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="group">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}"
                            @if($user->group != NULL && $group->id == $user->group->id) selected @endif
                            data-perms="{{$group->permissions}}"
                            data-color="{{$group->color}}"
                            >{{$group->name}} ({{$group->permissions}})</option>
                        @endforeach
                    </select>

                    <div class="mt-4">
                        <x-input-label value="Povolenia" />
                        <x-std-checkbox>
                            Administrátor
                            <x-slot:id>check-1</x-slot:id>
                            <x-slot:onclick>return false;</x-slot:onclick>
                            <x-slot:subtext>Používateľ má prístup k administrátorskému rozhraniu</x-slot:subtext>
                        </x-std-checkbox>
                        <x-std-checkbox>
                            Udalosti
                            <x-slot:id>check-2</x-slot:id>
                            <x-slot:onclick>return false;</x-slot:onclick>
                            <x-slot:subtext>Používateľ vie vytvárať udalosti</x-slot:subtext>
                        </x-std-checkbox>
                        <x-std-checkbox>
                            Tagy
                            <x-slot:id>check-4</x-slot:id>
                            <x-slot:onclick>return false;</x-slot:onclick>
                            <x-slot:subtext>Používateľ vie vytvárať vlastné tagy</x-slot:subtext>
                        </x-std-checkbox>
                        <x-std-checkbox>
                            Fotografie
                            <x-slot:id>check-8</x-slot:id>
                            <x-slot:onclick>return false;</x-slot:onclick>
                            <x-slot:subtext>Používateľ vie k vytvoreným udalostiam pridať fotografie</x-slot:subtext>
                        </x-std-checkbox>
                        <x-std-checkbox>
                            Prílohy
                            <x-slot:id>check-16</x-slot:id>
                            <x-slot:onclick>return false;</x-slot:onclick>
                            <x-slot:subtext>Používateľ vie k vytvoreným udalostiam pridať prílohy</x-slot:subtext>
                        </x-std-checkbox>
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>{{ __('Uložiť') }}</x-primary-button>
                    </div>

                </form>
            </x-std-form>
        </div>
    </div>

    <script>
        function translatePermissions(perms) {
            for (let i = 0; i < 5; ++i) {
                const current = Math.pow(2,i);
                document.getElementById("check-"+current).checked = (perms & current);
            }
        }
        // translate initial group
        groupSelect = document.getElementById("groupselect")
        translatePermissions(groupSelect.options[groupSelect.selectedIndex].dataset.perms)
    </script>

</x-app-layout>
