@extends('layouts.master')

@section('content')

    <div class="container">
        <h1>Создать статью</h1>

        <form method="POST" action="/publikacii">

        @include('includes.form')

        <button type="submit" class="btn btn-primary">Создать статью</button>

    </form>

    </div>

@endsection
