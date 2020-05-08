<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\BlockedUsers;
use App\Model\User;
use Illuminate\Http\Request;

class BlockedUsersController extends Controller
{
    public function index()
    {
        $blockedUsers = BlockedUsers::all();

        return view('admin.blockedUsers.index', compact('blockedUsers'));
    }


    public function unblock(User $user)
    {
        $user->is_blocked = 0;
        $user->save();

        $blockedUser = BlockedUsers::where('user_id', $user->id)->first();

        $blockedUser->delete();
    }

    public function block(User $user)
    {
        $user->is_blocked = 1;
        $user->save();
    }
}
