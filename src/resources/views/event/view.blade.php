<x-barebones>
    <div class="mx-5">


        <div class="mx-auto">

            <img src="{{url('/images/event/', $event->image)}}" class="w-auto mx-auto object-cover rounded-lg overflow-hidden shadow-lg">

        </div>
        <div class="grid grid-cols-6 gap-4" >
            <div class="place-self-end col-start-1 ">
                <h2 class="font-semibold text-6xl text-gray-800 leading-tight">
                    {{$event->name}}
                </h2>
            </div>
            <div class="place-self-center col-start-6 ">
                <h2 class="font-semibold text-6xl text-gray-800 leading-tight">
                    <x-primary-button-sm>Share</x-primary-button-sm>
                </h2>
            </div>

            <div class="place-self-start col-start-3 ">
                Description:
            </div>
            <div class="col-start-4 ">
                {{$event->description}}
            </div>

            <div class="place-self-start col-start-3 ">
                User:
            </div>
            <div class="col-start-4 ">
                {{$event->user->name}}
            </div>

            @if($event->user->group != NULL)
                <div class="place-self-start col-start-3 "> Group: </div>
                    <div class="col-start-4 "> {{$event->user->group->name}} </div>
                <div class="place-self-start col-start-3 "> Color: </div>
                <div class="col-start-4 ">
                    <div class="grid grid-cols-6 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-6 gap-6">
                        <div class="col-start-1 col-end-3 col-span-1">
                            <x-user-badge >
                                <x-slot:group>Color</x-slot:group>
                                <x-slot:color>{{$event->user->group->color}}</x-slot:color>
                            </x-user-badge>
                        </div>
                    </div>
                </div>
                @endif

            <div class="place-self-start col-start-3 ">Date: </div>
                <div class="col-start-4 ">{{$event->date}} </div>
            <div class="place-self-start col-start-3 ">Organizer:</div>
                <div class="col-start-4 ">{{$event->organizer}}</div>
            <div class="place-self-start col-start-3 ">Location Name:</div>
                <div class="col-start-4 ">{{$event->location_name}}</div>
            <div class="place-self-start col-start-3 ">Location Adress:</div>
                <div class="col-start-4 ">{{$event->location_address}}</div>

            <div class="place-self-start col-start-3 ">Prílohy:</div>
            <div class="col-start-4 "></div>


        </div>

    </div>
</x-barebones>
