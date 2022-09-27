@extends('layouts.master')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-8">
                @include('tasks.tags', ['tags' => $news->tags])

                <h1>{{ $news->title }}</h1>
                <p class="blog-post-meta">{{ $news->created_at->toFormattedDateString() }}</p>
                <p>{{ $news->content }}</p>
                <img class="news-img" src="/images/{{ $news->image }}" alt="image">

                @can('edit-news', $news)
                    <a href="/news/{{ $news->id }}/edit">Изменить новость</a>
                @endcan
            </div>

            @include('includes.aside')

        </div>

        @auth
            <div class="mt-3">
                <p><b>Изменения</b></p>
                <p>Пользователь {{ $userEdit }} изменил поля: </p>
                <p>Время редактирования: {{ $editTime }}</p>

                @foreach($edits as $history)
                    <div>
                        <li>{{ $history->fieldName() }}</li>
                    </div>
                @endforeach
            </div>
        @endauth

        <div class="row mt-3">
            <div class="col-8">
                <h3>Комментарии</h3>

                <form method="POST" action="{{ route('commentNews', $news->id) }}">

                    @csrf

                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="content"></textarea>
                    </div>

                    @error('content')
                    <div class="alert alert-danger">
                        Введите комментарий
                    </div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Добавить комментарий</button>
                    <small>Добавить комментарии могут только авторизованные пользователи</small>

                </form>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-8">
                @foreach($comments as $comment)
                    <p class="blog-post-meta">Автор комментария: {{ $comment->user->name }}</p>
                    <p class="blog-post-meta">Дата создания комментария: {{ $comment->created_at}}</p>
                    <p>{{ $comment->content }}</p>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>

@endsection
