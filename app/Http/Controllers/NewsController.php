<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentNews;
use App\Http\Requests\NewsRequest;
use App\Notifications\NewsCreate;
use App\News;
use App\Post;
use App\Services\TagsNewsSynchronizer;
use App\Tag;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(News $news) {
        $title = 'Новости';
        $news = $news->with('tags')->latest()->paginate(5);
        $tags = Tag::all();
        return view('news.index', compact('title', 'news', 'tags'));
    }

    public function create() {
        $title = 'Создать новость';

        return view('news.create', compact('title'));
    }

    public function store(NewsRequest $request, TagsNewsSynchronizer $tagsNewsSynchronizer, News $news)
    {
        $isPublick = ($request->isPublick) ? '1' : '0';

        $news = News::create([
            'owner_id' => auth()->id(),
            'title' => request('title'),
            'image' => request('image'),
            'content' => request('content'),
            'isPublick' => $isPublick,
        ]);

        //auth()->user()->notify(new PostCreate($post->id));

        $tagsNewsSynchronizer->sync(collect(explode(',', request('tags'))), $news);

        flash('Новость создана!');

        return redirect('/news');
    }

    public function show(News $news)
    {
        $title = 'Новость';

        if (auth()->user()) {
            $userEdit = auth()->user()->name;
        } else {
            $userEdit = 'Anonim';
        }

        $comments = CommentNews::where('news_id', $news->id)->get();

        $newsEdit = News::find($news->id);

        $editTime = $newsEdit->updated_at->format('m/d/Y');

        $edits = $newsEdit->revisionHistory;

        return view('news.show', compact('news', 'title', 'comments', 'edits', 'userEdit', 'editTime'));
    }
}
