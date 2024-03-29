<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tabla extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tabla' => 'integer',
        'tabla_id' => 'integer',
        'is_active' => 'boolean',
        'valor3' => 'boolean',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Tablas';

    public function entidades()
    {
        return $this->morphMany(Entidad::class, 'tabla');
    }
}
