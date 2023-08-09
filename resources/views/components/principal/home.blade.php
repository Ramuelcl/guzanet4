<x-layouts.layout01 titulo="- welcome">
    {{-- resources/views/components/principal/home.blade.php --}}
    @php
        $directory = resource_path('views\\vendor\\wireui\\components\\icons\\outline'); // Reemplaza esto con la ruta al directorio que contiene los íconos SVG
        // dd($directory);
        
        $icons = scandir($directory);
        $svgIcons = [];
        
        foreach ($icons as $icon) {
            // dump(pathinfo($icon, PATHINFO_EXTENSION));
            if (pathinfo($icon, PATHINFO_EXTENSION) === 'php') {
                $icon = str_replace('.blade.php', '', $icon);
                // dump($icon);
                $svgIcons[] = $icon;
            }
        }
    @endphp

    <x-slot name="sub-header">
        <h1 class="mt-5">Bienvenidos</h1>
    </x-slot>


    <div class="flex flex-wrap">
        @foreach ($svgIcons as $svgIcon)
            <x-button icon="{{ $svgIcon }}" label="{{ $svgIcon }}" class="mr-2 mb-2" />
            {{-- <x-icon name="{{ $svgIcon }}" class="w-10 h-10">{{ $svgIcon }}</x-icon> --}}
            {{-- <x-icon name="chevron-double-left" label="chevron-double-left" class="w-5 h-5" /> --}}
        @endforeach
    </div>


</x-layouts.layout01>
