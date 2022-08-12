@extends('layouts.master')

@section('content')

    <div class="container">
        <h1>Редактировать новость</h1>

        <form method="POST" action="/news/{{ $news->id }}">

            @method('patch')

            @csrf

            <div class="form-group">
                <label for="inputTitle">Название новости</label>
                <input type="text" class="form-control" id="inputTitle" name="title"
                       value="{{ old('title', $news->title) }}">
            </div>

            @error('title')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror

            <div class="form-group">
                <label for="Content">Текст новости</label>
                <textarea class="form-control" id="Content" rows="5"
                          name="content">{{ old('content', $news->content) }}</textarea>
            </div>

            <div class="form-group">
                <label for="inputTags">Теги</label>
                <input class="form-control" type="text" id="inputTags" name="tags"
                       value="{{ old('tags', $news->tags()->pluck('name')->implode(','),) }}">
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="isPublick" value="1" name="isPublick"
                       checked="checked">

                <label class="form-check-label" for="isPublick">Опубликовать</label>
            </div>

            <button type="submit" class="btn btn-primary mb-3">Изменить новость</button>

        </form>

        <form method="POST" action="/news/{{ $news->id }}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>

    </div>

@endsection
