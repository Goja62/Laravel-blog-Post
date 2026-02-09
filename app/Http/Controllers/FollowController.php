<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function createFollow(User $user)
    {
        // you cannot fallow youself
        if ($user->id === Auth::user()->id) {
            return back()->with('failure', 'You cannot follow yourelf');
        }


        // you cannot follow you're alredy follow
        $existCheck = Follow::where([['user_id', '=', Auth::user()->id], ['followeduser', '=', $user->id]])->count();

        if ($existCheck) {
            return back()->with('failure', 'Yuy are alredy fallowing that user');
        }
        $newFollow = new Follow;
        $newFollow->user_id = Auth::user()->id;
        $newFollow->followeduser = $user->id;
        $newFollow->save();

        return back()->with('success', 'User succefully followed,');
    }

    public function removeFollow() {}
}
