<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $title = 'Список задач';

        $tasks = Task::with('tags')->latest()->get();

        $tags = Tag::all();

        return view('tasks.index', compact('tasks', 'title', 'tags'));
    }

    public function show(Task $task)
    {
        $title = 'Задача';

        return view('tasks.show', compact('task', 'title'));
    }
}
