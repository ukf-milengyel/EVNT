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
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                @if($user->group != NULL)
                                    <td class="text-center text-white text-outline rounded-md" style="background-color: {{$user->group->color}};">{{$user->group->name}} ({{$user->group->permissions}})</td>
                                @else
                                    <td class="text-center text-white text-outline rounded-md" style="background-color: #333;">Bez skupiny (0)</td>
                                @endif

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
