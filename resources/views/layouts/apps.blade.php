<!DOCTYPE html>
<!-- resources/views/layouts/apps.blade.php -->
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My App</title>
    <!-- Ruta del archivo CSS compilado por Vite -->
    @php
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $cssFile = $manifest['resources/css/app.css'];
    @endphp
    <link rel="stylesheet" href="{{ mix($cssFile) }}">

    @livewireStyles
</head>

<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-500 py-4 px-6 text-white">
        <div class="container mx-auto">
            <!-- Navbar content goes here -->
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-4">
        @yield('content')
    </div>
    <!-- Ruta del archivo JavaScript compilado por Vite -->
    @php
        $jsFile = $manifest['resources/js/app.js'];
    @endphp
    <script src="{{ mix($jsFile) }}"></script>
    @livewireScripts
</body>

</html>
