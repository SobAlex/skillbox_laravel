@extends('layouts.master')

@section('content')

    <div class="container">

        @include('tasks.tags', ['tags' => $post->tags])

        <h1>{{ $post->title }}</h1>
        <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>
        <p>{{ $post->content }}</p>
        @can('update', $post)
            <a href="/publikacii/{{ $post->id }}/edit">Изменить</a>
        @endcan


    </div>

@endsection
