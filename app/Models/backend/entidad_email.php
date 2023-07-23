<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntidadEmail extends Model
{
    protected $table = 'entidad_emails';

    protected $fillable = ['entidad_id', 'email_id'];

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    public function email()
    {
        return $this->belongsTo(Email::class);
    }
}
