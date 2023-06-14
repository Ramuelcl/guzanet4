<?php

namespace App\Http\Livewire\Forms;

use App\Models\backend\Tabla;
use Livewire\Component;

class MenuWithSubmenus extends Component
{
    public $menuItems = [
        'id' => 100,
        'name' => 'Inicio',
        'has_submenus' => false,
        'submenus' => [
            'id' => 101,
            'name' => 'sub menu',
        ],
    ];

    public $menuItemId;
    public $submenuId;

    protected $listeners = ['menuItemSelected', 'submenuSelected'];

    public function render()
    {
        $menuItems = Tabla::where('tabla', '=', 1000)
            ->with('submenus')->get();

        return view('livewire.forms.menu-with-submenus', [
            'menuItems' => $menuItems,
        ]);
    }


    public function menuItemSelected($menuItemId)
    {
        $this->menuItemId = $menuItemId;
        $this->submenuId = null;
    }

    public function submenuSelected($submenuId)
    {
        $this->submenuId = $submenuId;
    }
}
