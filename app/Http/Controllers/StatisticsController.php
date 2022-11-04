<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\News;
use App\Models\Post;
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

        $maxCountSameId = DB::table('revisions')
            ->select('revisionable_id', DB::raw('count(*) as total'))
            ->groupBy('revisionable_id')
            ->orderBy('total', 'desc')
            ->first();

        $theMostChangePost = Post::find($maxCountSameId->revisionable_id);

        return view('pages.statistics', compact('postsCount', 'theMostChangePost', 'avgCountPosts', 'maxCommentsPost', 'newsCount', 'userMaxCountPosts', 'userMaxCountNews', 'maxContent', 'minContent'));
    }
}
