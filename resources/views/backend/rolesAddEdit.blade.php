<form wire:submit.prevent="wc_Store()">
    <div>
        <x-forms.input idName="name" label="{{ __('Nombre') }}" />
    </div>
</form>