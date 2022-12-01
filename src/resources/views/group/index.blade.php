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
                    <x-primary-button-sm>Vytvoriť skupinu</x-primary-button-sm>
                </a>
            </div>


        </div>
    </x-slot>
    @if(isset($message))
        <x-std-alert>
            <x-slot:title>
                Informácia
            </x-slot:title>
            <ul>
                {{$message}}
            </ul>
        </x-std-alert>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full table-auto text-sm text-left">
                        <thead>
                            <tr class="text-xs uppercase border-b bg-white sticky top-0">
                                <th class="pr-2 py-1">Meno</th>
                                <th class="pr-2">Používatelia</th>
                                <th class="pr-2 w-20">Farba</th>
                                <th class="pr-2 w-16">Admin</th>
                                <th class="pr-2 w-16">Udalosti</th>
                                <th class="pr-2 w-16">Tagy</th>
                                <th class="pr-2 w-16">Fotografie</th>
                                <th class="pr-2 w-16">Prílohy</th>
                                <th class="w-14">Akcie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                            <tr class="border-b">
                                <td>{{$group->name}}</td>
                                <td>{{$group->user->count()}}</td>
                                <td>
                                    <x-user-badge class="py-1 mr-2">
                                        <x-slot:name>{{$group->color}}</x-slot:name>
                                        @if($group->color)
                                            <x-slot:color>{{$group->color}}</x-slot:color>
                                        @endif
                                    </x-user-badge>
                                </td>
                                <td class="permissions">{{$group->permissions}}</td>
                                <td>
                                    <a href="{{route('group.edit', $group)}}">
                                        <img src="{{asset('/icons/edit.svg')}}" class="inline underline w-6 my-auto cursor-pointer">
                                    </a>

                                    <form class="inline" method="POST" action="{{ route('group.destroy', $group) }}">
                                        @csrf
                                        @method('delete')
                                        <img src="{{asset('/icons/delete.svg')}}" class="inline underline w-6 my-auto cursor-pointer" :href="route('group.destroy', $group)" onclick="event.preventDefault(); if(confirm('Chcete odstrániť túto skupinu?')){this.closest('form').submit();}">
                                    </form>
                                </td>
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
                            const permValue = node.innerText;   // get current permission value

                            // create new nodes containing checkboxes
                            const nodesFragment = document.createDocumentFragment();
                            for (let i = 1; i < permLimit; i*=2) {
                                const newNode = document.createElement('td')
                                newNode.innerHTML = (permValue & i)
                                    ? "<input class='rounded' type='checkbox' onclick='return false;' checked>"
                                    : "<input class='rounded' type='checkbox' onclick='return false;'>";

                                nodesFragment.appendChild(newNode);
                            }

                            node.replaceWith(nodesFragment);
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


