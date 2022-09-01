<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class TagController extends Controller
{
    public function index($tag)
    {
        $articles = Tag::whereHasMorph(
            'taggable',
            [Post::class, News::class],
            function (Builder $query) use ($tag) {
                $query->where('name', $tag);
            }
        )->latest();

        dd($articles);

        $title = 'Записи с тегом ' . $tag;

        return view('pages.home', compact('articles', 'title'));
    }
}
