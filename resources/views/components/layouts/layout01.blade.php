<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} {{ $titulo ?? '' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <wireui:scripts />
    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/custom-styles.css', 'resources/js/app.js'])
    {{-- , 'resources/js/mode-dark.js', 'resources/js/mode-sideBar.js' --}}
    @livewireStyles
    @stack('styles')

</head>

<body class="antialiased w-screen h-screen flex-col bg-slate-100 dark:bg-slate-800">
    <header class="fixed-top bg-green-200 h-20 w-full flex justify-between px-2 text-g items-center">
        <!-- Primera columna: Icono para cambiar entre Dark/Light -->
        <div class="flex-col p-2">
            <div class="cursor-pointer switchDark mb-4">
                <x-icon name="moon" class="w-5 h-5 moon" />
                <x-icon name="sun" class="w-5 h-5 sun hidden" />
            </div>

            <!-- Icono para mostrar/ocultar el sidebar -->
            <div class="cursor-pointer switchSideBar">
                <x-icon name="dots-horizontal" class="w-5 h-5 dots-horizontal" />
                <x-icon name="dots-vertical" class="w-5 h-5 dots-vertical hidden" />
            </div>
        </div>

        <!-- Segunda columna: Logotipo -->
        <div class="flex-1">LOGO</div>

        <!-- Tercera columna: Titulo -->
        <div class="flex-1">Titulo del sistema</div>

        <!-- Cuarta columna: Otros elementos del encabezado -->
        <div> <x-button flat icon="menu" label="Usuario" /></div>
    </header>
    <main>
        <div class="flex mx-4">
            <div class="w-1/5 bg-gray-300 p-4 sidebar">
                <!-- Contenido de la barra lateral -->
                <aside>
                    <ul class="flex-wrap">
                        <x-button flat icon="flag" label="Idioma" />
                        <x-button flat label="opcion 2" />
                        <x-button flat label="opcion 3" />
                    </ul>
                </aside>
            </div>
            <div class="w-full bg-gray-300 p-4 ml-4 main-content">
                <!-- Contenido principal -->
                <!-- Page Heading -->
                <x-slot name="sub-header">
                    <div class="bg-gray-100 dark:bg-gray-900 shadow-lg w-full text-gray-800">
                        <div class="text-gray-800 dark:text-gray-50 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-50 leading-tight">
                                sub titulo por defecto
                            </h2>
                        </div>
                    </div>
                </x-slot>

                {{ $slot ?? 'slot por defecto en layout01' }}
            </div>
        </div>
    </main>
    <footer></footer>
    @livewireScripts
    @stack('scripts')

</body>

</html>
