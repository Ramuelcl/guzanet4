<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo',
        'razonSocial',
        'nombres',
        'apellidos',
        'activo',
        'eMail',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'activo' => 'boolean',
    ];

    public function xDirecciones()
    {
        return $this->hasMany(Direccion::class);
    }

    public function xTelefonos()
    {
        return $this->hasMany(Telefono::class);
    }

    public function clienteIndices()
    {
        return $this->morphedByMany(\App\Models\ventas\Cliente::class, 'entidadable');
    }

    public function vendedorIndices()
    {
        return $this->morphedByMany(\App\Models\compras\Vendedor::class, 'entidadable');
    }

    public function perfilIndices()
    {
        return $this->morphedByMany(Perfil::class, 'entidadable');
    }

    public function movimientoIndices()
    {
        return $this->morphedByMany(\App\Models\banca\Movimiento::class, 'entidadable');
    }
}
