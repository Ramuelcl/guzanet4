<div>
    <!-- resources/views/livewire/backend/cliente-component.blade.php -->
    <div class="bg-white shadow-md rounded-md overflow-hidden">
        <!-- ... (código del formulario en la misma lista) -->
        @if ($frmFixeModal === 'Fixe')
            <x-card class="flex flex-wrap justify-between">
                <form wire:submit.prevent="store" class="flex flex-wrap w-full space-x-2 md:space-x-4">
                    @csrf
                    <x-input wire:model="razonSocial" label="Razón Social" placeholder="nombre de la empresa"
                        class="w-full md:w-min-64" />
                    <x-input wire:model="nombres" label="Nombre" placeholder="Nombre(s) de la persona"
                        class="w-full md:w-min-64" />
                    <x-input wire:model="apellidos" label="Apellidos" placeholder="Apellido(s)"
                        class="w-full md:w-min-64" />
                    <x-input wire:model="email" label="eMail" placeholder="nombre@xxx.yyy" />

                    <div class="flex flex-col items-center">
                        <label class="text-gray-700 text-sm font-bold mb-2">Activo</label>
                        <x-toggle wire:model.defer="is_active" lg />
                    </div>

                    <div class="w-full mt-4 md:w-auto">
                        <button type="submit" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
                </form>
            </x-card>
        @else
            {{-- --}}
        @endif
        <table class="w-full table-fixed divide-y divide-gray-200">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Razon Social</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Apellidos</th>
                    <th class="px-4 py-2">eMail</th>
                    <th class="px-4 py-2">Activo</th>
                    <th class="px-4 py-2">Tipo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $key => $cliente)
                    <tr wire:click="selectItem({{ $cliente->id }})"
                        class="{{ $selectedItem === $cliente->id ? 'bg-blue-200' : ($loop->index % 2 === 0 ? 'bg-gray-100' : 'bg-gray-200') }}">
                        <td class="px-4 py-2">{{ $cliente->id }}</td>
                        <td class="px-4 py-2">{{ $cliente->razonSocial }}</td>
                        <td class="px-4 py-2">{{ $cliente->nombres }}</td>
                        <td class="px-4 py-2">{{ $cliente->apellidos }}</td>
                        <td class="px-4 py-2">{{ $cliente->eMail }}</td>
                        <td class="px-4 py-2">{{ $cliente->is_active === 1 ? 'Si' : 'No' }}</td>
                        <td class="px-4 py-2">{{ $cliente->tipo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- <div class="mt-4">
        {{ $clientes->links() }}
    </div> --}}
</div>
