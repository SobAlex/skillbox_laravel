<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $title = 'Список задач';

        $tasks = Task::incomplete()->get();

        return view('tasks.index', compact('tasks', 'title'));
    }

    public function show(Task $task)
    {
        $title = 'Задача';

        return view('tasks.show', compact('task', 'title'));
    }
}
