@push('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/spinner.css') }}" rel="stylesheet" type="text/css">
@endpush
<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <div class="flex-auto">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Podujatia
                </h2>
            </div>
            @can('create', App\Models\Event::class)
            <div class="justify-end">
                <a href="{{ route('event.add') }}" >
                    <x-primary-button-sm>Vytvoriť podujatie</x-primary-button-sm>
                </a>
            </div>
            @endcan
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
                    <form method="get" action="{{route('event.index')}}">
                        Zoradenie
                        <br>
                        <input type="radio" name="category" value="0" {{$category == 0 ? 'checked' : ''}}>Dátum vytvorenia
                        <input type="radio" name="category" value="1" {{$category == 1 ? 'checked' : ''}}>Dátum uskutočnenia
                        <input type="radio" name="category" value="2" {{$category == 2 ? 'checked' : ''}}>Názov
                        <br>
                        <input type="radio" name="sort" value="1" {{$sort ? 'checked' : ''}}>v
                        <input type="radio" name="sort" value="0" {{!$sort ? 'checked' : ''}}>^
                        <br>
                        Kategória
                        <br>
                        <input type="radio" name="archived" value="0" {{!$archived ? 'checked' : ''}}>Aktuálne
                        <input type="radio" name="archived" value="1" {{$archived ? 'checked' : ''}}>Archivované
                        <br>
                        <x-primary-button-sm type="submit">Filtrovať</x-primary-button-sm>
                    </form>

                    <hr class="my-2">

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

                        @foreach($events as $event)

                            <x-event-component>
                                <x-slot:img>{{url('/images/event_thumb/', $event->image)}}</x-slot:img>
                                <x-slot:onclick>showDetails('{{route('event.show', $event)}}')</x-slot:onclick>
                                <x-slot:participants>10</x-slot:participants>
                                <x-slot:name>{{$event->name}}</x-slot:name>
                                <x-slot:date>{{$event->date}}</x-slot:date>
                                <x-slot:organizer>
                                    <x-user-badge>
                                        @if($event->organizer)
                                            <x-slot:name>{{$event->organizer}}</x-slot:name>
                                        @else
                                            <x-slot:name>{{$event->user->name}}</x-slot:name>
                                        @endif
                                        @if($event->user->group)
                                            <x-slot:group>{{$event->user->group->name}}</x-slot:group>
                                            <x-slot:color>{{$event->user->group->color}}</x-slot:color>
                                        @endif
                                    </x-user-badge>
                                </x-slot:organizer>
                            </x-event-component>

                        @endforeach
                    </div>

        </div>
    </div>

    <div id='detail-background'></div>
    <div id='detail-frame' class="overflow-hidden z-10 bg-white rounded-lg shadow-2xl">
        <div id="detail-spinner">
            <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
        <iframe id='detail-iframe' class="border-none w-full h-full">

        </iframe>
        <div id='detail-spinner'></div>
        <div id='close-button' class="bg-white rounded-full shadow-lg w-10 h-10 fixed top-6 right-8 cursor-pointer z-10" onclick='hideDetails()'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

    </div>


    <script src="{{asset("/js/detailframe.js")}}"></script>
</x-app-layout>
