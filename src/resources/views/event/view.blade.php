@push('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
@endpush
<x-barebones>
    <div class="mx-auto xl:pt-8">
        <img src="{{url('/images/event/', $event->image)}}" class="xl:absolute top-0 w-full xl:blur xl:opacity-25 h-0 xl:h-[36rem] mx-auto object-cover">
        <img src="{{url('/images/event/', $event->image)}}" onclick="window.open(this.src)" class="cursor-pointer mx-auto max-w-7xl w-full h-72 lg:h-[32rem] mx-auto object-cover xl:rounded-xl shadow-xl relative z-10">
    </div>
    <div class="pt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="flex flex-row gap-4 justify-between flex-wrap">
            <div class="break-words w-full grow lg:w-auto">
                <h2 class="font-bold text-6xl text-gray-800">
                    {{$event->name}}
                </h2>
                <h4 class="font-semibold text-xl text-gray-800">
                    {{$event->date}}
                </h4>
                <p class="text-gray-800 w-full lg:w-[45rem] xl:w-[58rem]">
                    {{$event->description}}
                </p>
            </div>
            <div class="break-words w-full lg:w-auto pt-4 lg:w-56">

                <div class="flex items-end gap-x-4 items-stretch lg:items-baseline lg:justify-end">
                    <x-primary-button-sm class="p-4 h-16 overflow-hidden w-full lg:w-auto rounded-full">
                        <img src="{{asset('/icons/facebook.png/')}}" class="mx-auto h-8">
                    </x-primary-button-sm>
                    <x-primary-button-sm class="p-4 h-16 overflow-hidden w-full lg:w-auto rounded-full">
                        <img src="{{asset('/icons/instagram.png/')}}" class="mx-auto h-8">
                    </x-primary-button-sm>
                    <x-primary-button-sm class="p-4 h-16 overflow-hidden w-full lg:w-auto rounded-full">
                        <img src="{{asset('/icons/twitter.png/')}}" class="mx-auto h-8">
                    </x-primary-button-sm>
                </div>

            <div class="text-center text-gray-800">
                <br>
                <p><span class="font-bold text-7xl">1234</span><br>prihlásených</p>
                <x-primary-button-sm class="mt-2">Prihlásiť sa</x-primary-button-sm>
            </div>

            <div class="pt-4">
                <p class="pt-2 text-xs text-gray-800">Vytvoril</p>
                <x-user-badge class="py-1">
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

                <p class="pt-2 text-xs text-gray-800">Miesto</p>
                {{$event->location_name}}<br>
                {{$event->location_address}}

                <p class="pt-2 text-xs text-gray-800">Dátum konania</p>
                {{$event->date}}

                <p class="pt-2 text-xs text-gray-800">Dátum vytvorenia</p>
                {{$event->created_at}}

                @unless($event->updated_at->eq($event->created_at))
                    <p class="pt-2 text-xs text-gray-800">Posledná úprava</p>
                    {{$event->updated_at}}
                @endunless

                <p class="pt-2 text-xs text-gray-800">Tagy</p>
                -

                <p class="pt-2 text-xs text-gray-800">Fotografie</p>
                1234

                <p class="pt-2 text-xs text-gray-800">Prílohy</p>
                1234
            </div>

            </div>
        </div>

        <div class="mt-4">
            <h2 class="font-bold text-2xl text-gray-800">Fotografie</h2>

            <div class="mt-2 grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-4">
                <img src="{{url('/images/event/', $event->image)}}" class="w-60 object-cover rounded-lg overflow-hidden shadow-lg" onclick="window.open(this.src)">
                <img src="{{url('/images/event/', $event->image)}}" class="w-60 object-cover rounded-lg overflow-hidden shadow-lg" onclick="window.open(this.src)">
            </div>

            <h2 class="font-bold text-2xl text-gray-800">Prílohy</h2>
        </div>

    </div>
</x-barebones>
