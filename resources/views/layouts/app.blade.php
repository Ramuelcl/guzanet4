<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.6/dist/full.css" rel="stylesheet" type="text/css" /> -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <wireui:scripts />
    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- Estilos comunes -->
    @livewireStyles
    @stack('styles')

</head>

<body class="font-sans antialiased text-gray-900 bg-gray-50 dark:text-gray-50 dark:bg-gray-800">
    <!-- <x-banner /> -->
    <!-- Loading screen -->
    <!-- <div x-ref="loading" class="fixed inset-0 z-[200] flex items-center justify-center text-white bg-black bg-opacity-50" style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)">
        Loading.....
    </div> -->

    <div class="min-h-screen">
        <x-navigation-menu />

        <div class="flex">

            <!-- aside -->
            <div class="hidden flex-1">
                <div @click.away="open = false"
                    class="flex flex-col flex-shrink-0 w-full text-gray-700 bg-white md:w-64 dark:text-gray-200 dark:bg-gray-800"
                    x-data="{ open: false }">
                    <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
                        <a href="#"
                            class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">
                            Título
                        </a>
                        <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline"
                            @click="open = !open">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                                <path x-show="!open" fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                                <path x-show="open" fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <nav :class="{ 'block': open, 'hidden': !open }"
                        class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
                        <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-gray-200 rounded-lg dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                            href="#">Blog</a>
                        <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                            href="#">Portfolio</a>
                        <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                            href="#">About</a>
                        <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                            href="#">Contact</a>
                        <div @click.away="open = false" class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark:bg-transparent dark:focus:text-white dark:hover:text-white dark:focus:bg-gray-600 dark:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                <span>Dropdown</span>
                                <svg fill="currentColor" viewBox="0 0 20 20"
                                    :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                    class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                                <div class="px-2 py-2 bg-white rounded-md shadow dark:bg-gray-700">
                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="#">Link #1</a>
                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="#">Link #2</a>
                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="#">Link #3</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="flex-1 w-full bg-slate-50 text-left">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-gray-100 dark:bg-gray-900 shadow-lg">
                        <div class="text-gray-800 dark:text-gray-50 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-50 leading-tight">
                                {{ $header }}
                            </h2>
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="text-gray-800 dark:text-gray-50">
                    {{ $slot }}
                    <!-- <div class="contenedor">
                        <div class="hero">
                            <h1 class="titulo">Notificaciones Toast</h1>
                            <div class="contenedor-botones" id="contenedor-botones">
                                <button class="btn exito" data-tipo="exito">Exito</button>
                                <button class="btn error" data-tipo="error">Error</button>
                                <button class="btn info" data-tipo="info">Info</button>
                                <button class="btn warning" data-tipo="warning">Warning</button>
                            </div>
                        </div>
-->
                    <div class="contenedor-toast" id="contenedor-toast">
                        <!-- Plantilla de toast
                            <div class="toast exito" id="1">
                                <div class="contenido">
                                    <div class="icono">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                        </svg>
                                    </div>
                                    <div class="texto">
                                        <p class="titulo">Exito!</p>
                                        <p class="descripcion">La operación fue exitosa.</p>
                                    </div>
                                </div>
                                <button class="btn-cerrar">
                                    <div class="icono">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <div class="toast error" id="2">
                                <div class="contenido">
                                    <div class="icono">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                    </div>
                                    <div class="texto">
                                        <p class="titulo">Error!</p>
                                        <p class="descripcion">Hubo un error al intentar procesar la operación.</p>
                                    </div>
                                </div>
                                <button class="btn-cerrar">
                                    <div class="icono">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <div class="toast info" id="3">
                                <div class="contenido">
                                    <div class="icono">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                        </svg>
                                    </div>
                                    <div class="texto">
                                        <p class="titulo">Info</p>
                                        <p class="descripcion">Esta es una notificacion informativa.</p>
                                    </div>
                                </div>
                                <button class="btn-cerrar">
                                    <div class="icono">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <div class="toast warning" id="4">
                                <div class="contenido">
                                    <div class="icono">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                    </div>
                                    <div class="texto">
                                        <p class="titulo">Advertencia</p>
                                        <p class="descripcion">Esta notificación es para advertirte sobre algo.</p>
                                    </div>
                                </div>
                                <button class="btn-cerrar">
                                    <div class="icono">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            </div> -->
                    </div>
                </main>

            </div>
        </div>
    </div>
    <!-- Scripts de la aplicación -->
    @stack('scripts')
    @livewireScripts

    <!-- Modal stack -->
    @stack('modals')

    <!-- <script src="./TW-ELEMENTS-PATH/dist/js/index.min.js"></script>
    <script src="js/main.js"></script> -->
    <script>
        // const btnSwitch = document.querySelector('#switch');

        // btnSwitch.addEventListener('click', () => {
        //     document.body.classList.toggle('dark');
        //     btnSwitch.classList.toggle('active');

        //     // guardamos el modo en localStorage
        //     if (document.body.classList.contains('dark')) {
        //         localStorage.setItem('dark-Mode', 'true');
        //     } else {
        //         localStorage.setItem('dark-Mode', 'false');
        //     }
        // });

        // // obtenemos el modo actual
        // if (localStorage.getItem('dark-Mode') === 'true') {
        //     document.body.classList.add('dark');
        //     btnSwitch.classList.add('active');
        // } else {
        //     document.body.classList.remove('dark');
        //     btnSwitch.classList.remove('active');

        // }
    </script>

</body>

</html>
