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
    ];

    public function postIndices(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\posts\Post::class, 'marcadorable');
    }

    public function videoIndices(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\posts\Video::class, 'marcadorable');
    }

    public function imagenIndices(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\posts\Imagen::class, 'marcadorable');
    }
}
