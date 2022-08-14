@extends('layouts.master')

@php
    $posts = $posts ?? collect();
@endphp

@section('content')

    <main role="main" class="container">
        <div class="row">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Сообщения пользователей
            </h3>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th>E-mail</th>
                    <th>Сообщение</th>
                    <th>Дата создания</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->email }}</td>
                        <td style="max-width: 400px;">{{ $contact->message }}</td>
                        <td>{{ $contact->created_at->format('d.m.Y') }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>


        </div>
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Публикации пользователей
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
                            <a href="{{ url('publikacii') }}/{{ $post->id }}">Читать статью</a>
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
