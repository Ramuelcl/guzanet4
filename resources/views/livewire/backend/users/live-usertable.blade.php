<div>
    <!--
resources/views/livewire/backend/users/live-usertable.blade.php
app/Http/Livewire/backend/users/LiveUsertable.php
-->
    <div class="max-w-max mx-auto">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex justify-between p-4 text-gray-500">
                <select wire:model.lazy="wmViews"
                    class="h-9 bg-gray-50 border text-gray-800 dark:bg-gray-800 dark:text-gray-50 text-sm rounded-lg focus:ring-blue-500 dark:focus:ring-blue-500">
                    @foreach ($collectionViews as $wmViews)
                        <option value="{{ $wmViews }}">{{ $wmViews }}</option>
                    @endforeach
                </select>

                @livewire('live-search')

                {{-- {{ $activo }} --}}
                @if ($bActive)
                    <x-forms.input-checkbox idName="activeAll" label="Actives" class="mr-2" />
                @endif {{-- {{ $activo }} --}}

                @if ($bRole)
                    <select wire:model.lazy="wmUserRoles"
                        class="h-9 bg-gray-50 border text-gray-800 dark:bg-gray-800 dark:text-gray-50 text-sm rounded-lg focus:ring-blue-500 dark:focus:ring-blue-500">
                        <option value="">Roles</option>
                        @foreach ($userRoles as $wmUserRoles)
                            <option value="{{ $wmUserRoles }}">{{ $wmUserRoles }}</option>
                        @endforeach
                    </select>
                @endif
                @if ($bSearch || $bActive)
                    <button wire:click="wc_Clear()" class="justify-between text-xs"><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-gray-800 dark:text-gray-50"">
                            <path stroke-linecap=" round" stroke-linejoin="round"
                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        {{ __($display['clear']) }}</button>
                @endif
            </div>
            <x-forms.table caption="Usuarios">
                <x-slot name="titles">
                    <tr>
                        {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider">
                            chk
                        </th> --}}
                        @foreach ($fields as $key => $field)
                            @if (!$field['table']['hidden'])
                                @php
                                    // dd($key, $field);
                                    // valida el campo a ordenar; si existe le pone cursor-pointer
                                    $orden = in_array($key, $fieldsOrden) ? $key : null;
                                    $uppercase = $key == $sortField ? 'uppercase font-bold' : 'capitalize';
                                @endphp

                                @switch($key)
                                    @case('is_active')
                                        @if (!$activeAll)
                                            <th scope="col" class="text-center text-xs font-medium">
                                                {{ __($field['title']) }}
                                            @else
                                            <th scope="col">{{ __('Actives') }}</th>
                                            </th>
                                        @endif
                                    @break

                                    @default
                                        <div class="grid-flow-row">
                                            <th wire:click="wc_Orden('{{ $orden }}')" scope="col"
                                                class="{{ $orden ? 'cursor-pointer' : '' }} {{ $uppercase }} text-center text-xs font-medium">
                                                {{ __($field['title']) }}
                                                <x-forms.sort-icon campo="{{ $key }}" :sortDir="$sortDir"
                                                    :sortField="$sortField" />
                                            </th>
                                        </div>
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
                    @foreach ($items as $item)
                        <tr
                            class="border-b bg-gray-50 text-gray-800 dark:bg-gray-800 dark:text-gray-50 hover:bg-gray-500 dark:hover:bg-gray-500">

                            <th scope="row"
                                class="flex px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <div>{{ $item->id }}</div>
                            </th>

                            <td class="px-6 py-4">
                                {{-- {{ asset('storage/' . $item->profile_photo_path) }} --}}
                                @if (substr($item->profile_photo_path, 0, 8) == 'https://')
                                    <img class="h-10 w-10 text-gray-800 dark:text-gray-50 rounded-full"
                                        src="{{ $item->profile_photo_path }}" alt="img">
                                @else
                                    <img class="h-10 w-10 text-gray-800 dark:text-gray-50 rounded-full"
                                        src="{{ asset('storage/' . $item->profile_photo_path) }}"
                                        alt="{{ $item->name }}">
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->email }}
                            </td>

                            <td class="px-6 py-4">
                                @if (!$activeAll)
                                    <x-forms.comp-estado valor="{{ $item->is_active }}" tipo="si-no" />
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->roles()->first()->name ?? 'sin Rol' }}
                            </td>

                            <div>
                                <td class="text-right">
                                    @can('update')
                                        <button wire:click="wc_ItemAddEdit({{ $item->id }})"
                                            class="text-xs text-green-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-gray-800 dark:text-gray-50">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            {{ __($display['edit']) }}
                                        </button>
                                    @endcan
                                </td>
                                <td class="hidden px-4 text-right">
                                    @can('update')
                                        <button wire:click="wc_Show()" class="text-xs text-fuchsia-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-gray-800 dark:text-gray-50">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6" />
                                            </svg>
                                            {{ __($display['show']) }}
                                        </button>
                                    @endcan
                                </td>
                                <td class="pr-2 text-right">
                                    @can('delete')
                                        <button onclick="js_borrarUsuario({{ $item->id }})"
                                            class="text-xs text-green-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-gray-800 dark:text-gray-50">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            {{ __($display['delete']) }}
                                        </button>
                                    @endcan
                                </td>
                            </div>
                        </tr>
                    @endforeach
                </tbody>

            </x-forms.table>
            <div
                class="bg-gray-50 text-gray-800 dark:bg-gray-800 dark:text-gray-50 px-4 py-3 items-center justify-between border-gray-200 sm:px-6">
                {{ $items->links() }}
            </div>
        </div>
    </div>
    {{-- $hidden1 oculta o muestra el modal --}}
    <div class="{{ $hidden1 }} relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-blue-100 px-4 py-3 sm:flex sm:flex-row sm:px-6  justify-between">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">
                            {{ $modalTitle }}
                        </h3>
                        <button type="button" wire:click="fncModal(1)"
                            class="w-10  justify-center rounded-md bg-white text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0">X</button>
                    </div>
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <form wire:submit.prevent="wc_Store()">
                            <div>
                                <x-forms.input idName="name" label="{{ __('Nombre') }}" />
                            </div>
                            <div>
                                <x-forms.input idName="email" label="{{ __('e-mail') }}" />
                            </div>
                            @if ($modo == 0)
                                <div>
                                    <x-forms.input idName="password" type='password' label="{{ __('Password') }}" />
                                </div>
                                <div>
                                    <x-forms.input idName="password_confirmation" type='password'
                                        label="{{ __('Password Confirmation') }}" />
                                </div>
                            @endif
                            <div>

                                @if (substr($profile_photo_path, 0, 8) == 'https://')
                                    <img class="h-10 w-10 text-gray-800 dark:text-gray-50 rounded-full"
                                        src="{{ $profile_photo_path }}" alt="img">
                                    <x-forms.input-photo idName="profile_photo_path" label="{{ __('Foto') }}"
                                        value="{{ $profile_photo_path }}" />
                                @else
                                    <img class="h-10 w-10 text-gray-800 dark:text-gray-50 rounded-full"
                                        src="{{ asset('storage/' . $profile_photo_path) }}" alt="img">
                                    <x-forms.input-photo idName="profile_photo_path" label="{{ __('Foto') }}"
                                        value="{{ asset('storage/' . $profile_photo_path) }}" />
                                @endif

                            </div>
                            <div>
                                <x-forms.input-checkbox idName="is_active" label="{{ __('Active ?') }}" />
                            </div>
                            <div>
                                <x-forms.input-select idName="role" :options=$userRoles label="Rol"
                                    :selected=$role />
                            </div>
                        </form>
                    </div>
                    <div class="bg-blue-100 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" wire:click="wc_Store()"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">{{ $modalButton }}</button>
                        <button type="button" wire:click="fncModal(1)"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            // console.log("llegó");

            function js_borrarUsuario(user) {
                if (confirm('Realmente quiere borrar al usuario ?')) {
                    Livewire.emit('DeleteUserConfirm', user);
                    // } else {
                    //     alert("se salvo");
                }
            }
            Livewire.on('deleteUser', (user) => {
                alert('Se borró al usuario correctamente');
            });
        </script>
    @endpush
</div>
