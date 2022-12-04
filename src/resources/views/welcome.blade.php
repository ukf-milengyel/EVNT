
@push('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
@endpush

<style>
    #canvas {
        position: absolute;

        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
    }
</style>

<x-barebones>

<div class="flex min-h-screen bg-gradient-to-tl from-purple-400 to-blue-200">

    <x-application-logo-transparent class="absolute h-[calc(100%-3rem)] top-6 right-12 fill-[#FFFFFF55]"></x-application-logo-transparent>
    <canvas id="canvas" class="pointer-events-none md:pointer-events-none"></canvas>

    <div class="bg-white/50 p-8 mx-2 rounded-none z-10 lg:rounded-2xl shadow-xl max-w-6xl my-0 md:my-auto mx-0 sm:mx-auto">
        <div class="flex flex-wrap md:flex-nowrap gap-8">
            <x-application-logo class="flex-none h-48 w-48 md:w-72 md:h-72 fill-red-700" />

            <div class="w-full sm:w-auto">
                <h1 class="text-gray-900 text-6xl font-extrabold">
                    Správca podujatí EVNT
                </h1>

                <div class="mt-3">
                    <div class="text-gray-800 text-md">
                        EVNT je aplikácia vytvorená tímom študentov študujúcich na Univerzite Konštantína Filozofa v Nitre za účelom evidencie univerzitných udalostí. Aplikácia zhromážďuje záznamy o udalostiach vrátane názvu, dátumu a mieste konania. Organizátorom umožňuje zaujať používateľov fotografiami alebo prílohami. Prihlásením na podujatie bude používateľ dostávať relevantné oznámenia od autora podujatia. Aplikácia umožňuje filtrovanie záznamov na základe rôznych kritérií pre jednoduchú orientáciu.
                    </div>
                <br>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('event.index') }}" class="text-sm text-blue-900 dark:text-blue-900 ">
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Vstúpiť</button>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-blue-900 dark:text-blue-900 ">
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Prihlásiť sa</button>
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 ">
                                    <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Vytvoriť nový účet</button>
                                </a>
                            @endif
                        @endauth

                    @endif

                </div>
            </div>
        </div>


        <div class="pt-8 text-left md:text-center text-gray-900">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
                <div>
                    <h3 class="text-4xl font-bold">{{$events}}</h3>
                    <p class="font-medium">podujatí</p>
                </div>
                <div>
                    <h3 class="text-4xl font-bold">{{$attendants}}</h3>
                    <p class="font-medium">zúčastnených</p>
                </div>
                <div>
                    <h3 class="text-4xl font-bold">{{$users}}</h3>
                    <p class="font-medium">používateľov</p>
                </div>
                <div>
                    <h3 class="text-4xl font-bold">{{$groups}}</h3>
                    <p class="font-medium">skupín</p>
                </div>
                <div>
                    <h3 class="text-4xl font-bold">{{$photos}}</h3>
                    <p class="font-medium">fotografií</p>
                </div>
                <div>
                    <h3 class="text-4xl font-bold">{{$attachments}}</h3>
                    <p class="font-medium">príloh</p>
                </div>
            </div>
        </div>

    </div>

</div>

    <script src="{{asset("/js/dust.js")}}"></script>
</x-barebones>


