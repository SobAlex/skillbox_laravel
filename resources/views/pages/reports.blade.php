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
        <form action="{{ route('getExport', [$postsCount, $newsCount, $commentsCount]) }}">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $postsCount }}" name="postsCount">
                <label>Статьи</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $newsCount }}" name="newsCount">
                <label>Новости</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $commentsCount }}" name="commentsCount">
                <label>Комментарии</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $tagsCount }}" name="tagsCount">
                <label>Теги</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $usersCount }}" name="usersCount">
                <label>Пользователи</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Сгенерировать отчет</button>
        </form>

    </main><!-- /.container -->

@endsection

