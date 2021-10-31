<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index($tags)
    {
        $posts = Post::whereHas('tags', function ($query) use ($tags) {
            $query->where('name', $tags);
        })->get();

        $title = 'Статьи с тегом ' . $tags;

        return view('pages.home', compact('posts', 'title'));
    }
}
