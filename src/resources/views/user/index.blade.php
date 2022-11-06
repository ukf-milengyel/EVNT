@push('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
@endpush

<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <div class="flex-auto">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Používatelia ') . "(".$users->count().")" }}
                </h2>
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

                    <table class="w-full text-sm text-left">
                        <thead>
                        <tr class="border-b bg-white sticky top-0">
                            <th>Akcie</th>
                            <th>Meno</th>
                            <th>E-mail</th>
                            <th>Skupina</th>
                            <th>Vytvorený</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b">

                                <td>
                                    <a href="{{route('user.edit', $user)}}" >
                                        <x-primary-button  class="btn btn-secondary" >Upraviť</x-primary-button>
                                    </a>
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <x-user-badge class="py-1 mr-2">
                                        @if($user->group)
                                            <x-slot:name>{{$user->group->name}}</x-slot:name>
                                            <x-slot:group>{{$user->group->permissions}}</x-slot:group>
                                            <x-slot:color>{{$user->group->color}}</x-slot:color>
                                        @endif
                                    </x-user-badge>
                                </td>

                                <td>{{$user->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
