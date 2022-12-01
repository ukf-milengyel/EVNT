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

                <div class="justify-end flex-none">
                    <x-primary-button-sm class="inline mr-2" id="dropdownRadioButton" data-dropdown-toggle="dropdownDefaultRadio" type="button">Filter<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></x-primary-button-sm>
                    @can('create', App\Models\Event::class)
                    <a href="{{ route('event.add') }}">
                        <x-primary-button-sm>Vytvoriť podujatie</x-primary-button-sm>
                    </a>
                    @endcan

                    <form method="get" action="{{route('event.index')}}">
                        <div id="dropdownDefaultRadio" class="hidden p-2 z-10 w-full sm:w-auto bg-white rounded-xl divide-y divide-gray-100 border-0 border-b sm:border border-gray-300 shadow-md">

                            <div class="pt-1 pb-3 px-2">
                                <span class="text-gray-800 pl-1 text-lg font-semibold">Textové vyhľadávanie</span>
                                <x-std-text-input name="textsearch" type="text" value="{{$textsearch}}"/>
                            </div>

                            <div class="flex flex-wrap py-2">
                                <div class="flex-auto pt-1 px-2">
                                    <span class="text-gray-800 pl-1 text-lg font-semibold">Tagy</span>
                                    <select name="tags[]" class="rounded-md mt-2 w-full h-[19rem] shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}"
                                                    @if( in_array($tag->id, $selectedTags) ) selected @endif
                                            >
                                                {{$tag->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex-auto">
                                    <ul class="px-2 py-1 space-y-1 text-sm text-gray-700 dark:text-gray-900" aria-labelledby="dropdownRadioButton">
                                        <span class="text-gray-800 text-lg font-semibold">Zobraziť</span>
                                        <li>
                                            <input type="radio" id="default-radio-1" name="my" value="0" {{$my == 0 ? 'checked' : ''}}>
                                            <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-800">Všetky podujatia</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="default-radio-2" name="my" value="1" {{$my == 1 ? 'checked' : ''}}>
                                            <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-800">Moje podujatia</label>
                                        </li>
                                        @can('create', App\Models\Event::class)
                                            <li>
                                                <input type="radio" id="default-radio-3" name="my" value="2" {{$my == 2 ? 'checked' : ''}}>
                                                <label for="default-radio-3" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-800">Vytvorené podujatia</label>
                                            </li>
                                        @endcan
                                    </ul>

                                    <ul class="px-2 py-1 space-y-1 text-sm text-gray-700 dark:text-gray-900" aria-labelledby="dropdownRadioButton2">
                                        <span class="text-gray-800 text-lg font-semibold">Kategória</span>
                                        <li>
                                            <input type="radio" id="default-radio-9" name="archived" value="0" {{!$archived ? 'checked' : ''}}>
                                            <label for="default-radio-9" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-800">Aktuálne</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="default-radio-10" name="archived" value="1" {{$archived ? 'checked' : ''}}>
                                            <label for="default-radio-10" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-800">Archivované</label>
                                        </li>
                                    </ul>

                                    <ul class="px-2 py-1 space-y-1 text-sm text-gray-700 dark:text-gray-900" aria-labelledby="dropdownRadioButton1">
                                        <span class="text-gray-800 text-lg font-semibold">Zoradiť</span>
                                        <li>
                                            <input type="radio" id="default-radio-4" name="order" value="0" {{$order == 0 ? 'checked' : ''}}>
                                            <label for="default-radio-4" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-800">Dátum vytvorenia</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="default-radio-5" name="order" value="1" {{$order == 1 ? 'checked' : ''}}>
                                            <label for="default-radio-5" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-800">Dátum uskutočnenia</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="default-radio-6" name="order" value="2" {{$order == 2 ? 'checked' : ''}}>
                                            <label for="default-radio-6" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-800">Názov</label>
                                        </li>
                                    </ul>

                                    <ul class="px-2 py-1 space-y-1 text-sm text-gray-700 dark:text-gray-900" aria-labelledby="dropdownRadioButton1">
                                        <li>
                                            <input type="radio" id="default-radio-7" name="sort" value="1" {{$sort ? 'checked' : ''}}>
                                            <label for="default-radio-7" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-800">Zostupne</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="default-radio-8" name="sort" value="0" {{!$sort ? 'checked' : ''}}>
                                            <label for="default-radio-8" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-800">Vzostupne</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="text-center pt-2">
                                <x-primary-button-sm type="submit">Filtrovať</x-primary-button-sm>
                            </div>

                        </div>




                    </form>

                </div>
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

                @foreach($events as $event)

                    <x-event-component>
                        <x-slot:img>{{url('/images/event_thumb/', $event->image)}}</x-slot:img>
                        <x-slot:onclick>showDetails('{{route('event.show', $event)}}')</x-slot:onclick>
                        <x-slot:participants>{{$event->user_a->count()}}</x-slot:participants>
                        <x-slot:name>{{$event->name}}</x-slot:name>
                        <x-slot:date>{{ \Carbon\Carbon::parse($event->date)->format('d.m.Y, h:i') }}</x-slot:date>
                        <x-slot:tags>
                            @foreach($event->tag as $tag)
                                <x-tag-view>
                                    {{$tag->name}}
                                </x-tag-view>
                            @endforeach
                        </x-slot:tags>
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

    <div id='detail-background' class="fixed hidden top-0 left-0 z-10 w-full h-full"></div>
    <div id='detail-frame' class="overflow-hidden hidden fixed top-0 left-0 w-full h-full md:top-3 md:left-3 md:w-[calc(100%-1.5rem)] md:h-[calc(100%-1.5rem)] z-10 bg-white rounded-none md:rounded-lg shadow-2xl">
        <div id="detail-spinner">
            <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
        <iframe id='detail-iframe' class="border-none w-full h-full">

        </iframe>
        <div id='detail-spinner'></div>
        <div id='close-button' class="bg-white absolute rounded-full shadow-lg w-10 h-10 fixed top-4 right-4 md:top-6 md:right-8 cursor-pointer z-10" onclick='hideDetails()'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

    </div>
    <script src="{{asset("/js/detailframe.js")}}"></script>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>

</x-app-layout>

