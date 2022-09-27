<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $data = $request->validated();

        $comment = Comment::create([
            'content' => $data['content'],
            'owner_id' => auth()->id(),
            'commentable_type' => 'App\Models\News',
            'commentable_id' => 1
        ]);

//        dd($comment);

        flash('Комментарий добавлен!');

        return redirect()->back();
    }
}
