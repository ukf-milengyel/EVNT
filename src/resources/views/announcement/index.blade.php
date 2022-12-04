<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Oznámenia
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($announcements as $announcement)
                        <x-announcement-component>
                            @can('update', $announcement)
                                <x-slot:owns></x-slot:owns>
                            @endcan
                            <x-slot:name>{{ $announcement->event->name }}</x-slot:name>
                            <x-slot:link>{{ route('event.show', $announcement->event->id) }}</x-slot:link>
                            <x-slot:date>{{ $announcement->created_at }}</x-slot:date>
                            {{ $announcement->body }}
                            @if($announcement->image)
                                <x-slot:image>{{$announcement->image}}</x-slot:image>
                            @endif
                        </x-announcement-component>
                    @endforeach
                </div>
            </div>
        </div>
    </div>







</x-app-layout>


