<?php

namespace App\Http\Controllers;

use App\Models\Post;

class TagController extends Controller
{
    public function index($tag)
    {
        $posts = Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('name', $tag);
        })->latest()->paginate(5);

        $title = 'Статьи с тегом ' . $tag;

        return view('pages.home', compact('posts', 'title'));
    }
}
