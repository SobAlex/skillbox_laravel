<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\Comment;
use App\Models\News;
use App\Models\Tag;
use App\Notifications\NewsCreate;
use App\Services\TagsNewsSynchronizer;

class NewsController extends Controller
{
    public function index(News $news)
    {
        $title = 'Новости';
        $news = $news->with('tags')->latest()->paginate(5);
        $tags = Tag::all();

        return view('news.index', compact('title', 'news', 'tags'));
    }

    public function create()
    {
        $title = 'Создать новость';

        return view('news.create', compact('title'));
    }

    public function store(NewsRequest $request, TagsNewsSynchronizer $tagsNewsSynchronizer)
    {
        $isPublick = ($request->isPublick) ? '1' : '0';

        $news = News::create([
            'owner_id' => auth()->id(),
            'title' => request('title'),
            'image' => request('image'),
            'content' => request('content'),
            'isPublick' => $isPublick,
        ]);

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

        $comments = $news->comments();
        $newsEdit = News::find($news->id);
        $editTime = $newsEdit->updated_at->format('m/d/Y');
        $edits = $newsEdit->revisionHistory;

        return view('news.show', compact('news', 'title', 'comments', 'edits', 'userEdit', 'editTime'));
    }

    public function edit(News $news)
    {
        $title = 'Редактировать новость';

        return view('news.edit', compact('news', 'title'));
    }

    public function update(News $news, TagsNewsSynchronizer $tagsNewsSynchronizer)
    {
        $attributes = request()->validate([
            'title' => 'required|min:5|max:100',
            'content' => 'required',
        ]);

        $news->update($attributes);
        $tagsNewsSynchronizer->sync(collect(explode(',', request('tags'))), $news);

        flash('Новость изменена!');

        return redirect('/news/' . $news->id);
    }

    public function destroy(News $news)
    {
        $news->delete();

        flash('Новость удалена!', 'warning');

        return redirect('/');
    }
}
