<?php

namespace App\Models\banca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovimientoBanca extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "movimiento_bancas";
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

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
        'dateMouvement' => 'date',
        'montant' => 'decimal:2',
        'cliente_id' => 'integer',
        'releve' => 'integer',
        'dateReleve' => 'date',
        'estado' => 'boolean',
        'conciliada' => 'boolean',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];
}
