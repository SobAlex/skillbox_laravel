<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\News;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post, News $news)
    {
        $data = $request->validated();

        $bool = ($post->id) ? true : false;

        $comment = Comment::create([
            'content' => $data['content'],
            'owner_id' => auth()->id(),
            'commentable_type' => '',
            'commentable_id' => 1
        ]);

        if ($bool) {
            $collect = Post::find($post->id);
        } else {
            $collect = News::find($news->id);
        }

        $collect->comments()->save($comment);

        flash('Комментарий добавлен!');

        return redirect()->back();
    }
}

