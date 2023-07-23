<?php

namespace Database\Seeders;

use App\Models\backend\Tabla;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    static public $ind = 0;
    static public $saltoInd = 100;
    static public $ultimoInd;
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
                'is_active' => true,
            ],
            [
                'nombre' => 'Tablas',
                'url' => null,
                'is_active' => true,
                'submenu' => [
                    [
                        'nombre' => 'Categorias',
                        'url' => '/categorias',
                        'is_active' => true,
                    ],
                    [
                        'nombre' => 'Marcadores',
                        'url' => '/marcadores',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'nombre' => 'Usuarios',
                'url' => null,
                'is_active' => true,
                'submenu' => [
                    [
                        'nombre' => 'Usuarios',
                        'url' => '/admin/usuarios',
                        'is_active' => true,
                    ],
                    [
                        'nombre' => 'Roles',
                        'url' => '/admin/roles',
                        'is_active' => false,
                    ],
                    [
                        'nombre' => 'Permisos',
                        'url' => '/admin/permisos',
                        'is_active' => true,
                    ],
                ],
            ],
            // Agrega más elementos de menú según sea necesario
            [
                'nombre' => 'Acerca de',
                'url' => '/acercade',
                'is_active' => true,
            ],
            [
                'nombre' => 'Banca',
                'url' => null,
                'is_active' => true,
                'submenu' => [
                    [
                        'nombre' => 'Traspasos',
                        'url' => '/banca/traspasos',
                        'is_active' => true,
                    ],
                    [
                        'nombre' => 'Clientes',
                        'url' => '/banca/clientes',
                        'is_active' => true,
                    ],
                ]
            ],
        ];

        $menuItems = $subMenu ?: $menuItems;
        $saltoInd = $subMenu ? 5 : 100;

        foreach ($menuItems as $menuItem) {
            static::$ind += $saltoInd;

            $menu = Tabla::create([
                'tabla' => 1000,
                'tabla_id' => static::$ind,
                'nombre' => $menuItem['nombre'],
                'descripcion' => $menuItem['url'],
                'is_active' => $menuItem['is_active'],
                'valor1' => $parentId,
            ]);


            if (isset($menuItem['submenu'])) {
                $this->createMenuItems($menu->tabla_id, $menuItem['submenu']);
                // funciona solo para 1 submenu
                static::$ind = $menu->tabla_id;
            }
        }

        // // Si el menú actual es un menú principal
        // if (!$subMenu) {
        //     $saltoInd = static::$saltoInd;
        //     $multiplo = static::$ind % $saltoInd;

        //     if ($multiplo !== 0) {
        //         static::$ind += $saltoInd - $multiplo;
        //     }
        // }
    }
}
