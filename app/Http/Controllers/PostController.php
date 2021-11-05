<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;
use App\Services\TagsSynchronizer;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Главная';
        $posts = auth()->user()->posts()->with('tags')->latest()->get();

        $tags = Tag::all();

        return view('pages.home', compact('posts', 'title', 'tags'));
    }

    public function show(Post $post)
    {
        $title = 'Статья';
        return view('posts.show', compact('post', 'title'));
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

        $tagsSynchronizer->sync(collect(explode(',', request('tags'))), $post);

        return redirect('/');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
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

        return redirect('/');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
