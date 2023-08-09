<x-layouts.layout01 titulo="- welcome">
    <x-slot name="sub-header">
        <h1 class="text-lg h-24">Este es el sub-encabezado del componente welcome</h1>
    </x-slot>

    {{-- este es el slot principal, no necesita definirse --}}
    <div class="container">
        <h2>Este es el contenido del componente welcome</h2>
    </div>

</x-layouts.layout01>
