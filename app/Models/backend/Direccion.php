<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direccion extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function direccionEntidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class);
    }

    public function direccionCiudad(): BelongsTo
    {
        return $this->belongsTo(Ciudad::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Direccions';

}
