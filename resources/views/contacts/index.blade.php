@extends('layouts.master')

@section('content')

    <div class="container">
        <h1>Контакты</h1>
        <p>Тут контактная информация</p>

        <h2>Создать обращение</h2>

        @include('includes.errors')

        <form method="POST" action="/kontacty">

            @csrf

            <div class="form-group">
                <label for="inputEmail">Email адрес</label>
                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="inputMessage">Сообщение</label>
                <input type="text" class="form-control" id="inputMessage" name="message">
            </div>

            <button type="submit" class="btn btn-primary">Отправить обращение</button>
        </form>
    </div>

@endsection
