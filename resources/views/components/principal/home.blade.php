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
    <div class="bg-white dark:bg-slate-800 rounded-lg px-6 py-8 ring-1 ring-slate-900/5 shadow-xl">
        <div>
            <span class="inline-flex items-center justify-center p-2 bg-indigo-500 rounded-md shadow-lg">
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" aria-hidden="true"><!-- ... --></svg>
            </span>
        </div>
        <h3 class="text-slate-900 dark:text-white mt-5 text-base font-medium tracking-tight">Writes Upside-Down</h3>
        <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm">
            The Zero Gravity Pen can be used to write in any orientation, including upside-down. It even works in outer
            space.
        </p>
    </div>

    <div class="flex flex-wrap">
        @foreach ($svgIcons as $svgIcon)
            <x-button icon="{{ $svgIcon }}" label="{{ $svgIcon }}" class="mr-2 mb-2" />
            {{-- <x-icon name="{{ $svgIcon }}" class="w-10 h-10">{{ $svgIcon }}</x-icon> --}}
            {{-- <x-icon name="chevron-double-left" label="chevron-double-left" class="w-5 h-5" /> --}}
        @endforeach
    </div>


</x-layouts.layout01>
