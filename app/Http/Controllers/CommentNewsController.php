<?php

namespace App\Http\Controllers;

use App\CommentNews;
use App\Http\Requests\CommentNewsRequest;
use App\News;
use Illuminate\Http\Request;

class CommentNewsController extends Controller
{
    public function store(CommentNewsRequest $request, News $news)
    {
        $data = $request->validated();

        $comment = CommentNews::create([
            'content' => $data['content'],
            'user_id' => auth()->id(),
            'news_id' => $news->id,
        ]);

        flash('Комментарий добавлен!');

        return redirect()->back();
    }
}
