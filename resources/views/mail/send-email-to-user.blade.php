@component('mail::message')

    @foreach ($posts as $post)
        <p>{{ $post->title }}</p>
        @component('mail::button', ['url' => 'http://skillbox-laravel.loc/publikacii/' . $post->id])
            посмотреть сообщение
        @endcomponent
    @endforeach

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
