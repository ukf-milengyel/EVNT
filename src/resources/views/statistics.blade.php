<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Štatistika') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col space-y-8 ...">

                    <div class="grid grid-cols-2 gap-4">

                        <div class="p-6 w-96 mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4">
                            <div class="shrink-0">
                            </div>
                            <div>
                                <div class="text-6xl font-medium text-black">{{$attendants}}</div>
                                <div class="text-3xl font-medium text-black">zúčastnených</div>
                            </div>
                        </div>

                        <div class="p-6 w-96 mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4">
                            <div class="shrink-0">
                            </div>
                            <div>
                                <div class="text-6xl font-medium text-black">{{$events}}</div>
                                <div class="text-3xl font-medium text-black">podujatí</div>
                            </div>
                        </div>

                    </div>

                    <div class="grid grid-cols-4 gap-4">

                        <div class="p-6 h-24 w-72 mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4">
                            <div class="shrink-0">
                            </div>
                            <div>
                                <div class="text-4xl font-medium text-black">{{$users}}</div>
                                <div class="text-2xl font-medium text-black">používateľov</div>
                            </div>
                        </div>

                        <div class="p-6 h-24 w-72 mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4">
                            <div class="shrink-0">
                            </div>
                            <div>
                                <div class="text-4xl font-medium text-black">{{$groups}}</div>
                                <div class="text-2xl font-medium text-black">skupín</div>
                            </div>
                        </div>

                        <div class="p-6 h-24 w-72 mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4">
                            <div class="shrink-0">
                            </div>
                            <div>
                                <div class="text-4xl font-medium text-black">{{$photos}}</div>
                                <div class="text-2xl font-medium text-black">fotografií</div>
                            </div>
                        </div>

                        <div class="p-6 h-24 w-72 mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4">
                            <div class="shrink-0">
                            </div>
                            <div>
                                <div class="text-4xl font-medium text-black">{{$attachments}}</div>
                                <div class="text-2xl font-medium text-black">príloh</div>
                            </div>
                        </div>

                    </div>

                    </div>

                    <!--Údaje z controllera<br>
                    users {{$users}}<br>
                    groups {{$groups}}<br>
                    events {{$events}}<br>
                    attendants {{$attendants}}<br>
                    photos {{$photos}}<br>
                    attachments {{$attachments}}<br>-->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
