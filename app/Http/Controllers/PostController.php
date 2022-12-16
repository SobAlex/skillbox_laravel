<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\News;
use App\Models\Tag;
use App\Notifications\PostCreate;
use App\Notifications\PostDelete;
use App\Notifications\PostUpdate;
use App\Services\TagsPostSynchronizer;

class PostController extends Controller
{
    public function index(Post $post, News $news)
    {
        $title = 'Главная';
        $posts = $post->with('tags')->latest()->paginate(5);
        $news = $news->with('tags')->latest()->paginate(5);
        $tags = Tag::all();

        return view('pages.home', compact('posts', 'news', 'title', 'tags'));
    }

    public function show(Post $post)
    {
        $title = 'Статья';

        if (auth()->user()) {
            $userEdit = auth()->user()->name;
        } else {
            $userEdit = 'Anonim';
        }

        $postEdit = Post::find($post->id);
        $comments = $postEdit->comments;
        $editTime = $postEdit->updated_at->format('m/d/Y');
        $edits = $postEdit->revisionHistory;

        return view('posts.show', compact('post', 'title', 'comments', 'edits', 'userEdit', 'editTime', 'postEdit'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request, TagsPostSynchronizer $tagsPostSynchronizer)
    {
        $isPublick = ($request->isPublick) ? '1' : '0';

        $post = Post::create([
            'owner_id' => auth()->id(),
            'code' => request('code'),
            'title' => request('title'),
            'shortContent' => request('shortContent'),
            'content' => request('content'),
            'isPublick' => $isPublick,
        ]);

        auth()->user()->notify(new PostCreate($post->id));

        $tagsPostSynchronizer->sync(collect(explode(',', request('tags'))), $post);

        flash('Сообщение создано!');

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, TagsPostSynchronizer $tagsPostSynchronizer)
    {
        $attributes = request()->validate([
            'code' => 'required|alpha_dash|unique:posts,code',
            'title' => 'required|min:5|max:100',
            'shortContent' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($attributes);
        $tagsPostSynchronizer->sync(collect(explode(',', request('tags'))), $post);

        auth()->user()->notify(new PostUpdate($post->id));

        flash('Сообщение изменено!');

        return redirect('/posts/' . $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        auth()->user()->notify(new PostDelete());

        flash('Сообщение удалено!', 'warning');

        return redirect('/');
    }
}
