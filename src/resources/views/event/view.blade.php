<x-barebones>
    <div class="mx-5  text-center ">


        <div class="mx-auto">

            <img src="{{url('/images/event/', $event->image)}}" class="w-auto mx-auto object-cover rounded-lg overflow-hidden shadow-lg">

        </div>

        <div class="flex flex-row">
            <div class="basis-1/5">
                <h2 class="font-semibold text-6xl text-gray-800 leading-tight">
                    {{$event->name}}
                </h2>
            </div>
            <div class="flex-none basis-3/5">

            </div>
            <div class="basis-1/5 ">
                <x-primary-button-sm>Share</x-primary-button-sm>
            </div>
        </div>

        Description: {{$event->description}}<br>
        User: {{$event->user->name}}<br>
        @if($event->user->group != NULL)
            Group: {{$event->user->group->name}}<br>

                <div class="grid grid-cols-6 gap-5">
                    <div class="col-start-3 col-end-5">
            <x-user-badge >
                <x-slot:group>Color</x-slot:group>
                <x-slot:color>{{$event->user->group->color}}</x-slot:color>
            </x-user-badge>
                    </div>
                </div>
        @endif
        Date: {{$event->date}}<br>
        Organizer: {{$event->organizer}}<br>
        Location Name: {{$event->location_name}}<br>
        Location Adress: {{$event->location_address}}<br>



            <div>
                Prílohy<br>Prílohy<br>Prílohy<br>Prílohy<br>Prílohy<br>Prílohy<br>Prílohy
            </div>
    </div>

</x-barebones>
