{{-- resources/views/seller/list.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2>
                {{__('Vendedores')}}
            </h2>
        </div>
    </x-slot>
    <div class="mx-auto py-6 bg-gray-50 text-gray-800 dark:bg-gray-800 dark:text-gray-50">
        <div class="container md:flex">
            <main class="px-4 mb-6" flex-grow>
                Vendedor
            </main>
        </div>

    </div>
</x-app-layout>