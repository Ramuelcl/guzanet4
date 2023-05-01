<?php
// app/view/components/forms/inputSelect.php
// views/components/forms/input-select.blade.php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class inputSelect extends Component
{
    public $idName, $options, $selected, $label;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $idName,  array $options = [], $selected = 0, $label = "")
    {
        $this->idName = $idName;
        $this->options = array_column($options, 'name');
        // $this->options = array_merge(["Select..."], array_values($options));
        $this->selected =  $selected;
        $this->label =  $label;
        // dd($this->selected, $this->options);
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.forms.input-select');
    }

    // public function isSelected($seleccionada)
    // {
    //     return in_array($seleccionada, $this->opciones) ? 'selected' : '';
    // }
}
