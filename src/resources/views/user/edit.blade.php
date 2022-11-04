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

                    <div>
                        <x-input-label for="group" value="Skupina" />
                        <select id="groupselect" onchange="translatePermissions(this.options[this.selectedIndex].dataset.perms)" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="group">
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}"
                                @if($user->group != NULL && $group->id == $user->group->id) selected @endif
                                data-perms="{{$group->permissions}}"
                                >{{$group->name}} ({{$group->permissions}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        Používateľ bude mať prístup k:
                        <div id="checkboxes"></div>
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
            // current limit on permissions
            const permissionNames = ["Admin","Udalosti","Tagy","Fotografie","Prílohy"];

             let checkBoxes = "";
             for (let i = 0; i < permissionNames.length; ++i) {
                 checkBoxes += (perms & Math.pow(2,i))
                     ? "<input type='checkbox' onclick='return false;' checked>" + permissionNames[i]+"<br>"
                     : "<input type='checkbox' onclick='return false;'>"  + permissionNames[i]+"<br>";
             }

             document.getElementById("checkboxes").innerHTML = checkBoxes;     // append to parent
        }

        groupSelect = document.getElementById("groupselect")
        translatePermissions(groupSelect.options[groupSelect.selectedIndex].dataset.perms)
    </script>

</x-app-layout>
