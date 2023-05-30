<form wire:submit.prevent="wc_StorePermisos()">
    <div class="w-full">
        <div class="flex flew-row">
            <div class="w-3/4">
                <x-forms.input idName="name" label="{{ __('Nombre') }}" />
            </div>
            <div class="flex-1">Check</div>
        </div>
    </div>
</form>
