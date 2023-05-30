@props(['disabled' => false])
<div>
    {{-- @dump(['type' => $type, 'icono' => $icono, 'idName' => $idName]) --}}

    @livewire('forms.live-input-pass', ['idName' => $idName, 'label' => $label, 'placeholder' => $placeholder, 'icono' => $icono, 'disabled' => $disabled])
</div>