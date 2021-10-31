<?php

namespace App\Http\Controllers;

use App\Post;
use App\Task;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Главная';
        $posts = Post::with('tags')->latest()->get();

        $tags = Tag::all();

        return view('pages.home', compact('posts', 'title', 'tags'));
    }
}
