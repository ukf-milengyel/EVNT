<div class="overflow-hidden bg-white w-full border-2 sm:rounded-xl shadow-lg transition-transform items-center px-4 py-4 mt-2">
    <div class="flex border-b-1">
        <div class="flex-auto font-semibold w-24 text-lg items-center">
            {{$date}}
        </div>
        <div class="flex-none">
            <img src="{{asset('/icons/edit.svg/')}}" class="inline cursor-pointer mx-auto h-6">
            <img src="{{asset('/icons/delete.svg/')}}" class="inline cursor-pointer mx-auto h-6">
        </div>
    </div>
    <hr>
    <div class="flex pt-2">
        @if( isset($image) )
            <img
                class="cursor-pointer transition-transform hover:scale-105 w-full h-20 pr-4 sm:h-32 md:h-44 xl:h-52 object-cover rounded-lg overflow-hidden shadow-lg"
                src="{{asset('images/announcement_thumb/'. $image)}}" onclick="window.open({{asset('images/announcement/'. $image)}})">
        @endif
        <p class="text-left">
            {{$slot}}
        </p>
    </div>
</div>
