<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function showCreateForm()
    {
        return view('create-post');
    }

    public function storeNewPost(Request $request)
    {
        $incomingFileds = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFileds['title'] = strip_tags($incomingFileds['title']);
        $incomingFileds['body'] = strip_tags($incomingFileds['body']);
        $incomingFileds['user_id'] = Auth::id();

        Post::create($incomingFileds);

        return "Saved";
    }
}
