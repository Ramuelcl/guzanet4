<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none;
        }

        :root {
            --exito: #3ab65c;
            --error: #bf333b;
            --info: #1898c0;
            --warning: #bc8c12;
            --exito-hover: #2d8a46;
            --error-hover: #962a31;
            --info-hover: #147fa0;
            --warning-hover: #9b7512;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            overflow-y: hidden;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;

            background-color: greenyellow;
            height: 100px;
            width: 100%;
        }

        main {
            margin-top: 120px;
            /* Altura del encabezado + margen */
            overflow-y: auto;
        }

        footer {
            position: fixed;
            /* Cambio a position: fixed; */
            bottom: 0;
            background-color: greenyellow;
            height: 20px;
            width: 100%;
            margin-top: 120px;
            /* Altura del encabezado + margen */

            /* position: sticky;
            bottom: 0;
            background-color: greenyellow;
            height: 20px;
            width: 100%; */
        }
    </style>
</head>

<body class="antialiased bg-gray-50">
    <header class="fixed-top bg-green-200 h-20 w-full flex justify-between px-2 text-g items-center">
        <!-- Primera columna: Icono para mostrar/ocultar el sidebar -->
        <div class="flex-col p-2">
            <!-- Icono para mostrar/ocultar el sidebar -->
            <x-icon name="home" class="w-5 h-5" />

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>

            <div class="icon p-2">
                <!-- Icono para cambiar entre light y dark mode -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
                    </path>
                </svg>
            </div>
        </div>

        <!-- Segunda columna: Logotipo -->
        <div class="flex-1">LOGO</div>

        <!-- Tercera columna: Espacio en blanco -->
        <div class="flex-1">Titulo</div>

        <!-- Cuarta columna: Otros elementos del encabezado -->
        <div>Elementos aquí</div>
    </header>
    <main>
        <div class="flex mx-4">
            <div class="w-1/5 bg-gray-300 p-4">
                <!-- Barra lateral (Sidebar) -->
                <!-- Contenido de la barra lateral -->
                <a href="#">Opcion 1</a>
                <a href="#">Opcion 2</a>
                <a href="#">Opcion 3</a>
            </div>
            <div class="w-4/5 bg-gray-300 p-4 ml-4">
                <!-- Contenido principal -->
                <!-- Page Heading -->
                <x-slot name="sub-header">
                    <div class="bg-gray-100 dark:bg-gray-900 shadow-lg">
                        <div class="text-gray-800 dark:text-gray-50 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-50 leading-tight">
                                sub titulo por defecto
                            </h2>
                        </div>
                    </div>
                </x-slot>

                <x-slot name="sub-header">
                    <h2 class="w-full">Este es el sub-encabezado del componente layout01</h2>
                </x-slot>
                {{ $slot ?? 'slot por defecto en layout01' }}
            </div>
        </div>
    </main>
    <footer></footer>
</body>

</html>
