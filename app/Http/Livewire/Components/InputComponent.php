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
    public $icon, $peuxChanger = false;

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
        // dd($this->icon, sizeof($this->icon));
        // Cambiar entre los dos estados de icono, así siempre mostraré $icon[0]
        if (sizeof($this->icon) == 2) {
            $this->icon = array_reverse($this->icon);
            dd($this->icon[0]);
        }
        $this->render();
    }
}
