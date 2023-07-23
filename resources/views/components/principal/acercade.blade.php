{{-- resources/views/components/principal/acercade.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        {{ __('Acerca de') }}
    </x-slot>
    <div class="mx-auto py-12">
        <h1>Acerca de... probar componentes</h1>
        <hr>
        <form wire:submit.prevent="submitForm">
            <div class="container mx-auto mt-8">
                <livewire:components.input-component idName="nombre" placeholder="Nombre" />
                <div class="container w-60">
                    <livewire:components.input-component idName="apellido" label="Apellido" />
                    <livewire:components.input-component idName="rut" label="rut" placeholder='ingresa tu rut' />
                </div>
                <livewire:components.input-component idName="edad" label="Edad" />
                <button type="submit" class="rounded-lg border-2 m-auto">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>