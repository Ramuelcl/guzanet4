<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
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
    ];

    public function mmPosts(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\posts\Post::class, 'categoriaable');
    }

    public function mmVideos(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\posts\Video::class, 'categoriaable');
    }

    public function mmImagens(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\posts\Imagen::class, 'categoriaable');
    }

    public function mmMovimientos(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\banca\Movimiento::class, 'categoriaable');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Categorias';

}
