<div class="flex my-1">
    <!-- resources/views/livewire/components/search-component.blade.php -->
    <x-input type="search" wire:model="search" wire:keydown.enter="applySearch" placeholder="Buscar..." class="w-full" />
    <x-button.circle wire:click="applySearch" icon="check" class="ml-2" />
</div>