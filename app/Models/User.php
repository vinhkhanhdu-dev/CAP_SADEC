<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\Roles;
use App\Models\Modules;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'chucvu',
        'phone_number',
        'note',
        'password',  
        'hinhanhchuky',
        'publickey',
        'privatekey',
        'signature',
        'donvicongtac',
        'role_code',
        'id_module_default',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

      /**
     * Set permissions guard to API by default
     * @var string
     */
    protected $guard_name = 'api';

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        foreach ($this->roles as $role) {
            if ($role->isAdmin()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isPermission(): bool
    {
        foreach ($this->getAllPermissions() as $permission) {
            if ($permission->isPermission()) {
                return true;
            }
        }

        return false;
    }

    function role(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Roles::class, 'code', 'role_code');
    }

    function moduleDefault(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Modules::class, 'id', 'id_module_default');
    }

}
