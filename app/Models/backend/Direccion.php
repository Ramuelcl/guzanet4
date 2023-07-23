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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'entidad_id' => 'integer',
        'ciudad_id' => 'integer',
    ];

    public function direccionEntidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class);
    }

    public function entidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class);
    }

    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(Ciudad::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Direcciones';
}
