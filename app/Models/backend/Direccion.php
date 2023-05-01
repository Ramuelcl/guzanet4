<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'numero',
        'calle',
        'codPostal',
        'ciudad_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ciudad_id' => 'integer',
    ];

    public function xEntidades()
    {
        return $this->belongsTo(Entidad::class);
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }
}
