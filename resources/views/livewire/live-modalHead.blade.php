<div wire:ignore.self class="fade">
    {{-- $showModal :false= oculta o :true= muestra el modal --}}
    <div class="{{ $muestraModal ? '' : 'hidden' }} relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- formulario -->
                <form wire:submit.prevent="ValideData">
                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-blue-100 px-4 py-3 sm:flex sm:flex-row sm:px-6  justify-between">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">
                                {{ $modalTitle }}
                            </h3>
                            <h6 class="text-center text-warning" wire:loading>
                                Espere un momento
                            </h6>
                            <button type="button" wire:click="fncToggleModal()" class="w-10  justify-center rounded-md bg-white text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0">X</button>
                        </div>
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">