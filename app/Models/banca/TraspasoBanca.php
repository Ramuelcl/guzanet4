<?php

namespace App\Models\banca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraspasoBanca extends Model
{
    use HasFactory;
    protected $table = 'traspaso_bancas';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'Date',
        'Libelle',
        'MontantEUROS',
        'MontantFRANCS',
        'NomArchTras',
        'IdArchMov',
        // Agrega aquí los demás campos de tu tabla
    ];

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
        'Date' => 'string',
        'Libelle' => 'string',
        'MontantEUROS' => 'string',
        'MontantFRANCS' => 'string',
        'NomArchTras' => 'string',
        'IdArchMov' => 'integer',
    ];
}
