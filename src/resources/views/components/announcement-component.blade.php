<div class="overflow-hidden bg-white w-full border-2 sm:rounded-xl shadow-lg transition-transform items-center px-4 py-4">
    <div class="flex">
        <div class="flex-auto font-semibold w-24 text-lg items-center">
            {{$date}}
        </div>
        <div class="flex-none w-20">
            <x-primary-button-sm class="p-4 h-8 w-16 overflow-hidden rounded-full">
                <img src="{{asset('/icons/edit_white.svg/')}}" class="mx-auto h-8">
            </x-primary-button-sm>
        </div>
            <x-primary-button-sm class="p-4 h-8 w-16 overflow-hidden rounded-full">
                <img src="{{asset('/icons/delete_white.svg/')}}" class="mx-auto h-8">
            </x-primary-button-sm>
    </div>
    <div class="flex">
        <img class="object-cover cursor-pointer h-44 md:h-48 xl:h-52 w-full" src="{{$image}}" onclick="window.open(this.src)">
        <p class="text-left">
            {{$slot}}
        </p>
    </div>
</div>
