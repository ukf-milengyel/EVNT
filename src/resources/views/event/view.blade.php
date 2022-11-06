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

            <div class="break-words w-70">

                <h2 class="font-semibold text-6xl text-gray-800 leading-tight rounded-full">

                    <x-primary-button-sm class="py-5 rounded-full "><img src="{{asset('/icons/Facebook.png/')}}" class="w-7 h-6 object-cover rounded-lg overflow-hidden shadow-lg"></x-primary-button-sm>
                    <x-primary-button-sm class="py-5 rounded-full"><img src="{{asset('/icons/Instagram.png/')}}"class="w-7 h-6 object-cover rounded-lg overflow-hidden shadow-lg"></x-primary-button-sm>
                    <x-primary-button-sm class="py-5 rounded-full"><img src="{{asset('/icons/Twitter.png/')}}"class="w-7 h-6 object-cover rounded-lg overflow-hidden shadow-lg"></x-primary-button-sm>
                </h2>

            <div class="text-center">
                <br>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    X
                    <br> prihlásených
                </h2>
                <br>


                <h2 class="font-semibold text-6xl text-gray-800 leading-tight">
                <x-primary-button-sm>Prihlásiť sa</x-primary-button-sm>
                </h2>

                <br>
            </div>




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

                    Location Name: {{$event->location_name}}</br>
                    Location Adress: {{$event->location_address}}</br>

                    User: {{$event->user->name}} </br>
                    Group: {{$event->user->group->name}}</br>
                    Organizer: {{$event->organizer}} </br>

                    Created: {{$event->date}}</br>


            </div>

        </div>


        <div>

            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Fotografie</h2>
            <br>

            <div class="grid grid-cols-10 gap-4">
                <img src="{{url('/images/event/', $event->image)}}" class="w-60 object-cover rounded-lg overflow-hidden shadow-lg" onclick="window.open(this.src)">
                <img src="{{url('/images/event/', $event->image)}}" class="w-60 object-cover rounded-lg overflow-hidden shadow-lg" onclick="window.open(this.src)">

            </div>

            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Prilohy</h2>
            <br>
            <x-primary-button-sm>Nahrat prilohy</x-primary-button-sm>

        </div>


    </div>
</x-barebones>
