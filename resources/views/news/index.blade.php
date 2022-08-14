@extends('layouts.master')

@php
    $news = $news ?? collect();
@endphp

@section('content')

    <main role="main" class="container">

        @include('includes.jumbotron')

        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Новости
                </h3>

                @foreach ($news as $new)

                    @if ($new->isPublick)
                        <ul>
                            @include('tasks.tags', ['tags' => $new->tags])
                        </ul>
                        <div class="blog-post">
                            <h2 class="blog-post-title">{{ $new->title }}</h2>
                            <p class="blog-post-meta">{{ $new->created_at->format('d.m.Y H:i:s') }}</p>
                            <p>вывести анонс</p>
                            <a href="{{ url('news') }}/{{ $new->id }}">Читать новость</a>
                        </div><!-- /.blog-post -->
                    @endif
                @endforeach

                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                </nav>

            </div><!-- /.blog-main -->

            @include('includes.aside')

        </div><!-- /.row -->
    </main><!-- /.container -->

@endsection
