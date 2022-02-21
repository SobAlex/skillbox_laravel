<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Post;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post)
    {
        $data = $request->validated();

        $comment = Comment::create([
            'content' => $data['content'],
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        flash('Комментарий добавлен!');

        return redirect()->back();
    }
}
