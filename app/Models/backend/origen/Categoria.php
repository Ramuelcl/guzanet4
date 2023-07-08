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

    public function Posts(): MorphToMany
    {
        return $this->morphedByMany(Backend\Post::class, 'categoria_able');
    }

    public function Videos(): MorphToMany
    {
        return $this->morphedByMany(Backend\Video::class, 'categoria_able');
    }

    public function Imagens(): MorphToMany
    {
        return $this->morphedByMany(Backend\Imagen::class, 'categoria_able');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorias';
}
