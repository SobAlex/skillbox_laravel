<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\PostRequest;
use App\Notifications\PostCreate;
use App\Notifications\PostDelete;
use App\Notifications\PostUpdate;
use App\Post;

use App\Tag;
use App\Services\TagsPostSynchronizer;
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

        if (auth()->user()) {
            $userEdit = auth()->user()->name;
        } else {
            $userEdit = 'Anonim';
        }

        $comments = Comment::where('post_id', $post->id)->get();

        $postEdit = Post::find($post->id);

        $editTime = $postEdit->updated_at->format('m/d/Y');

        $edits = $postEdit->revisionHistory;

        return view('posts.show', compact('post', 'title', 'comments', 'edits', 'userEdit', 'editTime'));
    }

    public function create()
    {
        $title = 'Создать статью';

        return view('posts.create', compact('title'));
    }

    public function store(PostRequest $request, TagsPostSynchronizer $tagsPostSynchronizer, Post $post)
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
        $title = 'Редактировать статью';

        return view('posts.edit', compact('post', 'title'));
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

        return redirect('/publikacii/'. $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        auth()->user()->notify(new PostDelete());

        flash('Сообщение удалено!', 'warning');

        return redirect('/');
    }
}
