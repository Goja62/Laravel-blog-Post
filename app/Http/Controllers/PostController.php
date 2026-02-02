<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        $newPost =  Post::create($incomingFileds);

        return redirect("/post/{$newPost->id}")->with('success', 'New post successfuly created');
    }

    public function viewSinglePost(Post $post)
    {

        $ourHTML = strip_tags(Str::markdown($post->body), '<p><ul><ol><strong><em>');
        $post['body'] = $ourHTML;
        return view('single-post', ['post' => $post]);
    }

    public function delete(Post $post)
    {
        if (Auth::user()->cannot('delete', $post)) {
            return 'You cannot do that';
        }

        $post->delete();

        return redirect('/profile/' . Auth::user()->username)->with('success', 'Post successfuly deleted');
    }
}
