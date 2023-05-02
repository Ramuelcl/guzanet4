{{-- resources/views/welcome.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Laravel 10 Jetstream Livewire CRUD Example - Creación de DataTable lauchoIT ')}}
        </h2>
        <p>Contenido público</p>
        @role('Super-admin')
        <p>solo lo ve el role:Super-admin</p>
        @endrole
        @role('admin')
        <p>solo lo ve el role:admin</p>
        @endrole
        @role('guest')
        <p>solo lo ve el role:guest</p>
        @endrole
        @role('user')
        <p>solo lo ve el role:user</p>
        @endrole
    </x-slot>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 text-gray-800 dark:bg-gray-800 dark:text-gray-50 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex">
                    @livewire('backend.users.live-usertable')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>