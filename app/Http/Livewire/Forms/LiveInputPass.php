<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;

class LiveInputPass extends Component
{

    public $password = '';
    public $mostrar = false;
    public $type = "password", $idName, $label, $placeholder, $disabled;

    // public function render()
    // {
    //     return view('livewire.forms.live-input-pass');
    // }

    public function mount(string $idName, string $label = '', string $placeholder = '', $disabled = false)
    {
        $this->idName = $idName;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
    }

    public function actualizaMostrar()
    {
        $this->type = $this->mostrar ? 'text' : 'password';
    }
}
