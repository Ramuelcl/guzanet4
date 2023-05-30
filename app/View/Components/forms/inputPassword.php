<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class inputPassword extends Component
{
    public $type, $idName, $value, $label, $placeholder, $icono = [], $ico = null, $lenIco = 0;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $idName, string  $type = 'text', string $value = '', string $label = '', string $placeholder = '', $icono = [])
    {
        $this->idName = $idName;
        $this->$value  = $value;
        $this->type = $type;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->icono = $icono;
    }

    public function render()
    {
        return view('components.forms.input-password');
    }
}
