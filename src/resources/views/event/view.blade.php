@push('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
@endpush
<x-barebones>
    <div class="mx-auto xl:pt-8">
        <img src="{{url('/images/event/', $event->image)}}" class="xl:absolute top-0 w-full xl:blur xl:opacity-25 h-0 xl:h-[36rem] mx-auto object-cover">
        <img src="{{url('/images/event/', $event->image)}}" onclick="window.open(this.src)" class="cursor-pointer mx-auto max-w-7xl w-full h-72 transition-transform xl:hover:scale-[1.02] lg:h-[32rem] mx-auto object-cover xl:rounded-xl shadow-xl relative z-10">
    </div>
    <div class="pt-4 sm:pt-8 mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">

        <div class="flex flex-wrap lg:flex-nowrap gap-4 justify-between">

            <div class="break-words lg:w-auto">
                <h2 class="font-bold text-6xl text-gray-800">
                    {{$event->name}}
                </h2>
                <h4 class="font-semibold text-xl text-gray-800">
                    {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y, h:i:s') }}
                </h4>
                <p class="text-gray-800">
                    {{$event->description}}
                </p>

                <!-- todo: nahradiť checkom, či používateľ je autor príspevku -->
                @if(true)
                <form method="POST" action="{{ route('announcement.store') }}" class="py-4 px-6 border-2 rounded-xl border-gray-300" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="body" value="Nové oznámenie" />
                        <x-std-textarea name="description">{{ old('description') }}</x-std-textarea>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="image" value="Fotografia" />
                        <input id="picker" name="image" type="file"/>
                    </div>
                    <div class="flex justify-end mt-8">
                        <x-primary-button>{{ __('Pridať') }}</x-primary-button>
                    </div>
                </form>
                @endif
                <!-- todo: nahradiť checkom, či existujú oznámenia -->
                @if(true)
                    <h2 class="font-bold mt-4 text-2xl text-gray-800">Oznámenia</h2>
                    <!-- todo: vytvoriť komponent pre oznámenie -->
                @endif

            </div>

            <div class="break-words w-full lg:w-56 pt-4 shrink-0">

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

                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-1">
                    <div>
                        <p class="pt-2 text-xs text-gray-800">Miesto</p>
                        <span class="font-semibold">{{$event->location_name}}</span><br>
                        {{$event->location_address}}
                    </div>

                    <div>
                        <p class="pt-2 text-xs text-gray-800">Dátum konania</p>
                        {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y, h:i') }}
                    </div>

                    <div>
                        <p class="pt-2 text-xs text-gray-800">Dátum vytvorenia</p>
                        {{ \Carbon\Carbon::parse($event->created_at)->format('d.m.Y, h:i') }}
                    </div>

                    @unless($event->updated_at->eq($event->created_at))
                        <div>
                            <p class="pt-2 text-xs text-gray-800">Posledná úprava</p>
                            {{ \Carbon\Carbon::parse($event->updated_at)->format('d.m.Y, h:i') }}
                        </div>
                    @endunless

                    <div>
                        <p class="pt-2 text-xs text-gray-800">Tagy</p>
                        -
                    </div>

                    <div>
                        <p class="pt-2 text-xs text-gray-800">Fotografie</p>
                        1234
                    </div>

                    <div>
                        <p class="pt-2 text-xs text-gray-800">Prílohy</p>
                        1234
                    </div>
                </div>
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
