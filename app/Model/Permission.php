<?php

namespace App\Model;

use App\Model\Contracts\GenerableInterface;
use App\Traits\GenerableTrait;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model implements GenerableInterface
{
    use GenerableTrait;

    protected $fillable = ['name'];

    private $generable = true;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }

}
