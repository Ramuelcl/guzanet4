<div>
    {{-- $showModal :false= oculta o :true= muestra el modal --}}
    <div class="{{ $muestraModal ? '' : 'hidden' }} relative z-10" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <form wire:submit.prevent="ValideData">
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
                            <div>
                                <x-forms.input idName="item.name" label="{{ __('Nombre') }}" />
                            </div>


                        </div>
                        <div class="bg-blue-100 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                                {{ $modalButton }}
                            </button>
                            <button type="button" wire:click="fncToggleModal()"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">{{ __('Cancel') }}</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
