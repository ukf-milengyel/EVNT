<div onclick="{{$onclick}}" class="overflow-hidden bg-white w-full sm:rounded-xl shadow-sm border-b border-gray-200 transition-transform sm:hover:scale-105 items-center cursor-pointer">
    <div class="relative">
        <img class="object-cover h-44 md:h-48 xl:h-52 w-full" src="{{($img)}}">
        <div class="flex absolute w-full bottom-2 px-2">
            <div class="truncate w-full flex">
                {{$organizer}}
            </div>
            <div class="flex-1 pl-2 w-auto text-2xl md:text-xl font-bold text-white text-shadow">
                {{$participants}}
            </div>

        </div>
        @if($tags)
            <div class="absolute w-full top-2 px-2">
                <div class="flex flex-wrap justify-end w-full gap-1">
                    {{$tags}}
                </div>
            </div>
        @endif
    </div>
    <div class="px-4 py-2">
        <div class="text-2xl md:text-xl font-bold text-black">
            {{$name}}
        </div>
        <div class="text-md md:text-sm font-medium text-black">
            {{$date}}
        </div>

    </div>
</div>
