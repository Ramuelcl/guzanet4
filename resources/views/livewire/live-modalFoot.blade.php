</div>
<div class="bg-blue-100 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
    <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
        {{ $modalButton }}
    </button>
    <button type="button" wire:click.prevent="fncToggleModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" data-dismiss="modal">{{ __('Cancel') }}</button>
</div>
</form>
</div>
</div>
</div>
</div>