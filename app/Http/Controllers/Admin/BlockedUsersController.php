<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\BlockedUsers;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return ['user'=>$user];
    }

    public function block(Request $request,User $user)
    {
        $user->is_blocked = 1;
        $user->save();

        $user = BlockedUsers::updateOrCreate(
            ['user_id'=>$user->id],
            [
            'user_id'=> $user->id,
            'admin_id'=> Auth::id(),
            'reason'=> $request->reason
            ]
        );
        return ['user'=>$user];
    }
}
