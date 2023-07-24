<?php
// livewire.components.InputComponent.php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class InputComponent extends Component
{
    public $idName;

    public $label;
    public $labelTextAlign;
    public $placeholder;
    public $disabled;
    public $icon;

    public function mount($idName, $label = '', $placeholder = '', $disabled = 0, $labelTextAlign = 'right', $opcion = 'password', $icon = '')
    {
        $this->idName = $idName;
        $this->label = $label;
        $this->labelTextAlign = $labelTextAlign;
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
        $this->icon = $icon;
    }

    public function render()
    {
        return view('livewire.components.input-component');
    }
}
