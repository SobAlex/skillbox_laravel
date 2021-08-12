<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;

class PostController extends Controller
{
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

    public function store(Request $request)
    {

        $this->validate(request(), [
            'code' => 'required|alpha_dash|unique:posts,code',
            'title' => 'required|min:5|max:100',
            'shortContent' => 'required|max:255',
            'content' => 'required',
        ]);

        $isPublick = ($request->isPublick) ? '1' : '0';

        Post::create([
            'code' => request('code'),
            'title' => request('title'),
            'shortContent' => request('shortContent'),
            'content' => request('content'),
            'isPublick' => $isPublick,
        ]);

        return redirect('/');
    }

    public function edit(Post $post)
    {
        $title = 'Редактировать статью';

        return view('posts.edit', compact('post', 'title'));
    }

    public function update(Post $post)
    {
        // $this->validate(request(), [
        //     'code' => 'required|alpha_dash|unique:posts,code',
        //     'title' => 'required|min:5|max:100',
        //     'shortContent' => 'required|max:255',
        //     'content' => 'required',
        // ]);

        $attributes = request()->validate([
            'code' => 'required|alpha_dash|unique:posts,code',
            'title' => 'required|min:5|max:100',
            'shortContent' => 'required|max:255',
            'content' => 'required',
        ]);

        //$isPublick = ($request->isPublick) ? '1' : '0';

        $post->update($attributes);

        return redirect('/');
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
