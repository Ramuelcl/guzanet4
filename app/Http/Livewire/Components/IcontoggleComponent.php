<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class IcontoggleComponent extends Component
{
    public $icon1;
    public $icon2;

    public function mount($icon1 = null, $icon2 = null)
    {
        $this->icon1 = $icon1 ?? 'home';
        $this->icon2 = $icon2 ?? 'check';
    }

    public function toggle()
    {
        $this->icon1 = $this->icon1 == $this->icon1 ? $this->icon2 : $this->icon1;
    }
    public function render()
    {
        return view('livewire.components.icontoggle-component', [
            'icon1' => $this->icon1,
            'icon2' => $this->icon2,
        ]);
    }
}
