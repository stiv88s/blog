<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subscribers extends Model
{
    use Notifiable;
    protected $fillable = ['email','token'];
}
