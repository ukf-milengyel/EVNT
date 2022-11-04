<div class="w-auto">
    <div
        {{ $attributes->merge(['class' => 'rounded-full px-2 shadow-md']) }}
        @if(isset($color))
            style="background: linear-gradient(90deg, rgba(0, 0, 0, 0) 50%, rgba(0, 0, 0, 0.5)),{{$color}} "
        @else
            style="background: linear-gradient(90deg, rgba(0, 0, 0, 0) 50%, rgba(0, 0, 0, 0.5)), #333"
        @endif
    >
        <p class="inline-flex font-bold text-white text-shadow">
            {{$name}}
        </p>

        @if(isset($group))
            <p class="inline text-xs text-white text-shadow">
                {{$group}}
            </p>
        @endif
    </div>
</div>
