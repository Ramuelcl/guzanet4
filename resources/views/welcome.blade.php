{{-- resources/views/welcome.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2>
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
        </div>
    </x-slot>
    <div class="mx-auto py-6 bg-gray-50 text-gray-800 dark:bg-gray-800 dark:text-gray-50">
        <div class="container md:flex">
            <main class="px-4 mb-6" flex-grow>
                @livewire('backend.users.live-usertable')
            </main>
        </div>

    </div>
</x-app-layout>