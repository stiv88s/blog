<?php

namespace App\Model;

use App\Model\Contracts\GenerableInterface;
use App\Traits\GenerableTrait;
use Illuminate\Database\Eloquent\Model;

class BlockedUsers extends Model implements GenerableInterface
{
    use GenerableTrait;

    protected $fillable = ['user_id', 'admin_id', 'reason'];

    private $generable = true;

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
