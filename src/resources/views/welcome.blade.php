
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

<div class="flex min-h-screen bg-gradient-to-tl from-blue-400 to-blue-200">

    <canvas id="canvas" class="pointer-events-none md:pointer-events-none"></canvas>

    <div class="bg-white/50 p-8 mx-2 rounded-none lg:rounded-2xl shadow-xl max-w-6xl my-0 md:my-auto mx-0 sm:mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap gap-8">
            <x-application-logo class="flex-none h-48 w-48 md:w-72 md:h-72 fill-red-700" />

            <div class="w-full sm:w-auto">
                <h1 class="text-gray-900 text-6xl font-extrabold">
                    {{ config('app.name', 'UKF Events') }}
                </h1>

                <div class="mt-3">
                    <div class="text-gray-800 text-md">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                <br>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('event.index') }}" class="text-sm text-blue-900 dark:text-blue-900 ">
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Podujatia</button>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-blue-900 dark:text-blue-900 ">
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Prihlásiť sa</button>
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 ">
                                    <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Registrovať sa</button>
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
                    <h3 class="text-4xl font-bold">0</h3>
                    <p class="font-medium">podujatí</p>
                </div>

                <div>
                    <h3 class="text-4xl font-bold">0</h3>
                    <p class="font-medium">podujatí</p>
                </div>
                <div>
                    <h3 class="text-4xl font-bold">0</h3>
                    <p class="font-medium">podujatí</p>
                </div>
                <div>
                    <h3 class="text-4xl font-bold">0</h3>
                    <p class="font-medium">podujatí</p>
                </div>
                <div>
                    <h3 class="text-4xl font-bold">0</h3>
                    <p class="font-medium">podujatí</p>
                </div>
                <div>
                    <h3 class="text-4xl font-bold">0</h3>
                    <p class="font-medium">podujatí</p>
                </div>

            </div>
        </div>

    </div>

</div>

    <script src="{{asset("/js/dust.js")}}"></script>
</x-barebones>


