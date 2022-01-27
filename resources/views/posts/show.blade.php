@extends('layouts.master')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-8">
                @include('tasks.tags', ['tags' => $post->tags])

                <h1>{{ $post->title }}</h1>
                <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>
                <p>{{ $post->content }}</p>
                @can('edit-post', $post)
                    <a href="/publikacii/{{ $post->id }}/edit">Изменить</a>
                @endcan
            </div>

            @include('includes.aside')

        </div>
    </div>





    </div>

@endsection
