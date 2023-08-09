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
    <header>
        ENCABEZADO
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
                <!-- Aquí se mostrarán los menús y su contenido -->
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
