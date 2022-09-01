<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\CommentPosts;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post)
    {
        $data = $request->validated();

        $comment = CommentPosts::create([
            'content' => $data['content'],
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        flash('Комментарий добавлен!');

        return redirect()->back();
    }
}
