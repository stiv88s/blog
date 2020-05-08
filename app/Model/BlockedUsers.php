<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlockedUsers extends Model
{
    protected $fillable = ['user_id', 'admin_id', 'reason'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
