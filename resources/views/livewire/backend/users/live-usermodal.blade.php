{{-- $showModal :false= oculta o :true= muestra el modal --}}
<div>
    {{-- <div class="{{ $muestraModal ? '' : 'hidden' }}"> --}}
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="modal-header">
                    @if ($encabezado)
                        <div class="bg-blue-100 px-4 py-3 sm:flex sm:flex-row sm:px-6  justify-between">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">
                                {{ $encabezado }}
                            </h3>
                            <div
                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                                <button type="button" wire:click="showModal()"
                                    class="w-10  justify-center rounded-md bg-white text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0">X</button>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>

                <div class="bg-blue-100 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    @if ($piepagina)
                        $piepagina
                    @endif
                    <button type="button" wire:click="showModal()"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">{{ __('Cancel') }}</button>
                </div>
                </form>

            </div>
        </div>
    </div>
