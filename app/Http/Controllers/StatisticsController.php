<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Task;
use App\Models\News;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    Public function index()
    {
        $postsCount = Post::count();
        $newsCount = News::count();

        $maxCommentsPost = Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->first();

        $userMaxCountPosts = User::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->first()->name;

        $userMaxCountNews = User::withCount('news')
            ->orderBy('news_count', 'desc')
            ->first()->name;

        $maxContent = DB::table('posts')->orderByraw('LENGTH(content) DESC')->first();
        $minContent = DB::table('posts')->orderByraw('LENGTH(content) ASC')->first();

        $userCountPosts = User::WithCount('posts')->get();
        $avgCountPosts = $userCountPosts->avg('posts_count');



        return view('pages.statistics', compact('postsCount', 'avgCountPosts', 'maxCommentsPost', 'newsCount', 'userMaxCountPosts', 'userMaxCountNews', 'maxContent', 'minContent'));
    }
}
