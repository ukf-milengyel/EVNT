<div class="flex mt-1">
    <div class="flex items-center h-5">
        <input
            type="checkbox"
            @if(isset($id)) id="{{$id}}" @endif
            @if(isset($name)) name="{{$name}}" @endif
            @if(isset($onclick)) onclick="{{$onclick}}" @endif
            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
    </div>
    <div class="ml-2 text-sm">
        <label class="font-medium text-gray-900">{{$slot}}</label>
        @if(isset($subtext))
            <p class="text-xs font-normal text-gray-500">{{$subtext}}</p>
        @endif
    </div>
</div>
