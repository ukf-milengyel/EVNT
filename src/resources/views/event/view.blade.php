@push('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
@endpush
<x-barebones>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mx-auto">

            <img src="{{url('/images/event/', $event->image)}}" class="w-auto mx-auto object-cover rounded-lg overflow-hidden shadow-lg">

        </div>


        <div class="flex justify-between  md:justify-between" >
            <div class="break-words min-w-[15%] max-w-[70%]">
                <h2 class="font-semibold text-6xl text-gray-800 leading-tight">
                    {{$event->name}}
                </h2>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    <?php echo date("Y/m/d");?>
                </h2> <br>
                    Description: {{$event->description}} <br>






            </div>

            <div class="break-words w-60">
                <h2 class="font-semibold text-6xl text-gray-800 leading-tight">
                    <x-primary-button-sm>Share</x-primary-button-sm>
                </h2>

                @if($event->user->group != NULL)



                    <div>
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

                        @endif
                    </div>
                    User: {{$event->user->name}} </br>
                    Group: {{$event->user->group->name}}</br>
                    Organizer:: {{$event->organizer}} </br>
                    Location Name: {{$event->location_name}}</br>
                    Location Adress: {{$event->location_address}}</br>
                    Created: {{$event->date}}</br>

                tagy-tagy-tagy-tagy<br>
                tagy-tagy-tagy-tagy<br>
                tagy-tagy-tagy-tagy
            </div>

        </div>


        <div>
            ----------------------------------------------------------------------------<br>
            Fotografie<br>
            fotografie-fotografie-fotografie-fotografie-fotografie-fotografie-fotografie<br>
            Prilohy<br>
            prilohy-prilohy-prilohy-prilohy-prilohy-prilohy-prilohy-prilohy-prilohy-prilohy
        </div>


    </div>
</x-barebones>
