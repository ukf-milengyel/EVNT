<div class="overflow-hidden bg-white w-full border-b border-gray-200 shadow-sm rounded-xl transition-transform items-center px-4 py-4 mt-2">
    <div class="flex border-b-1">
        <div class="flex-auto font-semibold w-24 text-lg items-center">
            @if(isset($onclick))<p onclick="{{$onclick}}" class="text-4xl cursor-pointer">{{$name}}</p>@endif
            {{$date}}
        </div>
        @if($owns ?? false)
            <div class="flex-none">
                <img src="{{asset('/icons/edit.svg/')}}" class="inline cursor-pointer mx-auto h-6">
                <img src="{{asset('/icons/delete.svg/')}}" class="inline cursor-pointer mx-auto h-6">
            </div>
        @endif
    </div>
    <hr>
    <div class="flex pt-2">
        @if( isset($image) )
            <img
                class="flex-none cursor-pointer transition-transform hover:scale-105 mr-4 w-20 h-20 sm:h-32 sm:w-32 md:h-44 md:w-44 xl:h-52 xl:w-52 object-cover rounded-lg overflow-hidden shadow-lg"
                src="{{asset('images/announcement_thumb/'. $image)}}" onclick="window.open('{{asset('images/announcement/'. $image)}}')">
        @endif
        <p class="text-left">
            {{$slot}}
        </p>
    </div>
</div>
