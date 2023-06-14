<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $fillable = ['nombre', 'url', 'icono', 'parent_id'];

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
        'parent_id' => 'integer',
        'isActive' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }


    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->where('isActive', true);
    }

    // public function childrenRecursive()
    // {
    //     return $this->hasMany(Menu::class, 'parent_id')->where('isActive', true)->with('childrenRecursive');
    // }
}
