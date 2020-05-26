<?php

namespace App\Model;

use App\Model\Contracts\GenerableInterface;
use App\Notifications\User\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticatable implements GenerableInterface
{
    use Notifiable;

    const IS_GENERABLE = true;

    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'status'
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

    public static function isGenerable()
    {
        if ((new static)::IS_GENERABLE) {
            return (new static)::IS_GENERABLE;
        } else {
            return false;
        }

    }

}
