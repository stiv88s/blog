<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscribers extends Model
{
    protected $fillable = ['email','token'];
}
