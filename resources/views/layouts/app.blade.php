<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Título del Sistema') }} -
        @yield('titulo_de_la_pagina')
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.tailwindcss.com/tailwind.min.css" rel="stylesheet">

    <!-- <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.6/dist/full.css" rel="stylesheet" type="text/css" /> -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <wireui:scripts />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"
        integrity="sha384-uv6EdH4xg6h1Wk/gv6C0+NSrYgQ/6QpX/FoT/HNRZbjUpRCFXCF7mIPLpdn2P4lz" crossorigin="anonymous">
    </script>

    <!-- Estilos comunes -->
    {{-- @livewireStyles
    @stack('styles') --}}

</head>

<body class="bg-gray-100 text-gray-800 pt-5">

    <div class="container mx-auto">
        <header>
            {{-- sideBar --}}
            <h1 class="text-3xl font-bold leading-tight text-center text-gray-900 dark:text-gray-100">@yield('titulo_de_la_pagina')
            </h1>

            @yield('encabezado')

        </header>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        @yield('contenido')
                    </div>
                </div>
        </main>
        <footer class="text-sm font-italic leading-tight text-center text-blue-700 dark:text-blue-100">
            @yield('pie_de_pagina')
            <p>Este es el pie de página.</p>
        </footer>
    </div>
    <!-- Scripts de la aplicación -->
    {{-- @stack('scripts')
    @livewireScripts --}}

    <!-- Modal stack -->
    {{-- @stack('modals') --}}
</body>

</html>
