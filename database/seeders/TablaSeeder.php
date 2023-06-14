<?php

namespace Database\Seeders;

use App\Models\backend\Tabla;
use Illuminate\Database\Seeder;

class TablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // crea configuracion: menus
        // $Menu = ['id', 'Nombre', 'subMenu' => []];
        $tab = 1000;
        $tabla['Menu'] = array(
            'Menus',
            'Uno',
            'Dos',
            'Tres' => ['Categorias', 'Marcadores'],
            'Cuatro',
            'Cinco' => ['A', 'B', 'C', 'D', 'E'],
            'Seis',
            'Siete'
        );

        $m = 0;
        foreach ($tabla['Menu'] as $i => $menu1) {
            // dump(['i' => $i, 'menu' => $menu1]);

            Tabla::factory(1)->create(
                [
                    'tabla' => $tab,
                    'tabla_id' => $m,
                    'nombre' => \is_array($menu1) ? $i : $menu1,
                    'descripcion' => null,
                    'isActive' => $i ? true : false,
                    'valor1' => $m ?? $m,
                    'valor2' => null,
                ]
            );
            if (\is_array($menu1)) {
                foreach ($menu1 as $j => $menu2) {
                    $n = $m + $j + 1;
                    Tabla::factory(1)->create(
                        [
                            'tabla' => $tab,
                            'tabla_id' => $n,
                            'nombre' => $menu2,
                            'descripcion' => null,
                            'isActive' => $i ? true : false,
                            'valor1' => $m,
                            'valor2' => null,
                        ]
                    );
                }
            }
            $m = $m + 100;
        }

        // crea profesiones
        $tab = 15000;
        $tabla['Profesiones'] = array('Profesiones', 'Doctor', 'Empresario', 'Dibujante', 'Arquitecto', 'Analista', 'Programador', 'Enfermera', 'Contador', 'Profesor', 'Sin Profesion');
        $sizeOf = sizeOf($tabla);
        foreach ($tabla['Profesiones'] as $key => $value) {

            Tabla::factory(1)->create(
                [
                    'tabla' => $tab,
                    'tabla_id' => $key == $sizeOf - 1 ? 99 : $key,
                    'nombre' => $value,
                    'descripcion' => null,
                    'isActive' => $key ? true : false,
                    'valor1' => null,
                    'valor2' => null,
                ]
            );
        }
    }
}
$tab = 15100;
$tabla['Banca'] = array(
    array(
        "tabla_id" => 0,
        "nombre" => "Banca",
        "descripcion" => "movimientos -concentrados",
        "isActive" => 0,
    ),
    array(
        "tabla_id" => 1,
        "nombre" => "REIGN",
        "descripcion" => "pagos de clientes",
        "isActive" => 1,
        "valor1" => 1.00,
    ),
    array(
        "tabla_id" => 2,
        "nombre" => "DIOURON",
        "descripcion" => "pagos de clientes",
        "isActive" => 1,
        "valor1" => 2.00,
    ),
    array(
        "tabla_id" => 9,
        "nombre" => "PUVIS",
        "descripcion" => "pagos de clientes",
        "isActive" => 1,
        "valor1" => 9.00,
    ),
    array(
        "tabla_id" => 22,
        "nombre" => "AC2 PRODUCTION",
        "descripcion" => "pagos de clientes",
        "isActive" => 1,
        "valor1" => 22.00,
    ),
    array(
        "tabla_id" => 69,
        "nombre" => "CRUCELISA ARISTIZABAL",
        "descripcion" => "movimientos personales",
        "isActive" => 1,
        "valor1" => 69.00,
    ),
    array(
        "tabla_id" => 70,
        "nombre" => "REGINA",
        "descripcion" => "movimientos personales",
        "isActive" => 1,
        "valor1" => 70.00,
    ),
    array(
        "tabla_id" => 1500,
        "nombre" => "Navigo",
        "descripcion" => "proveedores",
        "isActive" => 1,
        "valor1" => 1500.00,
    ),
    array(
        "tabla_id" => 1501,
        "nombre" => "SFR",
        "descripcion" => "proveedores",
        "isActive" => 1,
        "valor1" => 1501.00,
    ),
    array(
        "tabla_id" => 1502,
        "nombre" => "Google YouTube",
        "descripcion" => "proveedores",
        "isActive" => 1,
        "valor1" => 1502.00,
    ),
    array(
        "tabla_id" => 1503,
        "nombre" => "Orange",
        "descripcion" => "proveedores",
        "isActive" => 1,
        "valor1" => 1503.00,
    ),
    array(
        "tabla_id" => 1504,
        "nombre" => "Samsung",
        "descripcion" => "proveedores",
        "isActive" => 1,
        "valor1" => 1504.00,
    ),
    array(
        "tabla_id" => 1505,
        "nombre" => "Sosh",
        "descripcion" => "proveedores",
        "isActive" => 1,
        "valor1" => 1503.00,
    ),
    array(
        "tabla_id" => 1506,
        "nombre" => "Free",
        "descripcion" => "proveedores",
        "isActive" => 1,
        "valor1" => 1506.00,
    ),
    array(
        "tabla_id" => 1600,
        "nombre" => "FORMULE DE COMPTE ",
        "descripcion" => "La Poste",
        "isActive" => 1,
        "valor1" => 1600.00,
    ),
    array(
        "tabla_id" => 1601,
        "nombre" => "DIRECTION GENERAL",
        "descripcion" => "IMPOTS",
        "isActive" => 1,
        "valor1" => 1601.00,
    ),
    array(
        "tabla_id" => 99,
        "nombre" => "MUNOZ ALBUERNO",
        "descripcion" => "movimientos personales",
        "isActive" => 1,
        "valor1" => 99.00,
    ),
    array(
        "tabla_id" => 1603,
        "nombre" => "FORFAITAIRE TRIMESTRIEL",
        "descripcion" => "La Poste",
        "isActive" => 1,
        "valor1" => 1600.00,
    ),
    array(
        "tabla_id" => 1700,
        "nombre" => "ACHAT CB",
        "descripcion" => "Compras Carte Blue",
        "isActive" => 1,
        "valor1" => 1700.00,
    ),
    array(
        "tabla_id" => 1701,
        "nombre" => "AMAZON",
        "descripcion" => "Compras Carte Blue",
        "isActive" => 1,
        "valor1" => 1700.00,
    ),
    array(
        "tabla_id" => 1702,
        "nombre" => "CDISCOUNT",
        "descripcion" => "Compras Carte Blue",
        "isActive" => 1,
        "valor1" => 1700.00,
    ),
);
$sizeOf = sizeOf($tabla);
foreach ($tabla['Banca'] as $key => $value) {
    Tabla::factory(1)->create(
        [
            'tabla' => $tab,
            'tabla_id' => $value['tabla_id'],
            'nombre' => $value['nombre'],
            'descripcion' => $value['descripcion'],
            'isActive' => $value['isActive'],
            'valor1' => null,
            'valor2' => null,
            'valor3' => null,
        ]
    );
}
