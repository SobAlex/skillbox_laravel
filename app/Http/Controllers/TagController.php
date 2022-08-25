<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\News;

class TagController extends Controller
{
    public function index($tag)
    {
        $posts = Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('name', $tag);
        })->latest();

        $news = News::whereHas('tags', function ($query) use ($tag) {
            $query->where('name', $tag);
        })->latest();

        $title = 'Записи с тегом ' . $tag;

        return view('pages.home', compact('posts', 'news', 'title'));
    }
}
