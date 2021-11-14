@component('mail::message')
    # Создан новый пост {{ $post->title }}

    {{ $post->content }}

    @component('mail::button', ['url' => '/', $post->id])
        посмотреть сообщение
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
