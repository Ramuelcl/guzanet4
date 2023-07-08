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
        // crea profesiones
        $tab = 15000;
        $tabla['Profesiones'] = ['Profesiones', 'Doctor', 'Empresario', 'Dibujante', 'Arquitecto', 'Analista', 'Programador', 'Enfermera', 'Contador', 'Profesor', 'Sin Profesion'];
        $sizeOf = sizeOf($tabla);
        foreach ($tabla['Profesiones'] as $key => $value) {
            Tabla::factory(1)->create([
                'tabla' => $tab,
                'tabla_id' => $key == $sizeOf - 1 ? 99 : $key,
                'nombre' => $value,
                'descripcion' => null,
                'is_active' => $key ? true : false,
                'valor1' => null,
                'valor2' => null,
            ]);
        }
    }
}
$tab = 15100;
$tabla['Banca'] = [
    [
        'tabla_id' => 0,
        'nombre' => 'Banca',
        'descripcion' => 'movimientos -concentrados',
        'is_active' => 0,
    ],
    [
        'tabla_id' => 1,
        'nombre' => 'REIGN',
        'descripcion' => 'pagos de clientes',
        'is_active' => 1,
        'valor1' => 1.0,
    ],
    [
        'tabla_id' => 2,
        'nombre' => 'DIOURON',
        'descripcion' => 'pagos de clientes',
        'is_active' => 1,
        'valor1' => 2.0,
    ],
    [
        'tabla_id' => 9,
        'nombre' => 'PUVIS',
        'descripcion' => 'pagos de clientes',
        'is_active' => 1,
        'valor1' => 9.0,
    ],
    [
        'tabla_id' => 22,
        'nombre' => 'AC2 PRODUCTION',
        'descripcion' => 'pagos de clientes',
        'is_active' => 1,
        'valor1' => 22.0,
    ],
    [
        'tabla_id' => 69,
        'nombre' => 'CRUCELISA ARISTIZABAL',
        'descripcion' => 'movimientos personales',
        'is_active' => 1,
        'valor1' => 69.0,
    ],
    [
        'tabla_id' => 70,
        'nombre' => 'REGINA',
        'descripcion' => 'movimientos personales',
        'is_active' => 1,
        'valor1' => 70.0,
    ],
    [
        'tabla_id' => 1500,
        'nombre' => 'Navigo',
        'descripcion' => 'proveedores',
        'is_active' => 1,
        'valor1' => 1500.0,
    ],
    [
        'tabla_id' => 1501,
        'nombre' => 'SFR',
        'descripcion' => 'proveedores',
        'is_active' => 1,
        'valor1' => 1501.0,
    ],
    [
        'tabla_id' => 1502,
        'nombre' => 'Google YouTube',
        'descripcion' => 'proveedores',
        'is_active' => 1,
        'valor1' => 1502.0,
    ],
    [
        'tabla_id' => 1503,
        'nombre' => 'Orange',
        'descripcion' => 'proveedores',
        'is_active' => 1,
        'valor1' => 1503.0,
    ],
    [
        'tabla_id' => 1504,
        'nombre' => 'Samsung',
        'descripcion' => 'proveedores',
        'is_active' => 1,
        'valor1' => 1504.0,
    ],
    [
        'tabla_id' => 1505,
        'nombre' => 'Sosh',
        'descripcion' => 'proveedores',
        'is_active' => 1,
        'valor1' => 1503.0,
    ],
    [
        'tabla_id' => 1506,
        'nombre' => 'Free',
        'descripcion' => 'proveedores',
        'is_active' => 1,
        'valor1' => 1506.0,
    ],
    [
        'tabla_id' => 1600,
        'nombre' => 'FORMULE DE COMPTE ',
        'descripcion' => 'La Poste',
        'is_active' => 1,
        'valor1' => 1600.0,
    ],
    [
        'tabla_id' => 1601,
        'nombre' => 'DIRECTION GENERAL',
        'descripcion' => 'IMPOTS',
        'is_active' => 1,
        'valor1' => 1601.0,
    ],
    [
        'tabla_id' => 99,
        'nombre' => 'MUNOZ ALBUERNO',
        'descripcion' => 'movimientos personales',
        'is_active' => 1,
        'valor1' => 99.0,
    ],
    [
        'tabla_id' => 1603,
        'nombre' => 'FORFAITAIRE TRIMESTRIEL',
        'descripcion' => 'La Poste',
        'is_active' => 1,
        'valor1' => 1600.0,
    ],
    [
        'tabla_id' => 1700,
        'nombre' => 'ACHAT CB',
        'descripcion' => 'Compras Carte Blue',
        'is_active' => 1,
        'valor1' => 1700.0,
    ],
    [
        'tabla_id' => 1701,
        'nombre' => 'AMAZON',
        'descripcion' => 'Compras Carte Blue',
        'is_active' => 1,
        'valor1' => 1700.0,
    ],
    [
        'tabla_id' => 1702,
        'nombre' => 'CDISCOUNT',
        'descripcion' => 'Compras Carte Blue',
        'is_active' => 1,
        'valor1' => 1700.0,
    ],
];
$sizeOf = sizeOf($tabla);
foreach ($tabla['Banca'] as $key => $value) {
    Tabla::factory(1)->create([
        'tabla' => $tab,
        'tabla_id' => $value['tabla_id'],
        'nombre' => $value['nombre'],
        'descripcion' => $value['descripcion'],
        'is_active' => $value['is_active'],
        'valor1' => null,
        'valor2' => null,
        'valor3' => null,
    ]);
}
