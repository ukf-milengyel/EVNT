<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <div class="flex-auto">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Podujatia sort: {{$sort}}
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Zoznam podujatí
                    </h2>

                    @foreach($events as $event)
                        <a href="{{route('event.show', $event)}}">
                            <h2 class="font-semibold text-l text-gray-800 leading-tight">{{$event->name}}</h2>
                            desc: {{$event->description}}<br>
                            user: {{$event->user->name}}<br>
                            @if($event->user->group != NULL)
                                group: {{$event->user->group->name}}<br>
                                color: {{$event->user->group->color}}<br>
                            @endif
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
</x-app-layout>
