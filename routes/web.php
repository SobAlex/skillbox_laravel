<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Post;
use App\Task;
use App\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', 'HomeController@index');

// Теги
Route::get('/publikacii/tags/{tags}', 'TagsController@index');

// Статьи
Route::redirect('/publikacii', '/', 301);
Route::get('/publikacii/sozdat-statyu', 'PostController@create')->name('postCreate');
Route::get('/publikacii/{post}', 'PostController@show');
Route::post('/publikacii', 'PostController@store');
Route::get('/publikacii/{post}/edit', 'PostController@edit')->name('postEdit');
Route::patch('/publikacii/{post}', 'PostController@update');
Route::delete('/publikacii/{post}', 'PostController@destroy');

// Задачи
Route::get('/tasks', 'TaskController@index')->name('task');
Route::get('/tasks/sozdat-zadachu', 'TaskController@create');
Route::get('/tasks/{task}', 'TaskController@show');
Route::post('/tasks', 'TaskController@store');
Route::get('tasks/{task}/edit', 'TaskController@edit');
Route::patch('/tasks/{task}', 'TaskController@update');
Route::delete('tasks/{task}', 'TaskController@destroy');

// Шаги к задачам выполнено/невыполнено
Route::post('/tasks/{task}/steps', 'TaskStepsController@store');
Route::post('completed-steps/{step}', 'CompletedStepsController@store');
Route::delete('completed-steps/{step}', 'CompletedStepsController@destroy');

// Контакты
Route::get('/kontacty', 'ContactController@index')->name('contacts');
Route::post('/kontacty', 'ContactController@store');
Route::get('/obrashcheniya', 'ContactController@show')->name('feedback');

// О нас
Route::get('/o-nas', 'AboutController@index')->name('about');
