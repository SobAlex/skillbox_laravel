<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\PostRequest;
use App\Notifications\PostCreate;
use App\Notifications\PostDelete;
use App\Notifications\PostUpdate;
use App\Post;

use App\Tag;
use App\Services\TagsSynchronizer;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $title = 'Главная';
        $posts = $post->with('tags')->latest()->paginate(5);
        $tags = Tag::all();

        return view('pages.home', compact('posts', 'title', 'tags'));
    }

    public function show(Post $post)
    {
        $title = 'Статья';

        $comments = Comment::where('post_id', $post->id)->get();

        return view('posts.show', compact('post', 'title', 'comments'));
    }

    public function create()
    {
        $title = 'Создать статью';

        return view('posts.create', compact('title'));
    }

    public function store(PostRequest $request, TagsSynchronizer $tagsSynchronizer, Post $post)
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

        $tagsSynchronizer->sync(collect(explode(',', request('tags'))), $post);

        flash('Сообщение создано!');

        return redirect('/');
    }

    public function edit(Post $post)
    {
        $title = 'Редактировать статью';

        return view('posts.edit', compact('post', 'title'));
    }

    public function update(Post $post, TagsSynchronizer $tagsSynchronizer)
    {
        $attributes = request()->validate([
            'code' => 'required|alpha_dash|unique:posts,code',
            'title' => 'required|min:5|max:100',
            'shortContent' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($attributes);

        $tagsSynchronizer->sync(collect(explode(',', request('tags'))), $post);

        auth()->user()->notify(new PostUpdate($post->id));

        flash('Сообщение изменено!');

        return redirect('/');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        auth()->user()->notify(new PostDelete());

        flash('Сообщение удалено!', 'warning');

        return redirect('/');
    }
}
