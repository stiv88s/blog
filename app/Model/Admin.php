<?php

namespace App\Model;

use App\Model\Contracts\GenerableInterface;
use App\Notifications\User\ResetPasswordNotification;
use App\Traits\GenerableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticatable implements GenerableInterface
{
    use Notifiable, GenerableTrait;

    private $generable = true;

    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'status', 'active_to'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {

        return $this->belongsToMany(Role::class, 'admin_roles')->withTimestamps();
    }

    public function sendPasswordResetNotification($token)
    {

        $this->notify(new ResetPasswordNotification($token, 'admin'));
    }

    public function posts()
    {

        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function isSuperAdmin()
    {
        return (bool)Auth()->user()->roles->where('rolename', 'superadmin')->first();
    }

    public function getPermissionsAttribute()
    {
        if ($this->isSuperAdmin() == true) {
            return ['superadmin'];
        }

        $permissions = [];
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $perm) {
                $permissions[] = $perm->name;
            }
        }
        return $permissions;

    }

    public function isAdmin()
    {
        return true;
    }

}
