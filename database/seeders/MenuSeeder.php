<?php

namespace Database\Seeders;

use App\Models\backend\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createMenuItems(null);
    }


    public function createMenuItems($parentId, $subMenu = null)
    {

        $menuItems = [
            [
                'nombre' => 'Inicio',
                'url' => '/',
                'isActive' => true,
            ],
            [
                'nombre' => 'Tablas',
                'url' => null,
                'isActive' => true,
                'submenu' => [
                    [
                        'nombre' => 'Categorias',
                        'url' => '/categorias',
                        'isActive' => true,
                    ],
                    [
                        'nombre' => 'Marcadores',
                        'url' => '/marcadores',
                        'isActive' => true,
                    ],
                ],
            ],
            [
                'nombre' => 'Usuarios',
                'url' => null,
                'isActive' => true,
                'submenu' => [
                    [
                        'nombre' => 'Usuarios',
                        'url' => '/admin/usuarios',
                        'isActive' => true,
                    ],
                    [
                        'nombre' => 'Roles',
                        'url' => '/admin/roles',
                        'isActive' => false,
                    ],
                    [
                        'nombre' => 'Permisos',
                        'url' => '/admin/permisos',
                        'isActive' => true,
                    ],
                ],
            ],
            // Agrega más elementos de menú según sea necesario
        ];

        $menuItems = $subMenu ?: $menuItems;

        foreach ($menuItems as $menuItem) {
            $menu = Menu::create([
                'nombre' => $menuItem['nombre'],
                'url' => $menuItem['url'],
                'isActive' => $menuItem['isActive'],
                'parent_id' => $parentId,
            ]);

            if (isset($menuItem['submenu'])) {
                $this->createMenuItems($menu->id, $menuItem['submenu']);
            }
        }
    }
}
