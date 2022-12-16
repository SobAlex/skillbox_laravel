<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('tags')->latest()->get();
        $tags = Tag::all();

        return view('tasks.index', compact('tasks', 'tags'));
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }
}
