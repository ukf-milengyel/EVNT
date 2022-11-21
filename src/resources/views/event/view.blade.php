@push('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
@endpush
<x-barebones>
    @if($errors->any())
        <x-std-error>
            <x-slot:title>
                Chyba
            </x-slot:title>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </x-std-error>
    @endif
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
                    {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y, h:i') }}
                </h4>
                <p class="text-gray-800">
                    {{$event->description}}
                </p>

                <h2 class="font-bold mt-4 text-2xl text-gray-800">Oznámenia</h2>
                <!-- todo: nahradiť checkom, či používateľ je autor príspevku -->
                @if(true)
                <form method="POST" action="{{ route('announcement.store') }}" class="py-4 px-6 border-2 border-dashed rounded-xl border-gray-300" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="body" value="Nové oznámenie" />
                        <x-std-textarea name="description">{{ old('description') }}</x-std-textarea>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="image" value="Fotografia" />
                        <input id="picker" name="image" type="file"/>
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button>{{ __('Pridať') }}</x-primary-button>
                    </div>
                </form>
                @endif
                <!-- todo: nahradiť checkom, či existujú oznámenia -->
                @if(true)
                    <x-announcement-component>
                        <x-slot:date>12.5.2023, 20:48</x-slot:date>
                        <x-slot:image>{{asset('images/event/0.jpg')}}</x-slot:image>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </x-announcement-component>
                @endif

            </div>

            <div class="break-words w-full lg:w-56 pt-4 shrink-0">

                @if($event->user()->is(auth()->user()))
                    <div class="flex pb-4 items-end gap-x-4 items-stretch lg:items-baseline lg:justify-end">
                        <a href="{{route('event.edit', $event)}}" class="w-full">
                            <x-primary-button-sm class="p-4 h-16 w-full overflow-hidden rounded-full">
                                <img src="{{asset('/icons/edit_white.svg/')}}" class="mx-auto h-8">
                            </x-primary-button-sm>
                        </a>
                        <form class="inline w-full" method="POST" action="{{ route('event.destroy', $event) }}">
                            @csrf
                            @method('delete')
                            <x-primary-button-sm onclick="event.preventDefault(); if(confirm('Chcete odstrániť toto podujatie?')){this.closest('form').submit();}" class="p-4 h-16 w-full overflow-hidden rounded-full">
                                <img src="{{asset('/icons/delete_white.svg/')}}" class="mx-auto h-8">
                            </x-primary-button-sm>
                        </form>
                    </div>
                @endif

                <div class="flex items-end gap-x-4 items-stretch lg:items-baseline lg:justify-end">
                    <div class="w-full lg:w-auto">
                        <x-primary-button-sm class="p-4 h-16 w-full overflow-hidden rounded-full" onclick="navigator.clipboard.writeText('{{$share_message}}'); alert('Skopírované do schránky.')">
                            <img src="{{asset('/icons/link.png/')}}" class="mx-auto h-8">
                        </x-primary-button-sm>
                    </div>
                    <a class="w-full lg:w-auto" href="https://twitter.com/intent/tweet?text={{ urlencode($share_message) }}" target="_blank">
                        <x-primary-button-sm class="p-4 h-16 w-full overflow-hidden rounded-full">
                            <img src="{{asset('/icons/twitter.png/')}}" class="mx-auto h-8">
                        </x-primary-button-sm>
                    </a>
                    <a class="w-full lg:w-auto" href="https://www.facebook.com/share.php?u=http://{{$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]}}">
                        <x-primary-button-sm class="p-4 h-16 w-full overflow-hidden rounded-full">
                            <img src="{{asset('/icons/facebook.png/')}}" class="mx-auto h-8">
                        </x-primary-button-sm>
                    </a>
                </div>

            <div class="text-center text-gray-800">
                <br>
                <p><span class="font-bold text-7xl">{{$attend_count}}</span><br>prihlásených</p>
                <form method="post" action="{{route('event.attend')}}">
                    @csrf
                    <input type="hidden" name="event_id" value="{{$event->id}}">
                    @if($attends)
                        <p class="pt-2 text-xs text-gray-800">Ste prihlásený na toto podujatie</p>
                        <x-primary-button-sm class="mt-2 bg-red-700 hover:bg-red-600">Odhlásiť sa</x-primary-button-sm>
                    @else
                        <x-primary-button-sm class="mt-2 bg-green-700 hover:bg-green-600">Prihlásiť sa</x-primary-button-sm>
                    @endif
                </form>

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
                @if($event->organizer)
                    <p class="italic text-right text-xs text-gray-800">Používateľ: {{$event->user->name}}</p>
                @endif

                <div class="grid pt-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-1">
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
                        {{$images->count()}}
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
            @can('create', App\Models\Image::class)
                <form method="POST" action="{{ route('event.image.store') }}" class="my-1 py-4 px-6 border-2 border-dashed rounded-xl border-gray-300" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="event_id" value="{{$event->id}}">
                    <div>
                        <x-input-label for="images[]" value="Pridať fotografie" />
                        <input id="picker" name="images[]" type="file" accept="image/png, image/jpeg" multiple/>
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>{{ __('Pridať') }}</x-primary-button>
                    </div>
                </form>
            @endif

            <div class="my-4 grid grid-cols-4 sm:grid-cols-6 lg:grid-cols-8 gap-4">
                @foreach($images as $image)
                    <div class="relative cursor-pointer transition-transform hover:scale-125 w-full h-16 md:h-24 rounded-lg overflow-hidden shadow-lg">
                        <img
                            class="absolute top-0 left-0 object-cover w-full h-full"
                            src="{{url('/images/image_thumb/', $image->filename)}}"
                            onclick="window.open( '{{url('/images/image/', $image->filename)}}' )"
                        >

                        <!-- delete button -->
                        @can('delete', $image)
                        <div class="absolute bottom-2 right-2 h-5 w-5">
                            <img onclick="deleteImage(this.parentNode.parentNode, {{$image->id}})" src="{{asset('/icons/delete.svg/')}}" class="outline-red-700 outline-1 outline hover:bg-red-500 bg-gray-100 p-0.5 shadow-sm rounded-md">
                        </div>
                        @endif

                    </div>
                @endforeach
            </div>

            <h2 class="font-bold text-2xl text-gray-800">Prílohy</h2>
            @can('create', App\Models\Attachment::class)
                <form method="POST" action="{{ route('event.file.store') }}" class="my-1 py-4 px-6 border-2 border-dashed rounded-xl border-gray-300" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="event_id" value="{{$event->id}}">
                    <div>
                        <x-input-label for="files[]" value="Pridať prílohy" />
                        <input id="picker" name="files[]" type="file" multiple/>
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>{{ __('Pridať') }}</x-primary-button>
                    </div>
                </form>
            @endcan
            <div class="my-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($files as $file)
                    <div class="relative border-2 border-gray-300 cursor-pointer w-full rounded-lg overflow-hidden shadow-lg underline">
                        <a href="{{url('files/', $file->filename)}}" target="_blank">
                            <div>
                                <img src="{{asset('/icons/file.svg/')}}" class="inline h-10 p-1">
                                {{substr($file->filename, 14)}}
                            </div>
                        </a>
                        <!-- delete button -->
                        @can('delete', $file)
                            <div class="absolute bottom-2 right-2 h-6 w-6">
                                <img onclick="deleteFile(this.parentNode.parentNode, {{$file->id}})" src="{{asset('/icons/delete.svg/')}}" class="outline-red-700 outline-1 outline hover:bg-red-500 bg-gray-100 p-0.5 shadow-sm rounded-md">
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="{{asset("/js/eventview.js")}}"></script>
</x-barebones>
