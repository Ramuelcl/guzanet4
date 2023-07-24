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
                <div class="container">
                    <livewire:components.input-component idName="apellido" label="Apellido" />
                    <livewire:components.input-component idName="rut" label="R.U.T." placeholder='ingresa tu rut' disabled="1" />
                </div>
                <livewire:components.input-component idName="edad" label="Edad" :icon="['eye', 'eye_slash']" />
                <button type="submit" class="rounded-lg border-2 m-auto">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>