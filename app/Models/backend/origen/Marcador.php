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

    public function xPosts(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\posts\Post::class, 'marcador_able');
    }

    public function xVideos(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\posts\Video::class, 'marcador_able');
    }

    public function xImagens(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\posts\Imagen::class, 'marcador_able');
    }

    public function xMovimientos(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\banca\Movimiento::class, 'marcador_able');
    }

    public function xCategorias(): MorphToMany
    {
        return $this->morphedByMany(Categoria::class, 'marcador_able');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'marcadores';
}
