@extends('layouts.master')

@php
    $posts = $posts ?? collect();
@endphp

@section('content')

    <main role="main" class="container">

        @include('includes.jumbotron')

        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Публикации
                </h3>

                @foreach ($posts as $post)
                    @if ($post->isPublick)
                        <ul>
                            @include('tasks.tags', ['tags' => $post->tags])
                        </ul>

                        <div class="blog-post">
                            <h2 class="blog-post-title">{{ $post->title }}</h2>
                            <p class="blog-post-meta">{{ $post->created_at->format('d.m.Y H:i:s') }}</p>
                            <p>{{ $post->shortContent }}</p>
                            <a href="{{ url('posts') }}/{{ $post->id }}">Читать статью</a>
                        </div><!-- /.blog-post -->
                    @endif
                @endforeach

                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                </nav>

                {{ $posts->withQueryString()->links() }}
            </div><!-- /.blog-main -->

            @include('includes.aside')

        </div><!-- /.row -->
    </main><!-- /.container -->

@endsection
