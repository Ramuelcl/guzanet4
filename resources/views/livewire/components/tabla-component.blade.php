<div class="bg-white shadow-md rounded-md overflow-hidden">
    {{-- views/livewire/components/tabla-component.blade.php --}}
    <table class="table-auto w-full shadow-md">
        <thead>
            <tr>
                @foreach ($columnas as $key => $columna)
                    {{-- @dump($columnas) --}}
                    <th wire:click="sortBy('{{ $key }}')"
                        class="cursor-pointer px-2 py-2 {{ $sortBy === $key ? 'bg-gray-300' : 'bg-gray-100' }}">
                        @if (is_array($columna))
                            {{ $columna[0] }} {{-- Título personalizado --}}
                        @else
                            {{ $columna }} {{-- Título por defecto --}}
                        @endif
                        @if ($sortBy === $key)
                            @if ($sortDirection === 'asc')
                                <x-icon name="arrow-down" class="inline-flex w-4 h-4 pl-2" />
                            @else
                                <x-icon name="arrow-up" class="inline-flex w-4 h-4 pl-2" />
                            @endif
                        @endif

                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr wire:click="selectItem({{ $item->id }})"
                    class="cursor-pointer {{ $selectedItem === $item->id ? 'bg-gray-200' : '' }}">

                    @foreach ($columnas as $key => $columna)
                        <td class="px-4 py-2">
                            @if (is_array($columna) && count($columna) === 2)
                                @if ($columna[1] === 'boolean')
                                    {{ $item->$key ? 'Sí' : 'No' }}
                                @else
                                    {{ $item->$key }}
                                @endif
                            @else
                                {{ $item->$key }}
                            @endif
                        </td>
                    @endforeach
                    <td class="px-4 py-2">
                        <!-- Botón o enlace para eliminar con confirmación -->
                        <button wire:click="confirmDelete({{ $item->id }})" class="btn btn-danger">
                            <x-icon name="trash" class="w-5 h-5 " />
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Contenedor para alinear la lista desplegable al principio y la paginación al final -->
    <div class="inline-flex justify-between w-full px-2">
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
