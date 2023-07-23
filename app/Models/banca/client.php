<?php

namespace App\Models\banca;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // Definir la conexión a la base de datos SQLite
    protected $connection = 'sqlite';

    // Definir la tabla correspondiente en SQLite
    protected $table = 'client';

    // Definir las relaciones con Entidad, Direccion y Telefono
    public function entidad()
    {
        return $this->hasOne(Entidad::class);
    }

    // Otros métodos y relaciones según sea necesario
}
