@extends('layouts.master')

@section('content')

    <div class="container">
        <h1>Редактировать статью</h1>

        <form method="POST" action="/publikacii">

        @include('includes.form')

        <button type="submit" class="btn btn-primary">Изменить статью</button>

    </form>

        <form method="POST" action="/publikacii/{{ $post->id }}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>

    </div>

@endsection
