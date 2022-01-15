@component('mail::message')
    # Introduction

    # Список постов:
    {{-- <ul>
        @foreach ($posts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul> --}}

    Пост номер: {{ $post->id }}
    Заголовок: {{ $post->title }}
    Содержание: {{ $post->content }}

    @component('mail::button', ['url' => '/'])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
