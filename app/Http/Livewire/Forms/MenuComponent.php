<?php
// app/Http/Livewire/MenuComponent.php

namespace App\Http\Livewire\Forms;

use App\Models\backend\Tabla;
use Illuminate\Support\Facades\DB;
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
        $menus = Tabla::where('tabla', 1000)
            ->whereNull('valor1') // parent_id
            ->where('is_active', true)
            ->get(['tabla_id as id', 'nombre', 'descripcion as url', DB::raw('CAST(valor1 AS UNSIGNED) as parent_id'), 'valor2 as icono'])
            ->toArray();

        $this->menus = array_map(function ($menu) {
            $submenu = Tabla::where('tabla', 1000)
                ->where('valor1', $menu['id'])
                ->get(['tabla_id as id', 'nombre', 'descripcion as url', DB::raw('CAST(valor1 AS UNSIGNED) as parent_id'), 'valor2 as icono'])
                ->toArray();

            $menu['submenu'] = $submenu ?: false;

            unset($menu['valor3']);
            unset($menu['created_at']);
            unset($menu['updated_at']);
            unset($menu['deleted_at']);

            return $menu;
        }, $menus);

        // dd($this->menus);
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

    public function is_activeMenu($url)
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
