<div class="w-auto">
    <div
        {{ $attributes->merge(['class' => 'rounded-full px-2 shadow-md']) }}
        @if(isset($color))
            style="background: linear-gradient(90deg, rgba(0, 0, 0, 0) 50%, rgba(0, 0, 0, 0.5)),{{$color}} "
        @else
            style="background: linear-gradient(90deg, rgba(0, 0, 0, 0) 50%, rgba(0, 0, 0, 0.5)), #333"
        @endif
    >
        <p class="inline-flex text-lg md:text-sm font-bold text-white text-shadow">
            @if(isset($name))
                {{$name}}
            @else
                -
            @endif
        </p>

        @if(isset($group))
            <p class="inline text-md md:text-xs text-white text-shadow">
                {{$group}}
            </p>
        @endif
    </div>
</div>
