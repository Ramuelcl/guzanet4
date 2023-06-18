<?php
// app/Http/Livewire/MenuComponent.php

namespace App\Http\Livewire\Forms;

use App\Models\backend\Menu;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class MenuComponent extends Component
{
    public $menus;
    public $selectedMenuId;
    public $orientation = false; // vertical=false; horizontal=true
    public $currentLocale;

    public function mount($orientation = false)
    {
        $this->menus = Menu::whereNull('parent_id')
            ->where('isActive', true)
            ->with('children')
            ->get();
        $this->toggleOrientation($orientation);
    }

    public function render()
    {
        return view('livewire.forms.menu-component');
    }

    public function toggleOrientation($orientation)
    {
        $this->orientation = $orientation;
    }

    public function isActiveMenu($url)
    {
        return request()->url() === url($url);
    }

    public function toggleSubMenu($menuId)
    {
        if ($this->selectedMenuId === $menuId) {
            $this->selectedMenuId = null;
        } else {
            $this->selectedMenuId = $menuId;
        }
    }
    public function openSubMenu($menuId)
    {
        $this->selectedMenuId = $menuId;
    }

    public function closeSubMenu()
    {
        $this->selectedMenuId = null;
    }

    public function selectLangue($langue = '/greeting/fr')
    {
        // dd($langue);
        $currentLocale = session('locale') === substr($langue, -2);
        return $currentLocale;
    }
}
