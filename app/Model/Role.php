<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['rolename'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
