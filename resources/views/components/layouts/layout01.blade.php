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

    @livewireStyles
    @stack('styles')

</head>

<body class="antialiased w-screen h-screen flex-col bg-white text-black dark:bg-black dark:text-white">
    <header class="fixed-top h-20 w-full flex justify-between px-2 items-center shadow-lg dark:shadow-white">
        <!-- Primera columna: Icono para cambiar entre Dark/Light -->
        @include('components.layouts.parts.Dark_SideBar')

        <!-- Segunda columna: Logotipo -->
        <div class="flex-1">
            <img src="{{ asset(config('app_settings.logo')) }}" alt="Logo" class="h-20 w-auto">
        </div>

        <!-- Tercera columna: Titulo y menu principal -->
        <div class="flex-wrap items-center text-start">
            <!-- Título -->
            <div class="text-2xl font-bold mx-auto">
                {{ config('app_settings.titulo', 'Titulo del sistema') }}
            </div>

            <!-- Menú -->
            <x-navigation-menu class="" />
        </div>

        <!-- Cuarta columna: Otros elementos del encabezado -->
        <div>
            <x-dropdown>
                <x-dropdown.header label="Configuración">
                    <x-dropdown.item icon="cog" label="Preferencias" />
                    <x-dropdown.item icon="user" label="Perfil" />
                </x-dropdown.header>

                <x-dropdown.item separator label="Registrarse" href="{{ route('register') }}" @click="open = false" />
                <x-dropdown.item label="Salir" />
                <x-dropdown.item separator label="Luna/Sol" />
            </x-dropdown>
        </div>
    </header>
    <main>
        <div class="flex mt-4">
            <aside class="w-[200px] sidebar rounded-md">
                <!-- Contenido de la barra lateral -->
                <ul class="flex-wrap">
                    <x-button flat icon="flag" label="Idioma" />
                    <x-button flat label="opcion 2" />
                    <x-button flat label="opcion 3" />
                </ul>
            </aside>
            {{-- espacio de separacion --}}
            <div class="mx-2"></div>
            <div class="w-full main-content rounded-md">
                <!-- Contenido principal -->
                <!-- Page Heading -->
                <x-slot name="sub-header">
                    <div class="shadow-lg w-full">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <h2 class="font-semibold text-xl leading-tight">
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