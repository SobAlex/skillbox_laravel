@component('mail::message')
    # Список постов

    {{-- Пост номер: {{ $post->id }}
    Заголовок: {{ $post->title }}
    Содержание: {{ $post->content }} --}}

    @foreach ($posts as $post)
        <p>{{ $post->title }}</p>
        @component('mail::button', ['url' => 'http://skillbox-laravel.loc/publikacii/' . $post->id])
            посмотреть сообщение
        @endcomponent
    @endforeach



    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
