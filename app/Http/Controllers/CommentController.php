<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\News;

class CommentController extends Controller
{
    public function storePost(CommentRequest $request, Post $post)
    {
        $data = $request->validated();

        $comment = Comment::create([
            'content' => $data['content'],
            'owner_id' => auth()->id(),
            'commentable_type' => '',
            'commentable_id' => 1
        ]);

        $post->comments()->save($comment);

        flash('Комментарий добавлен!');

        return redirect()->back();
    }

    public function storeNews(CommentRequest $request, News $news)
    {
        $data = $request->validated();

        $comment = Comment::create([
            'content' => $data['content'],
            'owner_id' => auth()->id(),
            'commentable_type' => '',
            'commentable_id' => 1
        ]);

        $news->comments()->save($comment);

        flash('Комментарий добавлен!');

        return redirect()->back();
    }
}

