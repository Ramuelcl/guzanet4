<?php
// livewire.components.InputComponent.php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class InputComponent extends Component
{
    public $idName;

    public $label;
    public $placeholder;

    public function mount($idName, $label = '', $placeholder = '')
    {
        $this->idName = $idName;
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('livewire.components.input-component');
    }
}
