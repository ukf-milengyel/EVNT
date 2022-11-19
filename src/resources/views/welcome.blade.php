
@push('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/spinner.css') }}" rel="stylesheet" type="text/css">
@endpush

<style>
    html, body {
        background: linear-gradient(#2e323a, rgba(0, 0, 0, 0.5));
        height: 100vh;
        padding: 0;
        margin: 0;
    }
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

    <canvas id="canvas" class="pointer-events-none md:pointer-events-none"></canvas>

<div class="bg-gradient-to-r from-blue-400 to-blue-200 min-h-screen">


    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-6 md:grid-cols-2">
                <div class="p-6">

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            <img src="{{asset('https://images7.alphacoders.com/128/1286538.jpg')}}" class="mx-auto">
                        </div>
                    </div>
                </div>

                <div class="p-6 ">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg  font-semibold">
                            <a class="font-mono text-black dark:text-black">
                                Nazov Aplikacie
                            </a>
                        </div>

                    </div>

                    <div class="p-6 ">
                        <div class="mt-1 text-black dark:text-black text-sm">
                            Popis aplikacie -  Popis aplikacie -  Popis aplikacie -  Popis aplikacie -  Popis aplikacie -  Popis aplikacie -  Popis aplikacie -  Popis aplikacie
                            Popis aplikacie -  Popis aplikacie -  Popis aplikacie -  Popis aplikacie -  Popis aplikacie -  Popis aplikacie -  Popis aplikacie -  Popis aplikacie
                        </div>
                    <br>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('event.index') }}" class="text-sm text-gray-700 dark:text-gray-500 ">
                                    <x-primary-button-sm>Podujatia</x-primary-button-sm>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-blue-900 dark:text-blue-900 ">
                                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Prihlasit sa</button>
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 ">
                                        <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Registrovať</button>
                                    </a>
                                @endif
                            @endauth

                        @endif

                    </div>
                </div>





            </div>


        <div class="text-center">
            <div class="ml-4 text-center text-sm text-black sm:text-right sm:ml-0">
                <div class="grid grid-cols-2 xl:grid-cols-6 md:gap-x-45">


                    <div class="p-4 h-16 w-auto md:w-32 md:mx-auto bg-white md:rounded-xl md:shadow-lg flex items-center space-x-4">
                        <div>
                            <div class="text-2xl font-medium text-black">Pocet </div>
                            <div class="text-1xl font-medium text-black">zúčastnených</div>
                        </div>
                    </div>

                    <div class="p-4 h-16 w-auto md:w-32 md:mx-auto bg-white md:rounded-xl md:shadow-lg flex items-center space-x-4">
                        <div>
                            <div class="text-2xl font-medium text-black">Pocet </div>
                            <div class="text-1xl font-medium text-black">podujatí</div>
                        </div>
                    </div>

                    <div class="p-4 h-16 w-auto md:w-32 md:mx-auto bg-white md:rounded-xl md:shadow-lg flex items-center space-x-4">
                        <div>
                            <div class="text-2xl font-medium text-black">Pocet </div>
                            <div class="text-1xl font-medium text-black">používateľov</div>
                        </div>
                    </div>

                    <div class="p-4 h-16 w-auto md:w-32 md:mx-auto bg-white md:rounded-xl md:shadow-lg flex items-center space-x-4">
                        <div>
                            <div class="text-2xl font-medium text-black">Pocet </div>
                            <div class="text-1xl font-medium text-black">skupín</div>
                        </div>
                    </div>

                    <div class="p-4 h-16 w-auto md:w-32 md:mx-auto bg-white md:rounded-xl md:shadow-lg flex items-center space-x-4">
                        <div>
                            <div class="text-2xl font-medium text-black">Pocet </div>
                            <div class="text-1xl font-medium text-black">fotografií</div>
                        </div>
                    </div>

                    <div class="p-4 h-16 w-auto md:w-32 md:mx-auto bg-white md:rounded-xl md:shadow-lg flex items-center space-x-4">
                        <div>
                            <div class="text-2xl font-medium text-black">Pocet </div>
                            <div class="text-1xl font-medium text-black">príloh</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        </div>


</div>

    <script src="{{asset("/js/dust.js")}}"></script>
</x-barebones>


