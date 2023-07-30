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
    public $icon, $peuxChanger = false, $currentIconIndex = 0;

    public function mount($idName, $label = '', $placeholder = '', $disabled = 0, $labelTextAlign = 'left',  $icon = [], $opcion = 'password')
    {
        $this->idName = $idName;
        $this->label = $label;
        $this->labelTextAlign = $labelTextAlign;
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
        if ($icon) {
            // dd($icon);
            if (is_string($icon)) {
                $icon = array($icon);
            }
            if (sizeof($icon) > 1) {
                $this->peuxChanger = true;
            }
            $this->icon = $icon;
        }
    }

    public function render()
    {
        return view('livewire.components.input-component');
    }

    public function changeIcon()
    {
        // Cambiar entre los dos estados de icono, así siempre mostraré $icon[0]
        if ($this->peuxChanger) {
            $this->currentIconIndex = 1 - $this->currentIconIndex;
            dump($this->icon[$this->currentIconIndex]);
        }
    }
}
