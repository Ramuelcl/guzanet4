<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class inputEmail extends Component
{
    public $idName, $type, $label, $placeholder;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $idName, string  $type = 'text', string $label = '', string $placeholder = '')
    {
        $this->idName = $idName;
        $this->idName2;
        $this->type = $type;
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input-email');
    }
}
