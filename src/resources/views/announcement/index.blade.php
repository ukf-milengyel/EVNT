@push('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/spinner.css') }}" rel="stylesheet" type="text/css">
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Oznámenia
        </h2>
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
            @foreach($announcements as $announcement)
                <x-announcement-component>
                    @can('update', $announcement)
                        <x-slot:owns></x-slot:owns>
                    @endcan
                    <x-slot:id>{{$announcement->id}}</x-slot:id>
                    <x-slot:onclick>showDetails('{{route('event.show', $announcement->event->id)}}')</x-slot:onclick>
                    <x-slot:name>{{ $announcement->event->name }}</x-slot:name>
                    <x-slot:date>{{ $announcement->created_at }}</x-slot:date>
                    {{ $announcement->body }}
                    @if($announcement->image)
                        <x-slot:image>{{$announcement->image}}</x-slot:image>
                    @endif
                </x-announcement-component>
            @endforeach
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
</x-app-layout>


