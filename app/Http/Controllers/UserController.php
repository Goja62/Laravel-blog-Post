<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class UserController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'You are now ogged out.');
    }

    public function showCorrectHomepage()
    {
        if (Auth::check()) {
            return view('homepage-feed');
        } else {
            return view('homepage');
        }
    }
    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if (Auth::attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You have succesfuly logged in.');
        } else {
            return redirect('/')->with('failure', 'Invalid login');
        }
    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'confirmed'],

        ]);

        $user =  User::create($incomingFields);
        Auth::login($user);
        return redirect('/')->with('success', 'Thank you for creating account');
    }

    public function profile(User $user)
    {
        return view('profile-posts', ['username' => $user->username, 'posts' => $user->posts()->latest()->get(), 'postCount' => $user->posts()->count()]);
    }

    public function showAvatarForm()
    {
        return view('avatar-form');
    }

    public function storeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:6000'
        ]);

        $user = Auth::user();

        $filename = $user->id . "-" . uniqid() . ".jpg";

        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file("avatar"));
        $imgData = $image->cover(120, 120)->toJpeg();
        Storage::disk('public')->put('avatars/' . $filename, $imgData);
    }
}
