@push('css')
<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
@endpush

<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <div class="flex-auto">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Skupiny ') . "(".$groups->count().")" }}
                </h2>
            </div>
            <div class="justify-end">
                <a href="{{ route('group.add') }}" >
                    <x-primary-button-sm>Pridať skupinu</x-primary-button-sm>
                </a>
            </div>


        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b bg-white sticky top-0">
                                <th>Akcie</th>
                                <th>Meno</th>
                                <th>Používatelia</th>
                                <th>Farba</th>
                                <th>Admin</th>
                                <th>Udalosti</th>
                                <th>Tagy</th>
                                <th>Fotografie</th>
                                <th>Prílohy</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                            <tr class="border-b">

                                <td>
                                    <a href="{{route('group.edit', $group)}}" >
                                        <x-primary-button  class="btn btn-secondary" >Upraviť</x-primary-button>
                                    </a>

                                    @if($group->user->count() == 0)
                                        <form class="inline" method="POST" action="{{ route('group.destroy', $group) }}">
                                            @csrf
                                            @method('delete')
                                            <x-primary-button class="btn btn-secondary" :href="route('group.destroy', $group)" onclick="event.preventDefault(); if(confirm('Chcete odstrániť túto skupinu?')){this.closest('form').submit();}">
                                                Vymazať
                                            </x-primary-button>
                                        </form>
                                    @endif



                                <td>{{$group->name}}</td>
                                <td>{{$group->user->count()}}</td>
                                <td class="text-center text-white text-outline rounded-md" style="background-color: {{$group->color}};">{{$group->color}}</td>
                                <td class="permissions">{{$group->permissions}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        // current limit on permissions
                        const permLimit = 31;
                        // select all permission values in table
                        const permList = document.querySelectorAll('td.permissions');
                        permList.forEach((node) => {
                            const parent = node.parentElement;  // get parent for later use
                            const permValue = node.innerText;   // get current permission value
                            node.remove();                      // remove permission node as is

                            // create new node containing checkboxes
                            let checkBoxes = "";
                            for (let i = 1; i < permLimit; i*=2) {
                                checkBoxes += (permValue & i)
                                    ? "<td><input type='checkbox' onclick='return false;' checked></td>"
                                    : "<td><input type='checkbox' onclick='return false;'></td>";
                            }

                            parent.innerHTML += checkBoxes;     // append to parent
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
