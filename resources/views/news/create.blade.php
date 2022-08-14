@extends('layouts.master')

@section('content')

    <div class="container">
        <h1>Создать новость</h1>

        <form method="POST" action="/news">

            @csrf

            <div class="form-group">
                <label for="inputTitle">Название новости</label>
                <input type="text" class="form-control" id="inputTitle" name="title">
            </div>

            @error('title')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror

            <div class="form-group">
                <label for="Content">Текст новости</label>
                <textarea class="form-control" id="Content" rows="5" name="content"></textarea>
            </div>

            <div class="form-group">
                <label for="inputImage">Путь к изображению (пока так. потом сделать нормально)</label>
                <input type="text" class="form-control" id="inputImage" name="image">
            </div>

            @error('title')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror

            <div class="form-group">
                <label for="inputTags">Теги</label>
                <input class="form-control" type="text" id="inputTags" name="tags"></input>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="isPublick" value="1" name="isPublick"
                       checked="checked">

                <label class="form-check-label" for="isPublick">Опубликовать</label>
            </div>

            <button type="submit" class="btn btn-primary">Создать новость</button>

        </form>
    </div>

@endsection
