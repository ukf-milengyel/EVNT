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
            <div class="justify-end">
                @can('create', App\Models\Event::class)
                <a href="{{ route('event.add') }}" >
                    <x-primary-button-sm>Vytvoriť podujatie</x-primary-button-sm>
                </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Zoznam podujatí
                    </h2>

                    <hr class="my-2">

                    Filter
                    <form method="get" action="{{route('event.index')}}">
                        <input type="radio" name="sort" value="1" {{$sort ? 'checked' : ''}}>Najnovšie
                        <input type="radio" name="sort" value="0" {{!$sort ? 'checked' : ''}}>Najstaršie
                        <br>
                        <input type="radio" name="archived" value="0" {{!$archived ? 'checked' : ''}}>Aktuálne
                        <input type="radio" name="archived" value="1" {{$archived ? 'checked' : ''}}>Archivované
                        <br>
                        <x-primary-button-sm type="submit">Filtrovať</x-primary-button-sm>
                    </form>

                    <hr class="my-2">

                    @foreach($events as $event)
                        <a class="cursor-pointer" onclick="showDetails('{{route('event.show', $event)}}')">
                            <h2 class="font-semibold text-l text-gray-800 leading-tight">{{$event->name}}</h2>
                            desc: {{$event->description}}<br>
                            user: {{$event->user->name}}<br>
                            @if($event->user->group != NULL)
                                group: {{$event->user->group->name}}<br>
                                color: {{$event->user->group->color}}<br>
                            @endif
                            created_at: {{$event->created_at}}<br>
                            date: {{$event->date}}<br>
                            organizer: {{$event->organizer}}<br>
                            location_name: {{$event->location_name}}<br>
                            location_address: {{$event->location_address}}<br>
                            image: {{$event->image}}<br>
                            <img src="{{url('/images/event/', $event->image)}}" class="w-20 object-cover rounded-lg overflow-hidden shadow-lg">
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <div id='detail-background'></div>
    <div id='detail-frame'>
        <div id="detail-spinner">
            <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
        <iframe id='detail-iframe'>

        </iframe>
        <div id='detail-spinner'></div>
        <div id='close-button' onclick='hideDetails()'>
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

    </div>


    <script src="{{asset("/js/detailframe.js")}}"></script>
</x-app-layout>
