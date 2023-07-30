<div>
    <!-- resources/views/livewire/components/modal-component.blade.php -->
    @if ($isOpen)
        <div class="fixed inset-0 flex justify-center items-center z-50 bg-black bg-opacity-60">
            <div class="bg-white p-4 rounded-md w-64">
                @if ($header)
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Título del Modal</h2>
                        <button wire:click="closeModal" class="text-gray-500 focus:outline-none">
                            <x-icon name="x" class="w-4 h-4" />
                        </button>
                        <hr class="w-full border-t-4">
                    </div>
                @endif
                <div class="mb-4">
                    {{ $slot }}
                </div>
                @if ($footer)
                    <hr class="w-full border-t">
                    <div class="mt-4 flex justify-end">
                        {{ $footer }}
                    </div>
                @else
                    <div class="mt-4 flex justify-end border-t-2">
                        <button wire:click="closeModal" class="btn btn-secondary mr-2">Cancelar</button>
                        <button class="btn btn-primary">Aceptar</button>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
