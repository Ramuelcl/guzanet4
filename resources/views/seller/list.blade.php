{{-- resources/views/seller/list.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Vendedores')}}
        </h2>
    </x-slot>

    @can('seller access')
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 text-gray-800 dark:bg-gray-800 dark:text-gray-50 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex">
                    @can('seller create')
                    <button class="flex-1">Crear</button>
                    @endcan
                    @can('seller update')
                    <button class="flex-1 px-2">Editar</button>
                    @endcan
                    @can('seller delete')
                    <button class="flex-1">Eliminar</button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @endcan
</x-app-layout>