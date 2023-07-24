<?php
// app/Http/Livewire/components/IconComponent.php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class IconComponent extends Component
{
    public $iconName;

    public function render()
    {
        return view('livewire.components.icon-component');
    }
}
