<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

// Главная страница
Route::get('/', 'PostController@index');

// Теги
Route::get('/articles/tags/{tag}', 'TagController@index');

// Статьи
Route::redirect('/posts', '/', 301);
Route::get('/posts/create', 'PostController@create')->middleware('auth')->name('postCreate');
Route::get('/posts/{post}', 'PostController@show');
Route::post('/posts', 'PostController@store');
Route::get('/posts/{post}/edit', 'PostController@edit')->middleware('can:edit-post,post')->name('postEdit');
Route::patch('/posts/{post}', 'PostController@update');
Route::delete('/posts/{post}', 'PostController@destroy');

// Новости
Route::get('/news', 'NewsController@index')->name('news');
Route::get('/news/create', 'NewsController@create')->middleware('auth')->name('newsCreate');
Route::get('/news/{news}', 'NewsController@show');
Route::post('/news', 'NewsController@store');
Route::get('/news/{news}/edit', 'NewsController@edit')->middleware('can:edit-news,news')->name('newsEdit');
Route::patch('/news/{news}', 'NewsController@update');
Route::delete('/news/{news}', 'NewsController@destroy');

// Комментарии
Route::post('/posts/{post}', 'CommentController@storePost')->middleware('auth')->name('commentPost');
Route::post('/news/{news}', 'CommentController@storeNews')->middleware('auth')->name('commentNews');

// Задачи
Route::get('/tasks', 'TaskController@index')->name('task');
Route::get('/tasks/create', 'TaskController@create');
Route::get('/tasks/{task}', 'TaskController@show');
Route::post('/tasks', 'TaskController@store');
Route::get('/tasks/{task}/edit', 'TaskController@edit');
Route::patch('/tasks/{task}', 'TaskController@update');
Route::delete('/tasks/{task}', 'TaskController@destroy');

// Шаги к задачам выполнено/невыполнено
Route::post('/tasks/{task}/steps', 'TaskStepsController@store');
Route::post('/completed-steps/{step}', 'CompletedStepsController@store');
Route::delete('/completed-steps/{step}', 'CompletedStepsController@destroy');

// Контакты
Route::get('/contacts', 'ContactController@index')->name('contacts');
Route::post('/contacts', 'ContactController@store');
Route::get('/feedback', 'ContactController@show')->name('feedback');

// О нас
Route::get('/about', 'AboutController@index')->name('about');

// Отчеты
Route::get('/reports', 'ReportsController@index')->name('reports');
Route::post('/exports', 'ReportsController@getExport')->name('getExport');

// Статистика
Route::get('/statistics', 'StatisticsController@index')->name('statistics');

Auth::routes();
