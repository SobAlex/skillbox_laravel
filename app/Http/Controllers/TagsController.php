<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index($tag)
    {
        $posts = Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('name', $tag);
        })->get();

        $title = 'Статьи с тегом ' . $tag;

        return view('pages.home', compact('posts', 'title'));
    }
}
