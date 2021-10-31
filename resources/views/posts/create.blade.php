@extends('layouts.master')

@section('content')

    <div class="container">
        <h1>Создать статью</h1>

        <form method="POST" action="/publikacii">

            @csrf

            <div class="form-group">
                <label for="inputCode">Символьный код</label>
                <input type="text" class="form-control" id="inputCode" name="code">
                <small id=" uniqueHelp" class="form-text text-muted">Код должен состоять только из латинских символов,
                    цифр и символов тире и подчеркивания</small>
            </div>

            @error('code')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="form-group">
                <label for="inputTitle">Название статьи</label>
                <input type="text" class="form-control" id="inputTitle" name="title">
            </div>

            @error('title')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="form-group">
                <label for="shortContent">Краткий текст статьи</label>
                <textarea class="form-control" id="shortContent" rows="3" name="shortContent"></textarea>
                <small id="uniqueHelp" class="form-text text-muted">Не более 255 символов</small>
            </div>

            @error('shortContent')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="form-group">
                <label for="Content">Полный текст статьи</label>
                <textarea class="form-control" id="Content" rows="5" name="content"></textarea>
            </div>

            <div class="form-group">
                <label for="inputTags">Теги</label>
                <input class="form-control" type="text" id="inputTags" name="tags"></input>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="isPublick" value="1" name="isPublick" checked="checked">

                <label class="form-check-label" for="isPublick">Опубликовать</label>
            </div>

            <button type="submit" class="btn btn-primary">Создать статью</button>

        </form>

    </div>

@endsection
