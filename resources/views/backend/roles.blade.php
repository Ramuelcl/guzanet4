{{-- resources/views/backend/roles.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2>
                {{__('Roles')}}
            </h2>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('backend.users.live-roletable')
        </div>
    </div>
    @push('modals')
    @livewire('live-modal',[false])
    @endpush
</x-app-layout>