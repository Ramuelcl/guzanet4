<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class navigationMenu extends Component
{
    public $menus = null;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menus = array(

            [
                'name' => 'clientes',
                'title' => 'Clientes',
                'route' => 'client.list',
                'active' => 'client.*',
                'role' => 'client|admin',
                'disabled' => false,
                'subMenu' => null,
            ],
            [
                'name' => 'vendedores',
                'title' => 'Vendedores',
                'route' => 'seller.list',
                'active' => 'seller.*',
                'role' => 'seller|admin',
                'disabled' => false,
                'subMenu' => null,
            ],
            [
                'name' => 'user',
                'title' => 'Usuarios',
                'route' => 'user.list',
                'active' => 'user.*',
                'role' => 'admin',
                'disabled' => false,
                'subMenu' => null,
            ],
            [
                'name' => 'roles',
                'title' => 'Roles & Permisos',
                'route' => 'roles.list', //'roles.index',
                'active' =>  'roles.*',
                'role' => 'admin',
                'disabled' => false,
                'subMenu' => null,
            ],
            // [
            //     'name' => 'permissions',
            //     'title' => 'Permissions',
            //     'route' => 'user.list', // route('users.permissions'),
            //     'active' => false, // 'users.*',
            //     'role' => 'admin',
            //     'disabled' => false,
            //     'subMenu' => null,
            // ],
            [
                'name' => 'acercade',
                'title' => 'About...',
                'route' => 'acercade',
                'active' => 'acercade',
                'role' => 'guest',
                'disabled' => true,
                'subMenu' => null,
            ],
            [
                'name' => 'contacto',
                'title' => 'Contact',
                'route' => 'contacto',
                'active' => 'contacto',
                'role' => 'guest',
                'disabled' => true,
                'subMenu' => null,
            ],
        );
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation-menu')->with($this->menus);
    }
}
