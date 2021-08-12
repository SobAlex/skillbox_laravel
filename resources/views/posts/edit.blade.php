@extends('layouts.master')

@section('content')

    <div class="container">
        <h1>Редактировать статью</h1>

        <form method="POST" action="/publikacii/{{ $post->id }}">
            @csrf
@method('PATCH')
            <div class="form-group">
                <label for="inputCode">Символьный код</label>
                <input type="text" class="form-control" id="inputCode" name="code"
                       value="{{old('code', $post->code)}}">
                <small id="uniqueHelp" class="form-text text-muted">Код должен состоять только из латинских символов,
                    цифр и символов тире и подчеркивания</small>
            </div>

            @error('code')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror

            <div class="form-group">
                <label for="inputTitle">Название статьи</label>
                <input type="text"
                class="form-control"
                id="inputTitle"
                name="title"
                value="{{old('title', $post->title)}}"
            </div>

            @error('title')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror

            <div class="form-group">
                <label for="shortContent">Краткий текст статьи</label>
                <textarea
                class="form-control"
                id="shortContent"
                rows="3"
                name="shortContent">{{ old('shortContent', $post->shortContent)}}</textarea>
                <small id="uniqueHelp" class="form-text text-muted">Не более 255 символов</small>
            </div>

            @error('shortContent')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror

            <div class="form-group">
                <label for="Content">Полный текст статьи</label>
                <textarea
                class="form-control"
                id="Content" rows="5"
                name="content">{{ old('content', $post->content) }}</textarea>
            </div>

            @error('Content')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror

            <div class="form-group form-check">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="isPublick"
                    value="1"
                    name="isPublick"
                    checked="checked"
                >

                <label class="form-check-label" for="isPublick">Опубликовать</label>
            </div>

            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
        <form method="POST" action="/publikacii/{{ $post->id }}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>

    </div>

@endsection
