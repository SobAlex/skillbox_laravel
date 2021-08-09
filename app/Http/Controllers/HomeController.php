<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Главная';
        $posts = Post::latest()->get();

        return view('home', compact('posts', 'title'));
    }
}
