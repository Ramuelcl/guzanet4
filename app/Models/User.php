<?php

namespace App\Models;

use App\Models\backend\Perfil;
use App\Models\backend\UserSetting;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
// Spatie
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    // Spatie
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'is_active',
        // 'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_path',
    ];

    /**mutators = mutadores */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function userSetting()
    {
        return $this->hasOne(UserSetting::class);
    }
    public function getProfilePhotoPathAttribute()
    {
        $name = $this->attributes['profile_photo_path'] ? $this->attributes['profile_photo_path'] : 'images/avatars/default.png';
        return $name;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    // rol incrustado en la tabla user
    // public function scopeRole($query, $role)
    // {
    //     if ($role)
    //         return $query->whereRole($role);
    // }
    // rol incrustado en la tabla user
    public function scopeTermino($query, $termino)
    {
        // dd(['query' => $query, 'termino' => $termino]);
        if ($termino) {
            return $query
                ->orWhere('role', 'like', "%{$termino}%");
        }
    }
    /**
     * recupera los roles del usuario
     */
    public function r_role($id)
    {
        return $this->hasMany(Role::class);
    }
    /**
     * recupera el perfil del usuario
     */
    public function r_perfil()
    {
        return $this->hasOne(Perfil::class);
    }
    /**
     * recupera los roles del usuario
     */
    public function r_setting()
    {
        return $this->hasOne(UserSetting::class);
    }
}
