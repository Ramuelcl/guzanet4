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

    public function mount($idName, $label = '', $placeholder = '', $disabled = 0, $labelTextAlign = 'right')
    {
        $this->idName = $idName;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
        $this->labelTextAlign = $labelTextAlign;
    }

    public function render()
    {
        return view('livewire.components.input-component');
    }
}
