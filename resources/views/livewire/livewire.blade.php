<x-layouts.app>

    <x-slot name="content">
        <div class="container mx-auto mt-8">
            @if ($title)
            <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>
            @else
            <h1 class="text-2xl font-bold mb-4">sin título</h1>
            @endif
            <!-- Incluye el componente Livewire -->
            @livewire($componentClass)
            {{-- {{ $slot }} --}}
        </div>
    </x-slot>

</x-layouts.app>