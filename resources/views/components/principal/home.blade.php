{{-- resources/views/components/principal/home.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        {{ __('resources/views/components/principal/home.blade.php') }}
    </x-slot>
    <h1 class="mt-5">Bienvenidos</h1>
    @livewire('forms.menu-component', ['orientation' => false])
    </div>
</x-app-layout>