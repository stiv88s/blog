<?php

namespace App\Model;

use App\Model\Contracts\GenerableInterface;
use App\Notifications\ResetPasswordNotification2;
use App\Notifications\User\ResetPasswordNotification;
use App\Traits\GenerableTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements GenerableInterface
{
    use HasApiTokens, Notifiable,GenerableTrait;

    private $generable = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_blocked','reason','prefered_city'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {

        $this->notify(new ResetPasswordNotification($token,'user'));
    }

}
