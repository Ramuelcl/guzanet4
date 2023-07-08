<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Telefono extends Model
{
    use HasFactory;

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
    ];

    public function xEntidads(): MorphToMany
    {
        return $this->morphedByMany(Entidad::class, 'telefono_able');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'telefonos';
}
