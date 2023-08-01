<div wire:ignore class="bg-white shadow-md rounded-md overflow-hidden">
    {{-- views/livewire/components/tabla-component.blade.php --}}
    <!-- Agregar el componente SearchComponent -->
    <div class="flex justify-between text-center mx-4 align-middle">
        <!-- Escuchar el evento 'searchUpdated' emitido por SearchComponent -->
        @livewire('components.search-component')
        <x-checkbox id="left-label" left-label="Activos?" wire:model.defer="isActiveOnly" class="mt-2" />
    </div>

    <table class="table-auto  w-full shadow-md border-2 rounded-md">
        <thead>
            <tr class="bg-gray-100 rounded-md">
                {{-- @dump(['columnas' => $columnas]) --}}
                @foreach ($columnas as $key => $columna)
                    @if (!isset($columna['hidden']) || !$columna['hidden'])
                        {{-- @dump($columna) --}}
                        @if (isset($columna['sortBy']) && $columna['sortBy'])
                            <th wire:click="sortBy('{{ $key }}')"
                                class="cursor-pointer px-2 {{ $sortBy === $key ? 'bg-gray-300' : 'bg-gray-100' }}">
                                @if (isset($columna['label']))
                                    {{ $columna['label'] }} {{-- Título de la columna --}}
                                @else
                                    {{ $key }}
                                @endif
                                @if ($sortBy === $key)
                                    @if ($sortDirection === 'asc')
                                        <x-icon name="arrow-down" class="inline-flex w-4 h-4 pl-2" />
                                    @else
                                        <x-icon name="arrow-up" class="inline-flex w-4 h-4 pl-2" />
                                    @endif
                                @endif
                            </th>
                        @else
                            <th class="px-2 py-2">
                                {{ $columna['label'] }} {{-- Título de la columna --}}
                            </th>
                        @endif
                    @endif
                @endforeach
                @if ($frmFixeModal == 'Modal')
                    <td class="px-2" colspan="2">
                        <!-- Botón o enlace para nuevo registro -->
                        <x-button rounded wire:click="newEdit(0)" primary class="w-full">
                            <x-icon name="plus" class="w-4 h-4 " />
                        </x-button>
                    </td>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr wire:click="selectItem({{ $item->id }})"
                    class="cursor-pointer {{ $selectedItem === $item->id ? 'bg-gray-200' : '' }}">

                    @foreach ($columnas as $key => $columna)
                        @if (!isset($columna['hidden']) || !$columna['hidden'])
                            <td class="px-4 py-2 {{ $columna['format'] === 'integer' ? 'text-right' : '' }}">
                                @if (isset($columna['format']) && $columna['format'] === 'boolean')
                                    {{ $item->$key ? 'Sí' : 'No' }}
                                @elseif (isset($columna['format']) && $columna['format'] === 'integer')
                                    {{ $item->$key }}
                                @else
                                    {{ $item->$key }}
                                @endif
                            </td>
                        @endif
                    @endforeach
                    <td class="px-2">
                        <!-- Botón o enlace para eliminar con confirmación -->
                        <x-button.circle wire:click="confirmDelete({{ $item->id }})" warning>
                            <x-icon name="trash" class="w-5 h-5 " />
                        </x-button.circle>
                    </td>
                    @if ($frmFixeModal == 'Modal')
                        <td class="px-2">
                            <!-- Botón o enlace para editar -->
                            <x-button.circle wire:click="newEdit({{ $item->id }})" lime>
                                <x-icon name="pencil" class="w-5 h-5 " />
                            </x-button.circle>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Contenedor para alinear la lista desplegable al principio y la paginación al final -->
    <div class="inline-flex justify-between w-full px-2 py-2">
        <!-- Lista desplegable -->
        <div>
            <x-native-select placeholder="Paginación" :options="['5', '10', '30', '50']" wire:model="perPage" />
        </div>

        <!-- Paginación -->
        <div>
            {{ $data->links() }}
        </div>
    </div>
</div>
