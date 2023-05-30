<div>
    <!--
resources/views/livewire/backend/users/live-roletable.blade.php
app/Http/Livewire/backend/users/LiveRoletable.php
-->
    <div class="max-w-max mx-auto">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if ($bSearch)
                <div class="flex justify-between p-4 text-gray-500">


                    @livewire('live-search')
                    <button wire:click="wc_Clear()" class="justify-between text-xs"><svg xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6 text-gray-800 dark:text-gray-50"">
                            <path stroke-linecap=" round" stroke-linejoin="round"
                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        {{ __($display['clear']) }}</button>
                </div>
            @endif
            <div class="flex flex-1 gap-2">
                <x-forms.table caption="Roles">
                    <x-slot name="titles">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider">
                                chk
                            </th>
                            @foreach ($fields as $key => $field)
                                @if (!$field['table']['hidden'])
                                    {{-- @dd($key, $sortField1); --}}
                                    @php
                                        $this->fncOrdenUpp($key, $sortField1);
                                    @endphp

                                    @switch($key)
                                        @case('id')
                                            <th wire:click="wc_Orden('id', 'roles')" scope="col"
                                                class="{{ $cursorPointer }} {{ $uppercase }} text-center text-xs font-medium">
                                                {{ __($field['title']) }}
                                                <x-forms.sort-icon campo="{{ $key }}" :sortDir="$sortDir1"
                                                    :sortField="$sortField1" />
                                            </th>
                                        @break

                                        @case('name')
                                            <th wire:click="wc_Orden('{{ $orden }}', 'roles')" scope="col"
                                                class="{{ $cursorPointer }} {{ $uppercase }} text-center text-xs font-medium">
                                                {{ __($field['title']) }}
                                                <x-forms.sort-icon campo="{{ $key }}" :sortDir="$sortDir1"
                                                    :sortField="$sortField1" />
                                            </th>
                                        @break

                                        @default
                                        @break
                                    @endswitch
                                @endif
                            @endforeach
                            <th>
                                @can('create')
                                    <div class="justify-center">
                                        <button wire:click="wc_ItemAddEdit()" class="text-xs text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-gray-800 dark:text-gray-50">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            {{ __($display['new']) }}
                                        </button>
                                    </div>
                                @endcan
                            </th>
                        </tr>
                    </x-slot>

                    <tbody>
                        @foreach ($roles as $item1)
                            <tr
                                class="border-b bg-gray-50 text-gray-800 dark:bg-gray-800 dark:text-gray-50 hover:bg-gray-500 dark:hover:bg-gray-500">

                                <td scope="row" class="flex px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    <input type="radio" name="radio" id="radio"
                                        wire:click="wc_ShowPermissions({{ $item1 }})">
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $item1->id }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $item1->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $item1->count_user }}
                                </td>

                                <div>
                                    <td class="text-right">
                                        @can('update')
                                            <span wire:click="wc_ItemAddEdit({{ $item1 }})"
                                                class="px-2 cursor-pointer inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100">
                                                {{ __('Edit') }}
                                            </span>
                                        @endcan
                                    </td>
                                    <td class="px-4 text-right">
                                        <span wire:click="wc_Permisos({{ $item1 }})"
                                            class="px-2 cursor-pointer inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100">
                                            {{ __('Permisos') }}
                                        </span>
                                    </td>
                                    <td class="pr-2 text-right">
                                        @can('delete')
                                            @if (!$item1->count_user)
                                                <span onclick="js_borrar({{ $item1 }})"
                                                    class="px-2 cursor-pointer inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100">
                                                    {{ __('Delete') }}
                                                </span>
                                            @endif
                                        @endcan
                                    </td>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>

                </x-forms.table>

                <x-forms.table caption="Permisos">
                    <x-slot name="titles">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider">
                                chk
                            </th>
                            @foreach ($fields as $key => $field)
                                @if (!$field['table']['hidden'])
                                    {{-- @dd($key, $sortField1); --}}
                                    @php
                                        $this->fncOrdenUpp($key, $sortField2);
                                    @endphp

                                    @switch($key)
                                        @case('id')
                                            <th wire:click="wc_Orden('id', 'permisos')" scope="col"
                                                class="{{ $cursorPointer }} {{ $uppercase }} text-center text-xs font-medium">
                                                {{ __($field['title']) }}
                                                <x-forms.sort-icon campo="{{ $key }}" :sortDir="$sortDir2"
                                                    :sortField="$sortField2" />
                                            </th>
                                        @break

                                        @case('name')
                                            <th wire:click="wc_Orden('{{ $orden }}', 'roles')" scope="col"
                                                class="{{ $cursorPointer }} {{ $uppercase }} text-center text-xs font-medium">
                                                {{ __($field['title']) }}
                                                <x-forms.sort-icon campo="{{ $key }}" :sortDir="$sortDir2"
                                                    :sortField="$sortField2" />
                                            </th>
                                        @break

                                        @default
                                        @break
                                    @endswitch
                                @endif
                            @endforeach
                            <th>
                                @can('create___')
                                    <div class="justify-center">
                                        <button wire:click="wc_ItemAddEdit()" class="text-xs text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-gray-800 dark:text-gray-50">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            {{ __($display['new']) }}
                                        </button>
                                    </div>
                                @endcan
                            </th>
                        </tr>
                    </x-slot>

                    <tbody>
                        @foreach ($permisos as $item2)
                            <tr
                                class="border-b bg-gray-50 text-gray-800 dark:bg-gray-800 dark:text-gray-50 hover:bg-gray-500 dark:hover:bg-gray-500">

                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $item2->id }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $item2->name }}
                                </td>

                                <td scope="row" class="flex px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    <input type="checkbox" name="checkit[]" id="checkit">
                                </td>

                                <div>
                                    <td class="text-right">
                                        @can('update')
                                            <span wire:click="wc_ItemAddEdit({{ $item2 }})"
                                                class="px-2 cursor-pointer inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100">
                                                {{ __('Edit') }}
                                            </span>
                                        @endcan
                                    </td>

                                    <td class="pr-2 text-right">
                                        @can('delete')
                                            @if (!$item2->count_user)
                                                <span onclick="js_borrar({{ $item2 }})"
                                                    class="px-2 cursor-pointer inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100">
                                                    {{ __('Delete') }}
                                                </span>
                                            @endif
                                        @endcan
                                    </td>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>

                </x-forms.table>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            // console.log("llegó");

            function js_borrar(item) {
                if (confirm('Realmente quiere borrar el registro ?')) {
                    Livewire.emit('DeleteConfirm', item);
                    // } else {
                    //     alert("se salvo");
                }
            }
            Livewire.on('Destroy', (item) => {
                // agregarToast("info", "Eliminando registro", "Se elimino registro: ".item.
                //     " satisfactoriamente", true);
                alert('Se borró al usuario correctamente');
            });
        </script>
    @endpush
</div>
