<?php

namespace App\Model;

use App\Model\Contracts\GenerableInterface;
use App\Traits\GenerableTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model implements GenerableInterface
{
    use GenerableTrait;

    private $generable = true;

    protected $fillable = ['rolename'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

}
