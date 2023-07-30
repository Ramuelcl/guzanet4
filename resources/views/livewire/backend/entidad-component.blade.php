<div>
    <!-- resources/views/livewire/backend/entidad-component.blade.php -->
    <!-- Mostrar el formulario en la misma lista -->
    @if ($frmFixeModal === 'Fixe')
        <!-- ... (código del formulario en la misma lista) -->
        <x-card class="flex flex-wrap justify-between">
            <form wire:submit.prevent="store" class="flex flex-wrap w-full space-x-2 md:space-x-4">
                @csrf
                <x-input wire:model="razonSocial" label="Razón Social" placeholder="nombre de la empresa"
                    class="w-full md:w-min-64" />
                <x-input wire:model="nombres" label="Nombre" placeholder="Nombre(s) de la persona"
                    class="w-full md:w-min-64" />
                <x-input wire:model="apellidos" label="Apellidos" placeholder="Apellido(s)"
                    class="w-full md:w-min-64" />
                <x-input wire:model="eMail" label="eMail" placeholder="nombre@xxx.yyy" />
                <div class="flex flex-col items-center">
                    <label class="text-gray-700 text-sm font-bold mb-2">Activo</label>
                    <x-toggle wire:model.defer="is_active" lg />
                </div>

                <div class="w-full mt-4 md:w-auto">
                    <button type="submit" class="btn btn-primary">
                        @if ($editing)
                            Guardar cambios
                        @else
                            Guardar
                        @endif
                    </button>
                </div>
            </form>
        </x-card>
    @elseif ($frmFixeModal === 'Modal')
        <!-- Mostrar el modal -->
        <x-modal blur wire:model.defer="isModalOpen">
            <x-slot name="title">
                Editar Entidad
            </x-slot>

            <x-slot name="content">
                <!-- Formulario de edición -->
                <x-card class="flex flex-wrap justify-between">
                    <form wire:submit.prevent="store" class="flex flex-wrap w-full space-x-2 md:space-x-4">
                        @csrf
                        <x-input wire:model="razonSocial" label="Razón Social" placeholder="nombre de la empresa"
                            class="w-full md:w-min-64" />
                        <x-input wire:model="nombres" label="Nombre" placeholder="Nombre de la persona"
                            class="w-full md:w-min-64" />
                        <x-input wire:model="apellidos" label="Apellidos" placeholder="Apellido de la persona"
                            class="w-full md:w-min-64" />
                        <x-input wire:model="email" email label="eMail" placeholder="nombre@xxx.yyy" />

                    </form>
                </x-card>
            </x-slot>

            <x-slot name="footer">
                <!-- Botones de acción dentro del modal -->
                <button wire:click="closeModal" class="btn btn-secondary">Cerrar</button>
                <button wire:click="update" class="btn btn-primary">Guardar cambios</button>
            </x-slot>
        </x-modal>
    @endif

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Incluimos el componente TablaComponent --}}
                    <livewire:components.tabla-component modelo="App\Models\Backend\Entidad" :columnas="[
                        'id' => 'id',
                        'razonSocial' => ['Razon Social'],
                        'nombres' => ['Nombres'],
                        'apellidos' => ['Apellidos'],
                        'eMail' => ['Email'],
                        'is_active' => ['Activo', 'boolean'],
                    ]"
                        :frmFixeModal="$frmFixeModal" :perPage="$perPage" />
                </div>
            </div>
        </div>
    </div>
    <!-- Ventana modal de confirmación de eliminación -->
    @if ($confirmingDelete)
        <div class="fixed inset-0 flex justify-center items-center z-50 bg-black bg-opacity-60">
            <div class="bg-white p-4 rounded-md w-64">
                @if (isset($header))
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Título del Modal</h2>
                        <button wire:click="closeModal" class="text-gray-500 focus:outline-none">
                            <x-icon name="x" class="w-4 h-4" />
                        </button>
                        <hr class="w-full border-t-4">
                    </div>
                @endif
                <div class="mb-4">
                    {{ $slot ?? 'quiere eliminar este registro?' }}
                </div>
                @if (isset($footer))
                    <hr class="w-full border-t">
                    <div class="mt-4 flex justify-end">
                        {{ $footer }}
                    </div>
                @else
                    <hr class="w-full border-t">
                    <div class="mt-4 flex justify-end">
                        <button wire:click="closeModal" class="btn btn-secondary mr-2">Cancelar</button>
                        <button class="btn btn-primary">Aceptar</button>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
