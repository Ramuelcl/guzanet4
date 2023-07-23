<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marcador extends Model
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
        'metadata' => 'array',
        'is_active' => 'boolean',
    ];

    public function mmPosts(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\posts\Post::class, 'marcadorable');
    }

    public function mmVideos(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\posts\Video::class, 'marcadorable');
    }

    public function mmImagens(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\posts\Imagen::class, 'marcadorable');
    }

    public function mmMovimientos(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\banca\Movimiento::class, 'marcadorable');
    }

    public function mmCategorias(): MorphToMany
    {
        return $this->morphedByMany(Categoria::class, 'marcadorable');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Marcadores';
}
