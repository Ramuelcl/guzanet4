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

            // [
            //     'name' => 'users',
            //     'title' => 'Users',
            //     'route' => 'porDefinir',
            //     'active' => null,
            //     'disabled' => false,
            //     'subMenu' => array(),
            // ],
            [
                'name' => 'user',
                'title' => 'Usuarios',
                'route' => 'user.list',
                'active' => 'user.list',
                'disabled' => false,
                'subMenu' => null,
            ],
            // [
            //     'name' => 'roles',
            //     'title' => 'Roles',
            //     'route' => 'roles.index',
            //     'active' => false, // 'users.*',
            //     'disabled' => false,
            //     'subMenu' => null,
            // ],
            // [
            //     'name' => 'permissions',
            //     'title' => 'Permissions',
            //     'route' => '#', // route('users.permissions'),
            //     'active' => false, // 'users.*',
            //     'disabled' => false,
            //     'subMenu' => null,
            // ],
            [
                'name' => 'acercade',
                'title' => 'About...',
                'route' => 'acercade',
                'active' => 'acercade',
                'disabled' => true,
                'subMenu' => null,
            ],
            [
                'name' => 'contacto',
                'title' => 'Contact',
                'route' => 'contacto',
                'active' => 'contacto.*',
                'disabled' => true,
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
