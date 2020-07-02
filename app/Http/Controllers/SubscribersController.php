<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Model\Subscribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SubscribersController extends Controller
{
    public function subscribe(SubscribeRequest $request)
    {

        Subscribers::create([
            'email' => $request->input('email'),
            'token' => Str::random(60)
        ]);

        return redirect()->route('welcome');
    }

    public function unsubscribe($token)
    {
        $subscribers = Subscribers::where('token', $token)->firstOrFail();
        $subscribers->delete();

        Session::flash('status', 'You have been successfuly unsubscribed from future updates');

        return redirect()->route('welcome');


    }
}
