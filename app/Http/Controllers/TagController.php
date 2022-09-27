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
        $tagModel = Tag::where('name', $tag)->first();
        $posts = $tagModel->posts;
        $news = $tagModel->news;
        $title = 'Записи с тегом ' . $tag;

        return view('pages.home', compact('posts', 'news', 'title'));
    }
}
