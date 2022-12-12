@extends('layouts.master')

@php
    $posts = $posts ?? collect();
    $news = $news ?? collect();
    $comments = $comment ?? collect();
    $tags = $tag ?? collect();
    $users = $user ?? collect();
@endphp

@section('content')
    <main role="main" class="container">
        <form action="{{ route('getExport') }}" method="POST">
            @csrf
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="postsCount">
                <label>Статьи</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="newsCount">
                <label>Новости</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="commentsCount">
                <label>Комментарии</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="tagsCount">
                <label>Теги</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="usersCount">
                <label>Пользователи</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Сгенерировать отчет</button>
        </form>

    </main><!-- /.container -->
@endsection
