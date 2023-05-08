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
            <x-forms.table caption="Roles">
                <x-slot name="titles">
                    <tr>
                        {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider">
                            chk
                        </th> --}}
                        @foreach ($fields as $key => $field)
                            @if (!$field['table']['hidden'])
                                @switch($key)
                                    @case(0)
                                    @break

                                    @default
                                        <th class="text-center">
                                            <div>
                                                {{ __($field['title']) }}
                                            </div>

                                        </th>
                                    @break
                                @endswitch
                            @endif
                        @endforeach
                        <th>
                            @can('create')
                                <div class="justify-center">
                                    <button wire:click="wc_ItemAddEdit(0)" class="text-xs text-blue-600">
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

                            <th scope="row"
                                class="flex px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <div>{{ $item1->id }}</div>
                            </th>

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
                                    <span wire:click="wc_fncPermisos({{ $item1 }}))"
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
        </div>
    </div>
    {{-- $showModal oculta o muestra el modal ingreso/edicion de datos --}}
    <div class="{{ $showModal ? '' : 'hidden' }} relative z-10" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-blue-100 px-4 py-3 sm:flex sm:flex-row sm:px-6  justify-between">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">
                            {{ $modalTitle }}
                        </h3>
                        <button type="button" wire:click="fncToggleModal()"
                            class="w-10  justify-center rounded-md bg-white text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0">X</button>
                    </div>
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <form wire:submit.prevent="wc_Store()">
                            <div>
                                <x-forms.input idName="name" label="{{ __('Nombre') }}" />
                            </div>
                        </form>
                    </div>
                    <div class="bg-blue-100 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="submit" wire:click="wc_Store()"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">{{ $modalButton }}</button>
                        <button type="button" wire:click="fncToggleModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            // console.log("llegó");

            function js_borrar(item) {
                if (confirm('Realmente quiere borrar al usuario ?')) {
                    Livewire.emit('DeleteConfirm', item);
                    // } else {
                    //     alert("se salvo");
                }
            }
            Livewire.on('Destroy', (item) => {
                alert('Se borró al usuario correctamente');
            });
        </script>
    @endpush
</div>
