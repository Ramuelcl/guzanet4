<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;

use App\Models\backend\Menu;

class MenuComponent extends Component
{
    public $menuItems;
    public $showSubmenu = null;
    public $hoverIndex = null;

    public function mount()
    {
        $this->menuItems = Menu::whereNull('parent_id')->with('childrens')->get()->toArray();
        dd($this->menuItems);
        $this->showSubmenu = null;
        $this->hoverIndex = null;
    }
    // public function toggleSubmenu($index)
    // {
    //     if ($this->showSubmenu === $index) {
    //         $this->showSubmenu = null;
    //     } else {
    //         $this->showSubmenu = $index;
    //     }

    //     $this->hoverIndex = null; // Restablecer el valor de hoverIndex
    // }

    public function toggleSubmenu($menuId)
    {
        $menu = $this->menuItems->firstWhere('id', $menuId);
        $menu->showSubmenu = !$menu->showSubmenu;
    }

    public function render()
    {
        return view('livewire.forms.menu-component');
    }
}
