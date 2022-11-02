<x-barebones>
    <div class="w-full text-center">
        <h2 class="font-semibold text-6xl text-gray-800 leading-tight">
            {{$event->name}}
        </h2>

        desc: {{$event->description}}<br>
        user: {{$event->user->name}}<br>
        group: {{$event->user->group->name}}<br>
        color: {{$event->user->group->color}}<br>
        date: {{$event->date}}<br>
        organizer: {{$event->organizer}}<br>
        location_name: {{$event->location_name}}<br>
        location_address: {{$event->location_address}}<br>
        image: {{$event->image}}<br>
        <img src="{{url('/images/event/', $event->image)}}" class="w-auto mx-auto object-cover rounded-lg overflow-hidden shadow-lg">
    </div>
</x-barebones>
