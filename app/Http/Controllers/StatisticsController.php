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

        $userMaxCountPosts = User::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->first()->name;

        $userMaxCountNews = User::withCount('news')
            ->orderBy('news_count', 'desc')
            ->first()->name;

        $contents = DB::table('posts')->pluck('content');

        $counter = collect([['count' => 10], ['count' => 20]]);

        $counter->max('count');

//        foreach ($contents as $content) {
//
//            $arr[] = strlen($content);
//            print_r(max($arr));
//        }

//        $postMaxContent = DB::table('posts')->where('content', 11)->first();
//        dd($postMaxContent);



        return view('pages.statistics', compact('postsCount', 'newsCount', 'userMaxCountPosts', 'userMaxCountNews'));
    }
}
