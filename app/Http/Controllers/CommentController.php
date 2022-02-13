<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Post;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'content' => request('content'),
        ]);



        flash('Комментарий добавлен!');

        return redirect()->back();
    }
}
